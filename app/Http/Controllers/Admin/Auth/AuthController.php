<?php
//
//namespace App\Http\Controllers\Admin\Auth;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class AuthController extends Controller
//{
//    public function login(){
//        if (Auth::check()) {
//            // nếu đăng nhập thàng công thì 
//            return redirect('admin/index');
//        } else {
//            return view('admin/auth/login');
//        }
//    }
//    /**
//     * @param LoginRequest $request
//     * @return RedirectResponse
//     */
//    public function postLogin(LoginRequest $request)
//    {
//        $login = [
//            'email' => $request->txtEmail,
//            'password' => $request->txtPassword,
//            'level' => 1,
//            'status' => 1
//        ];
//        if (Auth::attempt($login)) {
//            return redirect('admincp');
//        } else {
//            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
//        }
//    }
//
//    /**
//     * action admincp/logout
//     * @return RedirectResponse
//     */
//    public function getLogout()
//    {
//        Auth::logout();
//        return redirect()->route('getLogin');
//    }
//    
//}
