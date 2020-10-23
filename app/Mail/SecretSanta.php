<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecretSanta extends Mailable
{
    use Queueable, SerializesModels;

    public $giver;

    public $receiver;

    public $groupName;

    public $price;

    public $formattedDate;

    public $dropOff;

    public $additionalinfo;

    public $subject;

    // 
    public $images = [
        'footer_no'  => 'footer_no_shadow.png',
        'footer'     => 'footer.png',
        'header'     => 'header.png',
        'logo'       => 'logo.jpg',
        'moose'      => 'moose.svg',
        'tile'       => 'tile.jpg',
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
        // $data = collect($data);

        $this->giver = $data['giver'];
        $this->receiver = $data['reciever'];
        $this->groupName = $data['groupName'];
        $this->price = $data['price'];
        $this->formattedDate = $data['formattedDate'];
        $this->dropOff = $data['dropOff'];
        $this->additionalinfo = $data['additionalinfo'];

        $this->subject = 'Secret Santa ' . date('Y');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this
                ->subject($this->subject)
                ->view('mail.secret-santa.send');
    }
}
