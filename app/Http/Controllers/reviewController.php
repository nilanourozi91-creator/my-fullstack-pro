<?php

namespace App\Http\Controllers;

use App\Http\Requests\reviewRequsts;
use App\Http\Resources\reviewResoures;
use App\Models\rewiew;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allrevewies=rewiew::all();
        return response()->json([
            'data'=>$allrevewies->load(['prodect','user'])
        ]);
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
}
