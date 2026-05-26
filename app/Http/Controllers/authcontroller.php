<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $request->validate([
        //   'email'=>'required|string|min:3',
        //   'password'=>'required|string|min:4',
        // ]);
        // $founduser=User::all();
        // foreach ($founduser as $newuser) {
        //     if ($newuser->email==$request->email && Hash::check($request->password,$newuser->password)) {
        //         return response()->json([
        //             'data'=>'the user matches to user'.$newuser->name,
        //         ]);
        //     }
        //     else{
        //         return response()->json([
        //             'data'=>'the user not matches to user.....'.$newuser->name,
        //         ]);
        //     }
        // }
        $user = User::where('email', $request->email)->first();

if ($user && Hash::check($request->password, $user->password)) {

    return response()->json([
        'data' => 'the user matches to user ' . $user->name,
    ]);
}

return response()->json([
    'data' => 'User not found',
], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
      
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
