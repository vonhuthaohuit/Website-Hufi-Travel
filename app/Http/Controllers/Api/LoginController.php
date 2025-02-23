<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Api về login
     */

    public function login(Request $request)
    {
        $this->validate($request, [
            "username" => "",
            "password" => ""
        ]);
        $user = $request->user();
        if ($user->password != $request->password) {
            return response()->json([
                "status" => "error",
                "message" => ""
            ]);
        };
        return response()->json([
            "status"=> "success",
            "message"=> "Login success"
        ]);
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
