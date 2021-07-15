<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    { 
        return view('auth.login');
    }
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
               ]);
          dd(Auth::attempt($request->only('email','password'),$request->remember));
               if(Auth::attempt($request->only('email','password'),$request->remember))
               {
                   if(Auth::user()->isadmin == 1){
                    return redirect()->route('posts');
                   }else{
                    return redirect()->route('dashboard');
                   }
                
               }
               return back()->with('status','Invalid login details');
    }
}