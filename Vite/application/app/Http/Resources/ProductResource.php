<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'image_url'=> $this->image,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'price'=> $this->price,
            'created_by'=> $this->created_by,
            'updated_by'=> $this->updated_by,
            'updated_at'=> (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'created_at'=> (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),

        ];
    }
}
