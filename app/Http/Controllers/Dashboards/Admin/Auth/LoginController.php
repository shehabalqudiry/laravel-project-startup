<?php

namespace App\Http\Controllers\Dashboards\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            "email"         => "required|string",
            "password"      => "required|string",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if(!auth()->attempt($request->only('email', 'password'), $request->remember_me ? true : false)) {
            return back()->with('error', 'Invalid email or password');
        }
        if(session()->has('url.intended')) {
            return redirect()->intended(session('url.intended'));
        }

        session()->regenerate();

        // redirect to dashboard
        return redirect()->route('admin.dashboard');
    }
}
