<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            $image = 'nullable';
            $quantity = 'required';
        } else {
            $image = 'required';
            $quantity = 'nullable';
        }

        return [
            'name' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'quantity' => $quantity, 'integer',
            'satuan' => 'required|',
            'image' => $image . '|mimes:jpg,jpeg,png|max:1024',
        ];
    }
}
