<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellOrderResource extends JsonResource
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
            'freight_cost' => $this->freight_cost,
            'status' => $this->status,
            'notes' => $this->notes,
            'shipping_company' => $this->shipping_company,
            'tracking_guide' => $this->tracking_guide,
            'user' => $this->user,
            'requirement_date'  => [
                'relative' => $this->requirement_date?->diffForHumans(),
                'string' => $this->requirement_date?->toDateTimeString(),
                'special' => $this->requirement_date?->isoFormat('DD MMM, YYYY'),
            ],
            'received_at'  => [
                'relative' => $this->received_at?->diffForHumans(),
                'string' => $this->received_at?->toDateTimeString(),
                'special' => $this->received_at?->isoFormat('DD MMM, YYYY'),
            ],
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
        ];
    }
}
