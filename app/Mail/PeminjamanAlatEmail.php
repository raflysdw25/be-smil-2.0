<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Peminjaman;

class PeminjamanAlatEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $peminjaman, $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Peminjaman $peminjaman, $notification)
    {
        $this->peminjaman = $peminjaman;        
        $this->notification = $notification;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Bukti Peminjaman Alat Laboratorium')
            ->view('emails.emailNotificationBooking');
    }
}
