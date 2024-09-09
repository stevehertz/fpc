<?php

namespace App\Mail;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttendanceConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $attendance;
    public $qrCodePath;

    /**
     * Create a new message instance.
     */
    public function __construct(Attendance $attendance, $qrCodePath)
    {
        //
        $this->attendance = $attendance;
        $this->qrCodePath = $qrCodePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Attendance Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.emails.confirm-attendance',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Attendance Confirmation")
            ->view('backend.emails.confirm-attendance')
            ->attach($this->qrCodePath, [
                'mime' => 'image/png'
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [
    //         new \Illuminate\Mail\Mailables\Attachment(
    //             path: $this->qrCodePath, // Attach the QR code
    //             as: 'qr_code.png', // Optional: Name of the attached file
    //             mime: 'image/png' // Optional: MIME type of the file
    //         ),
    //     ];
    // }
}
