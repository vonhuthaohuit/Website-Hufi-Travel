<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserBEController extends Controller
{
    public function getUsers(Request $request)
    {
        $search = $request->q;

        $usersQuery = User::select('mataikhoan', 'email', 'tentaikhoan');

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('email', 'like', "%$search%")
                    ->orWhere('tentaikhoan', 'like', "%$search%");
            });
        }

        $users = $usersQuery->limit(10)->get();

        return response()->json([
            'items' => $users->map(function ($user) {
                return [
                    'id' => $user->mataikhoan,
                    'text' => $user->email . ' (' . $user->tentaikhoan . ')',
                ];
            }),
            'pagination' => [
                'more' => $users->count() == 10
            ]
        ]);
    }
}
