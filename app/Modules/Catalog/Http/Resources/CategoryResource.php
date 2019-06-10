<?php

namespace App\Modules\Catalog\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->getTranslation()->name,
            'description' => $this->getTranslation()->description,
            'position'  => $this->position,
            'active'    => $this->active,
            'slug' => $this->getTranslation()->slug,
            'subcategories' => CategoryResource::collection($this->subcategories)
        ];
    }
}
