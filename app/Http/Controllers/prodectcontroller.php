<?php

namespace App\Http\Controllers;

use App\Http\Requests\prodectrequest;
use App\Http\Requests\updeteprodectRequest;
use App\Http\Resources\ProdectResource;
use App\Http\Resources\prodectResourse;
use App\Http\Resources\ProductResource;
use App\Models\allimges;
use App\Models\Prodect;
use App\Models\ProdectDelallis;
use App\Models\User;
use Illuminate\Http\Request;

class prodectcontroller extends Controller
{
        protected $fillable=[
           'name',
           'price',
           'stock',
        ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $allpro= Prodect::with('prodectD','imgall')->get();
        return response()->json([
           'data'=>$allpro
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $pro = Prodect::create([
        'name' => $request->name,
        'price' => $request->price,
        'stock' => $request->stock,
    ]);

    // Create product details
    ProdectDelallis::create([
        'brand' => $request->brand,
        'addcatagorys' => $request->addcatagorys,
        'description' => $request->description,
        'pro_id' => $pro->id,
    ]);

    // Upload image
    if ($request->hasFile('images')) {
        $path = $request->file('images')->store('prodect-img', 'public');

        allimges::create([
            'img_url' => $path,
            'imegeable_id' => $pro->id,
            'imegeable_type' => Prodect::class,
        ]);
    }

    return response()->json([
        'message' => 'Product created successfully',
        'product_id' => $pro->id
    ]);
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $showbooks= Prodect::findOrFail($id);
       return new prodectResourse($showbooks);
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updeteprodectRequest $request, string $id)
    {
           $proall= Prodect::findOrFail($id)->get();
           $proall->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
           ]);
           $proall->save();

         $prodectDetills=ProdectDelallis::where('pro_id',$pro_id)->frist();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
