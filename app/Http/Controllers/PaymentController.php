<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->payment = new Payment();
    }

    public function shippingFee()
    {
        return view('client/test');
    }
}