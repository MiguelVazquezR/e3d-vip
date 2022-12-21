<?php

namespace App\Http\Resources;

use App\Models\SellOrder;
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
            'folio' => 'OV-'.str_pad($this->id, 4, "0", STR_PAD_LEFT),
            'products' => SellOrderedProductResource::collection($this->whenLoaded('sellOrderedProducts')),
            'freight_cost' => $this->freight_cost,
            'status' => match($this->status){
                SellOrder::STATUS_IN_CHECKING => ['text' => 'En revisión', 'style' => 'text-gray-500', 'icon' => 'fa-solid fa-hourglass-half'],
                SellOrder::STATUS_IN_PROCESS => ['text' => 'En proceso', 'style' => 'text-orange-500', 'icon' => 'fa-solid fa-spinner'],
                SellOrder::STATUS_CANCELLED => ['text' => 'Cancelado', 'style' => 'text-red-500', 'icon' => 'fa-solid fa-ban'],
                SellOrder::STATUS_SHIPPED => ['text' => 'Enviado', 'style' => 'text-blue-500', 'icon' => 'fa-solid fa-truck-fast'],
                SellOrder::STATUS_RECEIVED => ['text' => 'Recibido', 'style' => 'text-green-500', 'icon' => 'fa-solid fa-check'],
            },
            'notes' => $this->notes,
            'shipping_company' => $this->shipping_company,
            'tracking_guide' => $this->tracking_guide,
            'user' => $this->user,
            'requirement_date'  => [
                'relative' => $this->requirement_date?->diffForHumans(),
                'string' => $this->requirement_date?->toDateString(),
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
