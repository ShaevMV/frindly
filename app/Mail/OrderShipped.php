<?php

namespace App\Mail;

use http\Env;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var int[]
     */
    public $ids;

    /**
     * Create a new message instance.
     *
     * @param int[] $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): OrderShipped
    {
        return $this->from('fullmoon@pranatech.ru')
        ->markdown('emails.orders.shipped')
        ->subject('Билеты на Full Moon Systo Togathering 2022')
            ->with(['ids' => $this->ids]);
    }
}
