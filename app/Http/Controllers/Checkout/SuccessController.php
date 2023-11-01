<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Service\OrderService;

class SuccessController extends Controller
{
    public function __invoke()
    {
       return view('checkout.success');
    }
}
