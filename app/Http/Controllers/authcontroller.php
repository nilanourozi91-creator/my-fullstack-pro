<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class authcontroller extends Controller
{
    use HasApiTokens;
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
   $user=User::where('email',$request->email)->first();
    //  if ($user || $user->password==$request->password) {
        return response()->json([
          'data'=>$user->createToken('auth_token')->plainTextToken,
          'success'=>true
        ]);
    // }
    // else{
    //     return response()->json([
    //         'massege'=>'user not found',
    //         'success'=>false
    //     ]);
//    } 
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // $request->validate([
    //     'email'=>'required|string|min:5',
    //     'password'=>'required|string|min:4',
    // ],[
    //     'email.required'=>'the email is required please enter your email',
    //     'password.required'=>'password is required please enter your password',
    //     'email.min'=>'your email should be at leest 5 chrecter with @ and .com'
    // ]);
    $user= User::where('email',$request->email)->first();
    if ($user || Hash::check($user->password,$request->password)) {
        return response()->json([
          'data'=>$user->createToken('auth_token')->plainTextToken,
          'success'=>true
        ]); 
    }
    else{
        return response()->json([
            'massege'=>'user not found',
            'success'=>false
        ]);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $Token) 
    {
        $singleUser = User::where('remember_token',$Token)->first();
        return response()->json([
            'data' => $singleUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateUser = User::findOrFail($id);

        $updateUser->update($request->all());

        return response()->json([
            'data' => $updateUser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteUser = User::findOrFail($id);

        $deleteUser->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
