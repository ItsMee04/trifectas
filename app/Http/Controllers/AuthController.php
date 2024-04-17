<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'  =>  'required',
            'password'  =>  'required',
        ]);

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->status != 1)
            {
                return redirect('login')->with('message','Akun Belum Aktif');
            }else
            {
                if(Auth::user()->role_id == 1)
                {
                    return redirect('admin/dashboard');
                }elseif(Auth::user()->role_id == 2)
                {
                    return redirect('kepala/dashboard');
                }
            }
        }

        return redirect('login')->with('message','Username atau Password salah');
    }

    public function logout()
    {
        
    }
}
