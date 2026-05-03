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
use Illuminate\Support\Facades\Storage;

class prodectcontroller extends Controller
{
        protected $fillable=[
           'name',
           'price',
           'stock',
           'img_url',

        
        ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
       $allprodect=Prodect::with(['img','prodectD'])->get();
       return response()->json([
        'data'=>$allprodect
        
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(prodectrequest $request)
     {
      public function store(prodectrequest $request)
{
    $prodect = Prodect::create([
        'name'=>$request->name,
        'price'=>$request->price,
        'stock'=>$request->stock,
    ]);

    $prodect->prodectD()->create([
        'description'=>$request->description,
        'brand'=>$request->brand,
        'addcatagorys'=>$request->addcatagorys,
    ]);

    $images = [];

    if ($request->hasFile('img1')) {
        $images[] = ['img_url' => $request->file('img1')->store('prodect_img','public')];
    }

    if ($request->hasFile('img2')) {
        $images[] = ['img_url' => $request->file('img2')->store('prodect_img','public')];
    }

    if (!empty($images)) {
        $prodect->imgall()->createMany($images);
    }

    return response()->json([
        'data'=>$prodect->load('prodectD','imgall')
    ]);
}
     }
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //    $showbooks= Prodect::FindOrFail($id)->with(['imgall','prodectD'])->get();
    //    return response()->json([
    //     'data'=>$showbooks,
    //      'masssege'=>'data get it secssfully'
    //    ]);
    // }

      public function show( Prodect $prodect)
    {
       $prodect->load(['imgall','prodectD']);
        return response()->json([
            'data'=>$prodect
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updeteprodectRequest $request, string $id)
    {
         try {
            $request->validate([
                'name'=>'nullable|string|min:3',
                'stock'=>'nullable|string|min:3',
                'price'=>'nullable|numeric|min:20',
                'addcatagorys'=>'nullable|string|min:3',
                'brand'=>'nullable|string|min:3',
                'desecription'=>'nullable|string|min:4',
                'img1'=>'nullable|image|mimes:jpg,jpag,png,gif,webp',
                'img2'=>'nullable|image|mimes:jpg,jpag,png,gif,webp',
            ]);
            $prodect=Prodect::findOrfail($id);
            $prodect->update([
              'name'=>$request->name,
              'stock'=>$request->stock,
              'price'=>$request->price,
            ]);
               $prodect->ProdectDelallis->update([
                  'brand'=>$request->brand,
                  'desecription'=>$request->desecription,
                  ' addcatagorys'=>$request->addcatagorys,
               ]);
               $imgpath1=null;
               $imgpath2=null;
               if ($request->hasFile('img1')&& $request->hasFile('img2')) {
                 $imgpath1=$request->file('img1')->store('prodect_img','public');
                 $imgpath1=$request->file('img1')->store('prodect_img','public');
                 foreach ($prodect as $imgall => $img) {
                    if (Storage::disk('public')->exists($img->img_url)) {
                        Storage::disk('public')->delete($img->img_url);
                    }
                 }
                 $prodect->allimges()->delete();
                 $prodect->imgall()->create([
                       ['img_url'=>$imgpath1],
                       ['img_url'=>$imgpath2],
                 ]);
               }
                 $prodect->load('prodectD',' imgall');
                 return new prodectResourse($prodect);

         } catch (\Throwable $th) {
            //throw $th;
         }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $pro=Prodect::findOrFail($id);
    //    $pro->load('prodectD',' imgall');
       $pro->delete();
       $pro->ProdectDelallis()->delete();
       foreach ($pro->imgall as $img) {
        if(storage::disk('public')->exists($img->img_url)){
          Storage::disk('public')->delete($img->img_url);
        }
       
       }    
        $pro->imgall()->delete();
        return response()->json([
            'data'=>$pro,
            'massege'=>'prodeactdeleted secssafuly'
        ]);
    }
}
