<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\NhanVien;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                    'tentaikhoan' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'matkhau' => bcrypt('123456dumy'),
                    'trangthai' => 'Hoạt động',
                    'manhomquyen' => '1',
                ]);
                Auth::login($newUser);
                Session::put('user', $newUser);
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function register(Request $request)
{
    \Log::info('Register method started');

    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->tentaikhoan = $request->name;
        $user->email = $request->email;
        $user->matkhau = $request->password;
        $user->manhomquyen = 1;
        $user->trangthai = "Hoạt động";
        $user->save();

    \Log::info('User created with ID:', ['user_id' => $user->id]);

        // $nhanvien = new NhanVien();
        // $nhanvien->hoten = $request->name;
        // $nhanvien->gioitinh = null;
        // $nhanvien->ngaysinh = now();
        // $nhanvien->sodienthoai = "0211";
        // $nhanvien->ngayvaolam = now();
        // $nhanvien->hinhdaidien = null;
        // $nhanvien->luong = 0;
        // $nhanvien->maphongban = 1;
        // $nhanvien->mataikhoan = $user->id;
        // $nhanvien->save();

        // \Log::info('NhanVien created successfully');
        Session::put('success', 'Đăng kí thành công');
        return redirect()->route('login_view');
    } catch (\Throwable $th) {
    \Log::error('Error in registration process:', ['error' => $th->getMessage()]);
        return redirect()->back()->with('error', $th->getMessage());
    }
}



    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email_login, 'password' => $request->password_login])) {
                $request->session()->regenerate(); // Regenerate session for security
                $user =  $request->user();
                Session::put('user', $user);
                if($user->manhomquyen == 1)
                    return redirect()->route('home');
                return redirect()->route('dashboard');

            }
            return back()->withErrors([
                'message' => 'Thông tin đăng nhập không chính xác.',
            ])->withInput();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout(); // Log the user out
            $request->session()->invalidate(); // Invalidate session
            $request->session()->regenerateToken(); // Regenerate CSRF token
            Session::put('success', 'Đăng xuất thành công');
            return redirect()->route('login_view');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function create_Info($mataikhoan) {}
}
