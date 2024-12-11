<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function forgetPassword()
    {

        return view('auth.forget-password');
    }

    public function forgetPasswordPost(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('login_view')->with('error', 'Không tìm thấy email của tài khoản');
        }
        $token = \Str::random(40);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('backend.email.link  -resetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset password');
        });
        return redirect()->to(route('auth.forget'))->with("success", "Hãy kiểm tra trong email");
    }

    public function resetPassword($token)
    {
        return view('auth.new-password', compact('token'));
    }


    public function resetPasswordPost(Request $request)
    {
        try {
            $request->validate([
                'new_password' => 'required',
                'confirm_password' => 'required'
            ]);
            if ($request->new_password !== $request->confirm_password)
                return redirect()->route('auth.reset', ['token' => $request->token])->with("error", "Mật khẩu không khớp");

            $tokenRecord = DB::table('password_reset_tokens')->where('token', $request->token)->first();
            if (!$tokenRecord || Carbon::parse($tokenRecord->created_at)->addMinutes(60)->isPast()) {
                return redirect()->route('auth.forget')->with('error', 'Email đã hết hạn.');
            }
            $updatePassword = DB::table('password_reset_tokens')
                ->where([
                    'token' => $request->token
                ])
                ->first();
            if (!$updatePassword) {
                return redirect()->route('auth.reset', ['token' => $request->token])->with("Error", "Invalid");
            }
            User::where("email", $request->email)
                ->update(["matkhau" => Hash::make($request->new_password)]);
            DB::table("password_reset_tokens")->where("email", $request->email)->delete();
            return redirect()->route('login_view')->with("success", "Mật khẩu đã được đặt lại");
        } catch (Exception $e) {

        }
    }
}
