<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'requirement_date' => 'required|date|after:'.now()->addDays(6)->toDateString(),
            'notes' => 'max:200',
            'freight_cost' => 'numeric|max:100000',
            'items' => 'array|min:1',
            'items.*.product_id' => 'required|numeric|min:1',
            'items.*.quantity' => 'required|numeric|min:1',
        ];
    }
}
