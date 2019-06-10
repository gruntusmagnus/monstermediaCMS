<?php

namespace App\Modules\Catalog\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'code'  => $this->code,
            'ean'  => $this->ean,
            'name' => $this->getTranslation()->name,
            'description' => $this->getTranslation()->description,
            'slug' => $this->getTranslation()->slug,
            'quantity'  => $this->quantity,
            'price'  => $this->price,
            'price_user'  => $this->getPrice(), //koncová cena pro zákazníka - vč. slev a DPH
            'vat_id'  => $this->vat_id,
            'active'    => $this->active

            //'category' => $this->category()->getTranslation()->name
        ];
    }
}
