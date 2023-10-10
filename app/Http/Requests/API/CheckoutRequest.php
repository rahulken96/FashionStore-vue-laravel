<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama'                => 'required|string|max:255',
            'email'               => 'required|string|email:rfc,dns',
            'noHP'                => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'alamat'              => 'required|string',
            'total_transaksi'     => 'required|numeric',
            'status_transaksi'    => 'nullable|numeric|in:0,1,2',
            'detail_transaksi'    => 'required|array',
            'detail_transaksi.*'  => 'numeric|exists:products,produk_id',
        ];
    }
}
