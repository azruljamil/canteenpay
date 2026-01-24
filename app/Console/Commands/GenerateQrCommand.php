<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class GenerateQrCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:qr {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR code for a given token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = $this->argument('token');
        $data = $token;
        $logoPath = public_path('img/qr_celcom_digi_logo.jpg');
        $filename = $token . '.png';

        try {
            $qrCode = QrCode::format('png')
                ->color(30, 67, 133)
                ->size(500)
                ->margin(1)
                ->errorCorrection('H');

            if (File::exists($logoPath)) {
                $qrCode = $qrCode->merge($logoPath, 0.5, true);
            }

            $qrCode = $qrCode->generate($data);

            $path = public_path('qrcodes/' . $filename);
            File::ensureDirectoryExists(public_path('qrcodes'));
            File::put($path, $qrCode);

            $this->info("QR Code generated: " . asset('qrcodes/' . $filename));
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}
