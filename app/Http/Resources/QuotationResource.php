<?php

namespace App\Http\Resources;

use App\Models\Quotation;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $total = $this->products->sum(function($product) {
            return $product->quantity * $product->price;
        });

        return [
            'id' => $this->id,
            'folio' => 'VIPC-'.str_pad($this->id, 4, "0", STR_PAD_LEFT),
            'user' => $this->whenLoaded('user'),
            'seller' => $this->whenLoaded('seller'),
            'products' => $this->whenLoaded('products'),
            'total' => $total ? $this->currency ." ". number_format($total, 2) : '---',
            'released_at' => $this->released_at?->isoFormat('DD MMM, YYYY - hh:mm a'),
            'status' => match($this->status){
                Quotation::STATUS_IN_CHECKING => ['code' => Quotation::STATUS_IN_CHECKING, 'text' => 'En revisión', 'style' => 'text-gray-500', 'icon' => 'fa-solid fa-hourglass-half'],
                Quotation::STATUS_GENERATED => ['code' => Quotation::STATUS_GENERATED, 'text' => 'Esperando su aprovación', 'style' => 'text-orange-500', 'icon' => 'fa-solid fa-ellipsis'],
                Quotation::STATUS_APPROVED => ['code' => Quotation::STATUS_APPROVED, 'text' => 'Aprobado', 'style' => 'text-green-500', 'icon' => 'fa-solid fa-check'],
            },
            'freight_cost' => $this->freight_cost ? $this->currency ." ". number_format($this->freight_cost, 2) : '---',
            'tooling_cost' => $this->tooling_cost ? $this->currency ." ". number_format($this->tooling_cost, 2) : '---',
            'currency' => $this->currency,
            'first_production_days' => $this->first_production_days,
            'created_at' => $this->created_at->isoFormat('DD MMM, YYYY - hh:mm a'),
        ];
    }
}
