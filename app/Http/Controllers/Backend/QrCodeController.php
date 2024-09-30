<?php

namespace App\Http\Controllers\Backend;

use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

class QrCodeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateAndSendQrCode()
    {
        // Information to be attached to the QR code
        $info = "Fridah K. Rweria\n"
            . "Marketing Officer - Agricultural solutions\n"
            . "Phone: +254 20 407-2013, Mobile: +254 73 455 6977\n"
            . "Email: fridah.rweria@basf.com\n"
            . "Postal Address: BASF East Africa Ltd., 295135 Lower Kabete Road, 00100 Nairobi, Kenya\n"
            . "BASF East Africa Limited\n"
            . "Reg. No.: CPR/2011/43897\n"
            . "Directors: Gift Mbaya (Managing), Juliana Hosken Wernek, Francis Kirui\n"
            . "Switchboard: +254 20 4072000\n"
            . "PO Box 24271, Nairobi, 00100\n"
            . "The Pavilion, 6th Floor, Lower Kabete Road, Nairobi, Kenya";

        // Create QR code instance
        $qrCode = new QrCode($info);
        $qrCode->setEncoding(new Encoding('UTF-8'));
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::High); // Use the correct constant
        $qrCode->setSize(300);

        // Create a writer to save the QR code as a PNG image
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);

        // Define the path to save the QR code image with a file name
        $qrCodeDirectory = public_path('img/fqrcodes');
        if (!file_exists($qrCodeDirectory)) {
            mkdir($qrCodeDirectory, 0755, true); // Creates the directory with the correct permissions
        }

        // Add a unique file name to the path
        $qrCodeFilePath = $qrCodeDirectory . '/fridah-rweria-qrcode.png';

        // Write the QR code image to the file
        file_put_contents($qrCodeFilePath, $qrCodeImage->getString());

        // Send the QR code via email
        $this->sendQrCodeEmail($qrCodeFilePath);

        return response()->json(
            [
                'status' => true,
                'message' => 'QR code generated and sent via email successfully'
            ]
        );
    }

    public function sendQrCodeEmail($qrCodePath)
    {
        $toEmail = 'info@fpckenya.co.ke'; // Recipient's email

        // Send email with QR code attached
        Mail::send([], [], function ($message) use ($qrCodePath, $toEmail) {
            $message->to($toEmail)
                ->subject('Your QR Code')
                ->html('Please find your QR code attached.', 'text/html')
                ->attach($qrCodePath, [
                    'as' => 'fridah-rweria-qrcode.png',
                    'mime' => 'image/png',
                ]);
        });
    }
}
