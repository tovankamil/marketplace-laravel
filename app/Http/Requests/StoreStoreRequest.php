<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' =>'required|exists:users_id',
            'name' =>'required|string|max:255',
            'logo' =>'required|mimes:png,jpg|max:2048',
            'about'=>'required|string',
            'phone'=>'required|string',
            'address_id'=>'required',
            'city'=>'required|string',
            'address'=>'required|string',
            'postal_code'=>'required|string',
        ];
    }

    public function attributes(){
        return[
            'user_id'=>'User',
            'name'=>'Nama Toko',
            'logo'=>'Toko Logo',
            'about'=>'Tentang  Toko',
            'address_id'=>'Alamat Toko',
            'address'=>'Alamat',
            'postal_code'=>'Kode Pos'
        ];
    }
}
