<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;

class signUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( string $id)
    {
        // $user=User::findOrFail($id);
        // return response()->json([
        //     'massege'=>'the name user is'.$user->name,
        // ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $user= User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> bcrypt($request->password),
            ]);
            $token=$user->createToken('Auth_token')->plainTextToken;
            return response()->json([
                'Token'=>$token,
                 'status'=>true
            ]);
        }

         catch (\Throwable $error) {
            return response()->json([
                'masseges'=>$error->getMessage(),
                'status'=>false,
            ]);
        }
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
