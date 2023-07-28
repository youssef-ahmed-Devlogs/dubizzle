<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->descripiton,
            'cover' => $this->getCover(),
            'order' => $this->order,
        ];

        if ($this->parent_id === null)
            $resource['children'] = CategoryResource::collection($this->children());

        return $resource;
    }
}
