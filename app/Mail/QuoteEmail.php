<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $signedUrl; // Signed URL for the quote
    public $quotdata;  // Quote data
    public $contractorName;  // Contractor's name

    /**
     * Create a new message instance.
     *
     * @param string $signedUrl
     * @param array $quotdata
     * @return void
     */
    public function __construct($signedUrl, $quotdata)
    {
        $this->signedUrl = $signedUrl;
        $this->quotdata = $quotdata; // Assigning the quote data
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Set default values to avoid undefined variable errors
        $contractorName = 'Contractor'; // Default contractor name

        if (isset($this->quotdata) && isset($this->quotdata['contractor'])) {
            $contractorName     = $this->quotdata['contractor']['name'] ?? 'Contractor';
        }
        return $this->subject("You've Received a New Quote from $contractorName!")
        ->view('emails.quote-email')
        ->with([
            'signedUrl' => $this->signedUrl,
            'quotdata' => $this->quotdata,
        ]);
    }
}
