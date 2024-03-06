<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailBookTable extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $store;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $store)
    {
        $this->data = $data;
        $this->store = $store;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('qdang354@gmail.com')->view('web.components.mail.book_table')
            ->subject('Lẩu nấm gia khánh Email Đặt bàn');
    }
}
