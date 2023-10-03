<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function __invoke()
    {
        $user = Auth::user();
        $userId = $user->id;

        $orders = $this->orderService->getAllUserOrders($userId);
        
        return view('order.index', compact('orders', 'user'));
    }
}
