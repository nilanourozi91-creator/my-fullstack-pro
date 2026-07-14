<?php

namespace App\Http\Controllers;

use App\Http\Requests\reviewRequsts;
use App\Http\Resources\reviewResoures;
use App\Models\rewiew;
use Carbon\Carbon;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        try {
            $all=rewiew::all()->count();
        return response()->json([
            'data'=>$all,
        ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data'=>'not have review'
                ]);
        }
    }
      
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $prodect = rewiew::create([
              'user_id'=>$request->user_id,
              'rating'=>$request->rating,
              'comment'=>$request->comment,
               'prodect_id'=>$request->prodect_id,
    ]);
       return response()->json([
        'data'=>$prodect->load('prodect','user')
    ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $review = rewiew::with(['prodect','user'])->findOrFail($id);

        return new reviewResoures($review);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $review = rewiew::findOrFail($id);

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
    public function GetCurrentReview(){
       $allreview= rewiew::where('created_at','>=',now())->OrWhere('created_at','<=',Carbon::now()->subDays(30))->count();
        return response()->json([
            'data'=>$allreview
        ]);
    }
    public function GetlatestReview(){
       $allreview= rewiew::where('created_at','<=',Carbon::now()->subDays(30))->OrWhere('created_at','>=',Carbon::now()->subDays(60))->count();
        return response()->json([
            'data'=>$allreview
        ]);
    }
}
