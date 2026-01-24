<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Attendee;
use App\Models\Purchase;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\SentMail;

class AttendeeController extends Controller
{
    public function sendEmail($details,$email,$name) {

        $detail = [
            'name' => $name,
            'qrcode' => $details
        ];

        Mail::to($email)->send(new SentMail($detail));

        return 'Email sent successfully!';
    }

    public function createAttendee(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|string|max:35',
            'first_name'  => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'company_operate'  => 'required|string|max:255',
            'phone'  => 'required', 'regex:/^60\d{8,9}$/',
            'employee_total'  => 'required|string|max:255',
            'industry'  => 'required|string|max:255',
            'loan_acquired'  => 'required|numeric|max:1',
            'email' => 'required|email',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            
            return response()->json([
                'status' => false,
                'errors' => $errors
            ]);
        }

        $name = $request['first_name']. ' ' .$request['last_name'];
        $token = "";
        $filename = "";
        $email = "";

        $search_attendee = Attendee::select('token','name','email')->where('name',$name)->orWhere('email',$request['email'])->orWhere('phone',$request['phone'])->get();

        if ($search_attendee->count() == 0) {
            $type = 1;
            $name = $request['first_name']. ' ' .$request['last_name'];
            $email = $request['email'];

            $create_attendee = new Attendee;
            $create_attendee->title = $request['title'];
            $create_attendee->name = $name;
            $create_attendee->email = $email;
            $create_attendee->phone = "60".$request['phone'];
            $create_attendee->company_operate = $request['company_operate'];
            $create_attendee->employee_total = $request['employee_total'];
            $create_attendee->industry = $request['industry'];
            $create_attendee->loan_acquired = $request['loan_acquired'];
            $create_attendee->redeem = 0;
            $create_attendee->type = 1; // 1 is for attendee
            $create_attendee->attend_event = 1;
            $create_attendee->save();

            // Generate token based on id
            $token = md5($create_attendee->id . $name . $email);
            $create_attendee->token = $token;
            $create_attendee->save();

            $link = "qrcodes/".$token.".png";

            $this->generateQrCode($token,$email,$name);
            
        }
        else {
            $type = 2;
            
            foreach($search_attendee as $attendee) {
                $link = "qrcodes/".$attendee['token'].".png";
                $filename = $attendee['token'].".png";
                $email = $attendee['email'];
                $name = $attendee['name'];
            }

            
            $this->sendEmail($filename,$email,$name);
        }

        if($request['guest'] == 1) {
            $link_guest =  "qrcodes/".$guest_token.".png";
        }
        else {
            $link_guest = "";
        }
        
