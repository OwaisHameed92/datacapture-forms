<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KycSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Customer $customer)
    {
    }

    public function envelope(): Envelope
    {
        $name = trim($this->customer->first_name.' '.$this->customer->last_name);

        return new Envelope(
            subject: 'New KYC submission'.($name !== '' ? ' — '.$name : ''),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kyc-submitted',
            with: [
                'customer' => $this->customer,
                'documentsCount' => $this->customer->documents()->count(),
                'submittedAt' => $this->customer->created_at,
                'adminUrl' => route('admin.kyc.customers.show', $this->customer),
            ],
        );
    }
}
