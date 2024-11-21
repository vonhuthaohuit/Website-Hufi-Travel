<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\KhachHang;
use App\Models\NhanVien;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function getGoogleSignInUrl()
    {
        return Socialite::driver('google')->redirect();
    }
    public function loginCallback()
    {

        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                Session::put('user', $finduser);
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            } else {
                $newUser = User::create([
                    'tentaikhoan' => $user->email,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'matkhau' => bcrypt('123456dumy'),
                    'trangthai' => 'Hoạt động',
                    'manhomquyen' => '1',
                ]);
                $khachhang = new KhachHang();
                $khachhang->hoten = $user->name;
                $khachhang->gioitinh = null;
                $khachhang->ngaysinh = null;
                $khachhang->sodienthoai = "0000000000";
                $khachhang->diachi = null;
                $khachhang->hinhdaidien = null;
                $khachhang->maloaikhachhang = 1;
                $khachhang->mataikhoan = $newUser->id;
                $khachhang->save();
                Auth::login($newUser);
                Session::put('user', $newUser);
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }
        } catch (Exception $e) {
            return redirect()->route('login_view')->with('error', 'Đăng nhập không thành công');
        }
    }

    public function register(Request $request)
    {
        Log::info('Register method started');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', $validator->errors()->toArray());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->tentaikhoan = $request->name;
            $user->email = $request->email;
            $user->matkhau = $request->password;
            $user->manhomquyen = 2;
            $user->trangthai = "Hoạt động";
            $user->save();
            Log::info('User created with ID:', ['user_id' => $user->id]);
            $khachhang = new KhachHang();
            $khachhang->hoten = "Chưa có tên";
            $khachhang->ngaysinh = now();
            $khachhang->sodienthoai = "0211";
            $khachhang->diachi = null;
            $khachhang->hinhdaidien = null;
            $khachhang->maloaikhachhang = 1;
            $khachhang->mataikhoan = $user->id;
            $khachhang->save();
            Session::put('success', 'Đăng kí thành công');
            return redirect()->route('login_view');
        } catch (\Throwable $th) {
            Log::error('Error in registration process:', ['error' => $th->getMessage()]);
            User::where('mataikhoan', $user->id)->delete();
            return redirect()->back()->with('error', 'Đăng kí không thành công');
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email_or_username' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {

                return redirect()->back()->with('error', "Đăng nhập không thành công");
            }
            if (filter_var($request['email_or_username'], FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request['email_or_username'])->first();
            } else {
                $user = User::where('tentaikhoan', $request['email_or_username'])->first();

            }
            if ($user && Hash::check($request['password'], $user->matkhau)) {
                Auth::login($user);
                $request->session()->regenerate(); // Regenerate session for security
                $user =  $request->user();
                Session::put('user', $user);
                if ($user->manhomquyen == 1) {
                    return redirect()->route('dashboard');
                }
                return redirect()->route('home');
            }
            return back()->withErrors([
                'message' => 'Thông tin đăng nhập không chính xác.',
            ])->withInput();
        } catch (\Exception $th) {
            Log::error('Error in registration process:', ['error' => $th->getMessage()]);

            return redirect()->back()->with('error', "Đăng nhập không thành công");
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout(); // Log the user out
            $request->session()->invalidate(); // Invalidate session
            $request->session()->regenerateToken(); // Regenerate CSRF token
            return redirect()->route('login_view');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
