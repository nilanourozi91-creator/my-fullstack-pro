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
            'id' => $this->id,

            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price,

            // FIX: correct relationship
            'brand' => $this->prodectD?->brand,
            'description' => $this->prodectD?->description,
            'categories' => $this->prodectD?->addcatagorys,

            // FIX: collection of images
            'images' => $this->imgall?->pluck('img_url'),
        ];
    }
}
