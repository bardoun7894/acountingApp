<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    // constructor for this model
    public function __construct()
    {
    }

    public function saveCustPaymentDetails(
        $customer_id,
        $customer_invoice_id,
        $branch_id,
        $invoice_no,
        $invoice_date,
        $total_amount,
        $payment_amount,
        $user_id,
        $remaining_balance
    ) {
        $this->customer_id = $customer_id;
        $this->customer_invoice_id = $customer_invoice_id;
        $this->branch_id = $branch_id;
        $this->invoice_number = $invoice_no;
        $this->invoice_date = $invoice_date;
        $this->total_amount = $total_amount;
        $this->payment_amount = $payment_amount;
        $this->remaining_balance = $remaining_balance;
        $this->user_id = $user_id;
        $this->save();
    }
}

