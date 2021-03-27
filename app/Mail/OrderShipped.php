<?php

namespace App\Mail;

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
        return $this->from('noreply@no-reply.ru')
            ->markdown('emails.orders.shipped')
            ->with(['ids' => implode($this->ids)]);
    }
}
