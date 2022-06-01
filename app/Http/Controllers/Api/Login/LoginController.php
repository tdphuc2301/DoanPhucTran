<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
            return redirect('admin');
        } else {
            return view('admin/auth/login');
        }
    }

    
    public function postLogin(Request $request)
    {
        try {
            $this->validateLogin($request);
            $credentials = request(['username', 'password']);
            $user = User::where('username', $request->username)->first();
            if(!$user) {
                return redirect(route('screen_admin_login'))->with("message", "Username is wrong!");
            } else  {
                if (!Hash::check($request->password, $user->password, [])) {
                    return redirect(route('screen_admin_login'))->with('message', 'Passwword is wrong!');
                } else {
                    $roles = $user->role;
                    if($roles->name === User::ADMIN || $roles->name === User::MANAGER) {
                        Auth::attempt($credentials);
                        return redirect(route('admin.dashboard'));
                    } else if($roles->name === User::SHIPPER || $roles->name === User::CUSTOMER) {
                        return redirect(route('screen_admin_login'))->with('message', 'You not perrmission');
                    }
                }

            }


//            if (!Auth::attempt($credentials)) {
//                return redirect(route('screen_admin_login'))->with("message", "Email or password is wrong!");
//            }
//            
//            if (!Hash::check($request->password, $user->password, [])) {
//                
//            }
//            $user->createToken('authToken')->plainTextToken;
            return redirect(route('screen_admin_home'));
        } catch (Exception $e) {
            return back()->with('message', $e->getMessage() . '!');
        }
    }
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('screen_admin_login');
    }

    public function validateLogin($request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    }
    
}
