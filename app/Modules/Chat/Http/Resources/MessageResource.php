<?php

namespace App\Modules\Chat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        if (!is_null($this->customer_id)) {
            $author = $this->customer;
            $from = 'customer';
        } else {
            $author = $this->employee;
            $from = 'employee';
        }

        return [
            'id'         => $this->id,
            'created_at' => $this->created_at->format('H:i:s d.n.Y'),
            'created_at_iso' => $this->created_at->format('Y-m-d H:i:s'),
            'content'    => $this->content,
            'read'       => $this->read,
            'from'       => $from,
            'author'     => $author
        ];
    }
}
