<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            "kode_buku"  => "required|max:8",
            "kategori"   => "required|max:50",
            "judul_buku" => "required",
            "desc"       =>  "",
            "stok"       => "numeric",
            "pengarang"  => "required"
        ];
    }
}
