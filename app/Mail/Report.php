<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Report extends Mailable
{
    use Queueable, SerializesModels;
    public $transactions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->transactions = $result;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('transactions.report');
    }
}
