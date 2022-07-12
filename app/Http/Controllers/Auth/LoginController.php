<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => ['alpha_num', 'required'],
            'password' => ['required']
        ]);

        if ($token = auth()->attempt($request->only('username', 'password'))){
            return response()->json(['token' => $token, 'currentUser' => Auth::user()]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
