<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Service\OrderService;

class SuccessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
    public function __invoke()
    {
       return view('checkout.success');
    }
}
