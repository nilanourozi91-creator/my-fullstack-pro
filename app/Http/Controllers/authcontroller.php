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
    public function index()
    {
        $user=User::all();
        return response()->json([
            'data'=>$user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $makeUser= User::create([
          'name'=>$request->name,
          'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]);
        return response()->json([
          'data'=>$makeUser
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $singleUser=User::findOrfail($id);
        return response()->json([
            'data'=>$singleUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateuser=User::findOrFail($id);
        $updateuser->update($request->all());
        return response()->json([
            'data'=>$updateuser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $deleteuser=User::findOrfail($id);
       $deleteuser->delete();
       return response()->json([
         'massege'=>$deleteuser.'deleted'
       ]);
    }
}
