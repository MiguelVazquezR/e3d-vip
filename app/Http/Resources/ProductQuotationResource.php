<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductQuotationResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->quotation->currency ." ". number_format($this->total(), 2),
            'is_composed_product' => $this->is_composed_produc ,
            'product_id' => $this->product_id,
            'notes' => $this->notes,
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
        ];
    }
}
