<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class reviewResoures extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment'=>$this->comment,
            'rating'=>$this->rating,
            'prodect_name'=>$this->prodect?->name,
            'user'=>$this->user?->name,
            'email'=>$this->user?->email,
            'prodect_id'=>$this->prodect?->id,
             
        ];
    }
}
