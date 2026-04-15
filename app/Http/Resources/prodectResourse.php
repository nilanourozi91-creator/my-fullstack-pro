<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class prodectResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'name'=>$this->name,
           'stock'=>$this->stock,
           'price'=>$this->price,
           'brand'=>$this->prodect->brand,
           'description'=>$this->prodectD->description,
           'addcatagorys'=>$this->prodectD->addcatagorys,
           'img_url'=>$this->imgall->img_url,           
        ];
    }
}
