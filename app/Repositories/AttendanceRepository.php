<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Attendance;
use Endroid\QrCode\QrCode;
use App\Enums\AttendancePassStatus;
use App\Enums\ExhibitionRegisterAs;
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

    public function getAttendanceForAnEvent(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('confirmation_status', $confirmationStatus)
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getRegisteredAttendanceForAUserType(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('user_type', data_get($attributes, 'user_type'))
            ->where('confirmation_status', $confirmationStatus)
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getConfirmedAttendanceForAUserType(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('user_type', data_get($attributes, 'user_type'))
            ->where('confirmation_status', $confirmationStatus)
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getRegisteredAttendanceForAnEventandUserType(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', data_get($attributes, 'user_type'))
            ->where('confirmation_status', $confirmationStatus)
            ->with(['event', 'payment'])
            ->latest()->get();
    }

    public function getConfimedAttendanceForAnEventandUserType(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', data_get($attributes, 'user_type'))
            ->where('confirmation_status', $confirmationStatus)
            ->with(['event', 'payment'])
            ->latest()->get();
    }


    public function getAllDelegates($userType = ExhibitionRegisterAs::DELEGATE)
    {
        return Attendance::where('user_type', $userType)->get();
    }

    public function getAllRegisteredDelegates($userType = ExhibitionRegisterAs::DELEGATE, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->get();
    }

    public function getAllConfirmedDelegates($userType = ExhibitionRegisterAs::DELEGATE, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->get();
    }

    public function getRegisteredDelegatesForAnEvent(array  $attributes, $userType = ExhibitionRegisterAs::DELEGATE, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->latest()
            ->get();
    }

    public function getConfirmedDelegatesForAnEvent(array  $attributes, $userType = ExhibitionRegisterAs::DELEGATE, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->latest()
            ->get();
    }

    public function getAllExhibitors($userType = ExhibitionRegisterAs::EXHIBITOR)
    {
        return Attendance::where('user_type', $userType)->get();
    }

    public function getAllRegisteredExhibitors($userType = ExhibitionRegisterAs::EXHIBITOR, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->latest()
            ->get();
    }

    public function getAllConfirmedExhibitors($userType = ExhibitionRegisterAs::EXHIBITOR, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)  
    {
        return Attendance::where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->latest()
            ->get();
    }

    public function getExhibitorsForAnEvent(array  $attributes, $userType = ExhibitionRegisterAs::EXHIBITOR, $confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->get();
    }

    public function getConfirmedExhibitorsForAnEvent(array  $attributes, $userType = ExhibitionRegisterAs::EXHIBITOR, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('event_id', data_get($attributes, 'event_id'))
            ->where('user_type', $userType)
            ->where('confirmation_status', $confirmationStatus)
            ->get();
    }

    public function getAllRegisteredAttendances($confirmationStatus =  EventAttendanceConfirmationStatus::PENDING)
    {
        return Attendance::where('confirmation_status', $confirmationStatus)->latest()->get();
    }

    public function getAllConfirmedAttendancesForAnEvent(array  $attributes, $confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('confirmation_status', $confirmationStatus)
            ->where('event_id', data_get($attributes, 'event_id'))
            ->latest()
            ->get();
    }


    public function getAllConfirmedAttendances($confirmationStatus =  EventAttendanceConfirmationStatus::CONFIRMED)
    {
        return Attendance::where('confirmation_status', $confirmationStatus)->latest()->get();
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
                    'qr_code' => $path
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

    public function cancelAttendance(array $attributes, Attendance $attendance)
    {
        // Cancel attendance logic here
        $attendance->update([
            'confirmation_status' => EventAttendanceConfirmationStatus::CANCELLED
        ]);
        $cancelAttendance = $attendance->cancelAttendance()->create([
            'event_id' => $attendance->event->id,
            'reasons' => data_get($attributes, 'reasons')
        ]);

        return $cancelAttendance;
    }

    public function confirmQR($id)
    {
        // confirm   
        $attendance = Attendance::findOrFail($id);
        if ($attendance) {
            $today = Carbon::now();
            if ($attendance->confirmation_status == EventAttendanceConfirmationStatus::CONFIRMED) {
                $attendance->update([
                    'confirmation_status' => EventAttendanceConfirmationStatus::CONFIRMED,
                    'attendance_pass_status' => AttendancePassStatus::ISSUED,
                    'date_issued' => $today
                ]);

                return true;
            } else {
                $attendance->update([
                    'attendance_pass_status' => AttendancePassStatus::DENIED,
                ]);

                return false;
            }
        }

        return false;
    }
}
