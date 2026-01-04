<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' =>'required|exists:users,id',
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
    // app/Http/Requests/StoreStoreRequest.php

public function messages(): array
{
    // Menggunakan key kolom.aturan untuk mengganti pesan
    return [
        'user_id.required' => 'Kolom User wajib diisi.',
        'user_id.exists' => 'User yang dipilih tidak valid atau tidak ditemukan.',
        'name.required' => 'Kolom Nama Toko wajib diisi.',
        'logo.required' => 'Kolom Logo Toko wajib diunggah.',
        'logo.mimes' => 'Logo harus berupa file bertipe PNG atau JPG.',
        'logo.max' => 'Ukuran file Logo maksimal 2MB.',
        'about.required' => 'Kolom Tentang Toko wajib diisi.',
        'phone.required' => 'Kolom Telepon wajib diisi.',
        'address_id.required' => 'Kolom ID Alamat wajib diisi.',
        'city.required' => 'Kolom Kota wajib diisi.',
        'address.required' => 'Kolom Alamat wajib diisi.',
        'postal_code.required' => 'Kolom Kode Pos wajib diisi.',
    ];
}
}
