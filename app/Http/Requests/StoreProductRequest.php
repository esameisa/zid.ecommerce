<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'store_id' => ['required', 'integer', Rule::exists('stores', 'id')->where('merchant_id', auth()->user()->id)],
            'name' => 'required|string|max:255',
            'vat_type' => 'required|string|in:included,calculated',
            'vat_percentage' => 'required_if:vat_type,calculated|numeric|min:0|max:100',
            'shipping_cost' => 'numeric|min:0'
        ];
    }
}
