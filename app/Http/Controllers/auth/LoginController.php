<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // public function index() {
    //     return view('auth.login');
    // }

    // public function getGoogleSignInUrl()
    // {
    //    return Socialite::driver('google')->redirect();
    // }
    // public function loginCallback()
    // {

    //     try {
    //         $user = Socialite::driver('google')->user();
    //         $finduser = User::where('google_id', $user->id)->first();
    //         if($finduser)
    //         {
    //             Auth::login($finduser);
    //             Session::put('user', $finduser);
    //             return redirect()->route('home')->with('success', 'Đăng nhập thành công');
    //         }
    //         else
    //         {
    //             $newUser = User::create([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'google_id'=> $user->id,
    //                 'nhomquyen_id'=>'1',
    //                 'status'=>'Hoạt động',
    //                 'password' => encrypt('123456dummy')
    //             ]);
    //             Auth::login($newUser);
    //             Session::put('user', $newUser);
    //             return redirect()->route('home')->with('success', 'Đăng nhập thành công');

    //         }


    //     } catch (Exception $e)
    //     {
    //         dd($e->getMessage());
    //     }

    // }

    // public function register(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string',
    //             'password' => 'required|string',
    //             'email' => 'required|email|unique:users,email',
    //         ]);


    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $user = new User();
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = $request->password; // Hash password
    //         $user->nhomquyen_id = 1;
    //         $user->status = "Hoạt động";
    //         $user->save();
    //         Auth::login($user); // Login user after registration
    //         Session::put('success','Đăng kí thành công' );
    //         return redirect()->route('login_view');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }

    // public function login(Request $request)
    // {
    //     try {
    //         if (Auth::attempt(['email'=> $request->email_login,'password' =>$request->password_login ])) {
    //             $request->session()->regenerate(); // Regenerate session for security
    //             $user =  $request->user() ;
    //             Session::put('user',$user );
    //             return redirect()->route('home');
    //         }
    //         return back()->withErrors([
    //             'message' => 'Thông tin đăng nhập không chính xác.',
    //         ])->withInput();
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }


    // public function logout(Request $request)
    // {
    //     try {
    //         Auth::logout(); // Log the user out
    //         $request->session()->invalidate(); // Invalidate session
    //         $request->session()->regenerateToken(); // Regenerate CSRF token
    //         Session::put('success','Đăng xuất thành công' );
    //         return redirect()->route('login_view');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }
}
