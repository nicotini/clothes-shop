<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Service\OrderService;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function __invoke($id)
    {
      $order = $this->orderService->getOrderById($id);
     // dd($order);
      $orderProducts = $this->orderService->getOrderProducts($order);
      //dd($orderProducts);
      return view('order.show', compact('orderProducts'));
    }
}
