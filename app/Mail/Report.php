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
    public $income;
    public $expense;
    public $balance;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transactions, $income, $expense,$balance)
    {
        $this->transactions = $transactions;
        $this->income = $income;
        $this->expense=$expense;
        $this->balance=$balance;
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
