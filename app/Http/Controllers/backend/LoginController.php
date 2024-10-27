<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function register(Request $request)
    // {
    //     try
    //     {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string',
    //             'password' => 'required|string',
    //             'email' => 'required|email|unique:Users,email',
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'message' => ' Lỗi xác thực',
    //                 'errors' => $validator->errors(),
    //                 'status' => false
    //             ], 403);
    //         }

    //         $user = new User() ;
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = $request->password;
    //         $user->nhomquyen_id = 1;
    //         $user->status = "Hoạt động";
    //         $user->save();
    //         $token = $user->createToken($user->id)->plainTextToken;
    //         return response()->json([
    //             'token'=>$token
    //         ]) ;
    //     }
    //     catch(\Throwable $th)
    //     {
    //         if ($th instanceof ValidationException) {
    //             return response()->json([
    //                 'error' => $th->validator->errors() // Sửa lại phần này
    //             ], Response::HTTP_BAD_REQUEST); // Sửa lại phần này
    //         }
    //         return response()->json([
    //             'error' => $th->getMessage()
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR); // Sửa lại phần này
    //     }
    // }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hash password
            $user->nhomquyen_id = 1;
            $user->status = "Hoạt động";
            $user->save();

            Auth::login($user); // Login user after registration

            return redirect()->route('home')->with('success', 'Đăng ký thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function login(Request $request)
    {
        try
        {
            $request->validate([
                'email'=>'required|string',
                'password'=>'required|string',
                ]
            );
            $user = User::where('email',$request->email)->first() ;
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email'=>['The provider credentials are incorrect'],
                ]);
            }

            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'token'=>$token
            ]) ;
        }
        catch(\Throwable $th)
        {
            if ($th instanceof ValidationException) {
                return response()->json([
                    'error' => $th->validator->errors() // Sửa lại phần này
                ], Response::HTTP_BAD_REQUEST); // Sửa lại phần này
            }
            return response()->json([
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // Sửa lại phần này
        }
    }

    public function logout(Request $request)
{
    try
    {
        // Kiểm tra xem người dùng đã được xác thực chưa
        if (!$request->user()) {
            return response()->json([
                'error' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Xóa token truy cập hiện tại
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout access'
        ]);
    }
    catch (\Throwable $th)
    {
        return response()->json([
            'error' => $th->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}



}
