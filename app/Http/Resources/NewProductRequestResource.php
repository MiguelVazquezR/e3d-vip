<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewProductRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'authorized_at' => $this->authorized_at?->isoFormat('DD MMM, YYYY - hh:mm a'),
            'created_at' => $this->created_at->isoFormat('DD MMM, YYYY - hh:mm a'),
            'user' => $this->whenLoaded('user'),
            'media' => $this->getMedia()->all(),
        ];
    }
}
