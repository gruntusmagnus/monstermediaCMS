<?php

namespace App\Modules\Order\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'timestamp' => $this->created_at->format('H:i:s d.n.Y'),
            //'customer' => $this->user()->email,
            'table_number' => $this->table_number,
            'total_sum' => $this->total_sum,
            //'payment' => $this->payment()->name

        ];
    }
}
