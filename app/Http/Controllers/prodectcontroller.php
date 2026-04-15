<?php

namespace App\Http\Controllers;

use App\Http\Requests\prodectrequest;
use App\Http\Resources\prodectResourse;
use App\Models\allimges;
use App\Models\Prodect;
use App\Models\ProdectDelallis;
use App\Models\User;
use Illuminate\Http\Request;

class prodectcontroller extends Controller
{
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
    public function store(prodectrequest $request)
    {
         $pro= new Prodect();
        $pro->created(
          [
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
          ]
        );
         $pro->save();
       $prodectd= new ProdectDelallis();
       $prodectd->created([
           'brand'=>$request->brand,
           'addcatagorys'=>$request->addcatagorys,
           'description'=>$request->dsc,
           'prodect_id'=>$pro->id,
       ]);
    //    $prodectd->save();
      $path=null;
      if ($request->hasFile('images')) {
        $path=$request->file('images')->store('public','prodect-img');

        $img= new allimges();
      $img->create([
        'img_url'=>$path,
        'imegeable_id'=>$pro->id,
        'imegeable_type'=>Prodect::class,
      ]);
     $img->save();
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $showbooks= Prodect::findOrFail($id);
       return new prodectResourse($showbooks);
      // return response()->json([
      //   'data'=>$showbooks
      // ]);
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
