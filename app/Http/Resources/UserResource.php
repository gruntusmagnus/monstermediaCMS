<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'            => $this->id,
            'firstname'     => $this->firstname,
            'lastname'      => $this->lastname,
            'email'         => $this->email,
            /*'sex'           => $this->sex,
            'date_birth'    => $this->date_birth,
            'company_id'    => $this->company_id,
            'vat_number'    => $this->vat_number,
            'vat_number_2'  => $this->vat_number_2,
            'data_birth'    => $this->date_birth,
            'language_id'   => $this->id_language,
            'points'        => $this->points,
            'gdpr'          => $this->gdpr,
            'note'          => $this->note*/
        ];
    }
}
