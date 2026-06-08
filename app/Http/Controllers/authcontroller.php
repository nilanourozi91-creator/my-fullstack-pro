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
    //      $request->validate([
    //     'email' => 'required|string|min:5',
    //     'password' =>'required|string|min:5',
    // ]);
      $user=user::all();
      foreach ($user as $u) {
        if($u->email || $request->email && Hash::check($request->password,$u->password)){
            return response()->json([
                'masseges'=>'the user match to user..'. $u->name
            ]);
        }
        return response()->json([
           'data'=>'someting went worng',
        ]);
      }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'email' => 'required|email',
            'password' => 'required|password|min:5',
        ],[
            'email.required'=>'the email is required',
            'password.required'=>'the password is required',
            'email.string'=>'email should be string and incload @ and .com',
            'password.string'=>'email should be string',
            'password.min'=>'the password should be at least 5 chercter',

        ]);
       $user= User::where('email',$request->email)->first();
       if($user || $user->password == $request->password){
           return response()->json([
            'Token'=>$user->createToken('auth_token')->plainTextToken,
               'success'=>true,
           ]);
       }
       else{
        return response()->json([
            'error'=>'somting went worng',
        ]);
       }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        $singleUser = User::findOrFail($id);
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
