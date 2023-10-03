<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'card_id'=> 'required|integer',
            'total_sum' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'order_number' => 'string|nullable'
        ];
    }
}
