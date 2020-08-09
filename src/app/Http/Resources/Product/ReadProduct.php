<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadProduct extends JsonResource
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
            'total' => $this->total,
            'per_page' => $this->per_page,
            'current_page' => $this->current_page,
            'last_page' => $this->last_page,
            'first_page_url' => $this->first_page_url,
            'next_page_url' => $this->next_page_url,
            'prev_page_url' => $this->prev_page_url,
            'path' => $this->path,
            'from' => $this->from,
            'to' => $this->to,
            'data' => $this->data,
        ];
    }
}
