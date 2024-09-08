<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Attendance;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use App\Enums\EventAttendanceConfirmationStatus;

class AttendanceRepository
{
    public function getAllAttendances()
    {
        return Attendance::with(['event', 'payment'])->latest()->get();
    }

    public function getAttendanceForAnEvent(array  $attributes)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getAttendanceForAUserType(array  $attributes)
    {
        return Attendance::where('user_type', data_get($attributes, 'user_type'))
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getAttendanceForAnEventandUserType(array  $attributes)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', data_get($attributes, 'user_type'))
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function storeAttendance(array $attributes)
    {
        $event = Event::findOrFail(data_get($attributes, 'event_id'));
        if ($event) {
            $attendance = $event->attendance()->create([
                'first_name' => data_get($attributes, 'first_name'),
                'last_name' => data_get($attributes, 'last_name'),
                'phone' => data_get($attributes, 'phone'),
                'email' => data_get($attributes, 'email'),
                'organization' => data_get($attributes, 'organization'),
                'position' => data_get($attributes, 'position'),
                'user_type' => data_get($attributes, 'user_type'),
            ]);

            return $attendance;
        }

        return false;
    }

    public function generateAndStoreQrCode($attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);

        // Generate QR code as binary data (PNG format)
        if ($attendance) {
            try {
                // Create a new QR Code instance
                $qrCode = new QrCode(route('qrcode.confirm', $attendance->id));
                $qrCode->setEncoding(new Encoding('UTF-8'));
                $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::High); // Use the correct constant
                $qrCode->setSize(150);

                // Create a writer
                $writer = new PngWriter();

                // Get QR code image as a binary string
                $qrCodeData = $writer->write($qrCode);

                // Define the path to save the QR code
                $directory = public_path('img/qrcodes');
                $path = $directory . '/' . $attendance->first_name . '-' . $attendance->last_name . '.png';

                // Make sure the 'qrcodes' directory exists
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Write the QR code to a file
                file_put_contents($path, $qrCodeData->getString());

                // Convert the QR code to a base64-encoded string
                $qrCodeBase64 = base64_encode($qrCodeData->getString());

                // Save QR code data to the database
                $attendance->update([
                    'confirmation_status' => EventAttendanceConfirmationStatus::CONFIRMED,
                    'qr_code' => $qrCodeBase64
                ]);

                return $attendance;
            } catch (\Exception $e) {
                // Handle exception (log error or return a specific message)
                Log::error('Error generating or storing QR code: ' . $e->getMessage());
                return false;
            }
        }
        return false;
    }

    public function confirmQR($id)
    {
        // confirm   
        $attendance = Attendance::findOrFail($id);
        if ($attendance) {

            $today = Carbon::now();
        }

        return false;
    }
}
