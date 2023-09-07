<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        //
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]
        // ,[
        //     'email.required' =>'Vui lòng không được bỏ trống email',
        //     'email.email' =>'Bạn có chắc mình nhập đúng định dạng email không',
        //     'password.required' =>'Vui lòng không được bỏ trống password',
        // ]
    );
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if(Auth::attempt($credentials,$remember)){
            return redirect()->intended();
        }else{
            return redirect()->back()->with('error', 'Tài khoản có thể đã chưa đăng ký');
        }
    
    }

  
    public function destroy()
    {
         Auth::logout();

         request()->session()->invalidate();
         request()->session()->regenerateToken();

         return redirect('/');
    }
}