        return response()->json([
            'status' => true,
            'message' => $link,
            'guest' => $link_guest,
            'type' => $type
        ]);
    }

    public function generateQrCode($token,$email,$name) {

        $data = $token; // Data for the QR code
        $logoPath = public_path('img/qr_celcom_digi_logo.jpg'); // Path to your logo (place it in the public/images folder)
        $filename = $token.'.png'; // Name for the generated QR code file
  
        try {
            if (file_exists($logoPath)) {
                $qrCode = QrCode::format('png')
                    ->color(30, 67, 133)
                    ->size(500)
                    ->margin(1) // Adjust margin as needed
                    ->errorCorrection('H') // Adjust error correction level (L, M, Q, H)
                    ->merge($logoPath, 0.5, true) // Merge logo (0.2 is the relative size of the logo)
                    ->generate($data);

                // Store the QR code in the public/qrcodes directory
                $path = public_path('qrcodes/' . $filename);
                \File::ensureDirectoryExists(public_path('qrcodes')); // Make sure the directory exists.
                file_put_contents($path, $qrCode);

                //return response()->json(['url' => asset('qrcodes/' . $filename)]); // Return the URL to the image
                $this->sendEmail($filename,$email,$name);

                return $this->displayQrCode(str_replace('\\','/',$filename));
            } else {
                return response()->json(['error' => 'Logo not found.'], 404);
            }

        } catch (\Exception $e) {
             return response()->json(['error' => 'QR code generation failed: ' . $e->getMessage()], 500); // Handle exceptions
        }

    }

    public function displayQrCode($filename) {
        $path = public_path('qrcodes/' . $filename);
        if (file_exists($path)) {
            header('Content-type: image/png');
            return response()->file($path, ['Content-Type' => 'image/png']);
        } 
        else {
            return abort(404);
        }
    }

    public function verifyAttendee(Request $request) {

        if ($request->has('email') && $request->input('email') != "") {
            $rules['email'] = 'sometimes|email';
        } 
        elseif ($request->has('phone') && $request->input('phone') != "") {
            $rules['phone'] = 'sometimes|string|min:10';
        }
        else {
            $rules['token'] = 'sometimes|string';
        }
        
        $request->validate($rules);

        $query = Attendee::select('title', 'name', 'company', 'token', 'redeem', 'redeem_on');

        if ($request->has('email') && $request->input('email') != "") {
            $query->where('email', $request->input('email'));
            $param = 1;
        } elseif ($request->has('phone') && $request->input('phone') != "") {
            $query->where('phone', "6".$request->input('phone'));
            $param = 2;
        } else {
            $query->where('token', $request->input('token'));
            $param = 3;
        }

        $attendee = $query->first();

        if (!$attendee) {
            return response()->json([
                'status' => false,
                'error_type' => 0,
                'message' => 'Attendee not found'
            ]);
        }
        elseif ($attendee->redeem == 1) {
            return response()->json([
                'status' => false,
                'error_type' => 2,
                'message' => 'Attendee already redeemed',
                'title' => $attendee->title,
                'name' => $attendee->name,
                'redeem_on' => $attendee->redeem_on
            ]);
        }
        else {

            if ($param == 1) {
                $data = $request->input('email');
            } elseif ($param == 2) {
                $data = $request->input('phone');
            } else {
                $data = $request->input('token');
            }

            $this->updateAttendee($data);

            return response()->json([
                'status' => true,
                'message' => 'Attendee found',
                'name' => $attendee->name,
                'company' => $attendee->company,	
                'category' => $attendee->category,
                'title' => $attendee->title,
                'qr' => $attendee->token
            ]);
        }
        
    }  

    public function updateAttendee($input) {

        $attendee = Attendee::where('token', $input)
            ->orWhere('email', $input)
            ->orWhere('phone', "6" . $input) // Adding "6" prefix for phone
            ->first();

        if ($attendee) {
            $attendee->redeem = 1;
            $attendee->redeem_on = now()->setTimezone('Asia/Kuala_Lumpur');
            $attendee->save();
        }
    }

    public function participateLuckyDraw($token) {

        $attendee = Attendee::where('token', $token)->first();
        if ($attendee) {
            $attendee->type = 6; // 6 is for lucky draw
            $attendee->updated_at = now()->setTimezone('Asia/Kuala_Lumpur');
            $attendee->save();

            return response()->json([
                'status' => true,
                'title' => $attendee->title,
                'name' => $attendee->name,
                'message' => 'Attendee added to lucky draw'
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Attendee not found'
            ]);
        }
    }

    public function getListLuckyDraw() {
        $attendees = Attendee::select('name')->where('type', 6)->where('redeem', 1)->where('status', 1)->get();
        return response()->json($attendees);
    }
    
    public function redemption() {
        return view('redemption');
    }

    public function qrcode() {
        return view('qr');
    }

    public function luckyDraw() {
        return view('lucky-draw');
    }

    public function index() {
        return view('index');
    }

    public function scanAttendeeQrCode()
    {
        return view('reader');
    }

    public function checkBalance(Request $request)
    {
        $studentId = $request->input('student_id');
        $amount = $request->input('amount');
        $items = $request->input('items', []);

        // Find attendee by token (assuming student ID is token)
        $attendee = Attendee::where('token', $studentId)->first();

        if (!$attendee) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ]);
        }

        if ($attendee->balance >= $amount) {
            // Deduct balance
            $attendee->balance -= $amount;
            $attendee->save();

            // Record purchase
            Purchase::create([
                'attendee_id' => $attendee->id,
                'items' => $items,
                'total' => $amount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful.',
                'name' => $attendee->name,
                'balance' => $attendee->balance
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance.',
                'name' => $attendee->name,
                'balance' => $attendee->balance
            ]);
        }
    }

}
