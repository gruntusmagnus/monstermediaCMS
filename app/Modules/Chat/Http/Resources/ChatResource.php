<?php

namespace App\Modules\Chat\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'created_at' => $this->created_at->format('H:i:s d.n.Y'),
            'is_active' => $this->is_active,
            'customer' => UserResource::make($this->customer)
        ];
    }
}
