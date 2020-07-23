<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;
	protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }  

    public function showAdminLogin(){
    	return view('admin.login');
    }

    public function adminLogin(LoginRequest $request)
    {
        $request->validated();
    	$data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('admin')->attempt($data)){
        	if(Auth::guard('admin')->user()->level != 3)  return redirect('/admin/dashboard');
        	else return back()->with('err','Email or Password incorrect!');
        }
        else return back()->with('err','Email or Password incorrect!');
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
