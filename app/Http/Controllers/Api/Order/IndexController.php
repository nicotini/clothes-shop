<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function __invoke()
    {
        $user = Auth::guard('sanctum')->user();
        $userId = $user->id;

        $orders = $this->orderService->getAllUserOrders($userId);
        
        return response()->json(['orders' => $orders], 200);
    }
}
