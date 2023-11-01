<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
       $request->user()->currentAccessToken()->delete();
       $session = $request->session()->flush();
       
        return response()->json([
            'message'=> 'Logged out',
            'session' => $session,
           
        ]);
    }
    
}
