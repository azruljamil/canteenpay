<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        return view('dashboard');
    }

    public function updateAttendee($token) {
        $attendee = Attendee::where('token', $token)->first();
        $attendee->redeem_on = date('Y-m-d H:i:s');
        $attendee->redeem = 1;
        $attendee->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendee updated'
        ]);
    }

    public function getTotalCountAttending() {
        $attendees = Attendee::where('redeem', 1)->count();
        return response()->json($attendees);
    }

    public function getTotalCountNotAttending() {
        $attendees = Attendee::where('redeem', 0)->count();
        return response()->json($attendees);
    }

    public function getTotalCount() {
        $attendees = Attendee::count();
        return response()->json($attendees);
    }

    public function getTotalCountByCategory($category) {
        $attendees = Attendee::where('category', $category)->count();
        return response()->json($attendees);
    }

    public function getTotalCountByType($type) {
        $attendees = Attendee::where('type', $type)->GROUP_BY('category')->count();
        return response()->json($attendees);
    }
    
    public function updateAttendeeProfile($id, Request $request) {
        $attendee = Attendee::find($id);

        if (!$attendee) {
            return response()->json([
                'status' => false,
                'message' => 'Attendee not found'
            ]);
        }

        // Update the attendee's profile
        $attendee->title = $request->input('title', $attendee->title);
        $attendee->name = $request->input('name', $attendee->name);
        $attendee->email = $request->input('email', $attendee->email);
        $attendee->phone = $request->input('phone', $attendee->phone);
        $attendee->company = $request->input('company', $attendee->company);
        $attendee->designation = $request->input('designation', $attendee->designation);
        $attendee->category = $request->input('category', $attendee->category);
        $attendee->redeem_on = $request->input('redeem_on', $attendee->redeem_on);
        $attendee->redeem = $request->input('redeem', $attendee->redeem);
        $attendee->attend_event = $request->input('attend_event', $attendee->attend_event);
        $attendee->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendee profile updated',
            'attendee' => $attendee
        ]);
    }

    public function deleteAttendeeProfile($id) {
        $attendee = Attendee::find($id);
        $attendee->status = 0;
        $attendee->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendee deleted'
        ]);
    }

    public function getAttendeeProfile($id) {
        $attendee = Attendee::find($id);
        return response()->json($attendee);
    }

    public function listAttendeesLuckyDrawAdmin() {
        $attendees = Attendee::select('title', 'name', 'email', 'phone', 'company')->where('status', 1)->where('type', 6)->get();
        return response()->json($attendees);
    }

    public function listAttendeesAdmin() {
        return view('remove_attendee_admin');
    }

    public function getList() {
        // $attendees = Attendee::select('id', 'title', 'name', 'email', 'phone')
        //             ->leftJoin('wallet_balance', 'attendee.id', '=', 'wallet_balance.student_id')
        //             ->where('status', 1)
        //             ->get();
        

        $attendees = DB::table('attendee')
        ->leftJoin('wallet_balance', 'attendee.id', '=', 'wallet_balance.student_id')
        ->where('attendee.status', 1)
        ->select(
            'attendee.id as attendee_id',
            'attendee.title',
            'attendee.name',
            'attendee.email',
            'attendee.phone',
            'wallet_balance.wallet_balance' // optional, if you want it
        )
        ->get();

        return response()->json($attendees);
    }

    public function luckyDrawListAll() {
        return view('lucky-draw-list');
    }
}