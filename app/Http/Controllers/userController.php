<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $all=User::where('users','client')->get();
      return response()->json([
            'data'=>$all
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            // 'users'->$request->users,
            'password'=>bcrypt($request->password),
        ]);
        return response()->json([
            'data'=>$user,
            'stutus'=>true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::findOrFail($id);
        return response()->json([
        'data'=>$user,
        'success'=>true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $customer = User::findOrFail($id);

    $customer->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);

    return response()->json([
        'message' => 'Customer updated successfully',
        'data' => $customer,
    ]);
   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $userd=User::findOrFail($id);
       $userd->delete();
       return response()->json([
        'data'=>'the user'.$userd.'deleted',
      'status'=> true,
       ]);
    }

    public function LatestCustomers(){
       $all =User::where('created_at','<=',Carbon::now()->subDays(30))->OrWhere('created_at','=>',Carbon::now()->subDays(60))->count();
         return response()->json([
            'data'=>$all
         ]);      
    }
    // get all user
    public function CurrentCustomers(){
       $all =User::where('created_at','<=',now())->OrWhere('created_at','>=',Carbon::now()->subDays(30))->count();
         return response()->json([
            'data'=>$all
         ]);      
    }
}
