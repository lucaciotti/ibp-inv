<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Log;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $user;
    public $url;
    // public $hasToPrivacyAgree = false;
    // public $daysLeftAgree = 14;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $id)
    {
        $this->user = User::findOrFail($id);
        $this->token = $token;
        $this->url = route("password.reset", ['token' => $token, 'email' => $this->user->email]);
        Log::info('Invio Invito a ' . $this->user->name);
    }

    public function build() {
        $from = 'mcslidewms@lucaciotti.space';
        return $this->from($from, 'McSlide - Wms')
            ->subject('Credenziali Account McSlide-Wms')
            ->markdown('sys._emails.invite');
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Credenziali Account IBP-Oms',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     new Content(
    //         markdown: 'sys._emails.invite',
    //         with: [
    //             'url' => $this->url,
    //         ],
    //     );

    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {
    //     return [];
    // }
}
