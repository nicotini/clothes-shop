<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Service\OrderService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
    public function __invoke(StoreRequest $request)
    {
       $data = $request->validated();
       $order = $this->orderService->saveToDatabase($data);
       
       return redirect()->route('checkout.success');
    }
}
