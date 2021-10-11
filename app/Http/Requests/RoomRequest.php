<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'type_room' => 'required',
            'type_bed' => 'required',
            'total' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type_room.required' => 'Tipe Kamar wajib diisi.',
            'type_bed.required' => 'Tipe Kasur wajib diisi.',
            'total.required' => 'Total Kamar wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.'
        ];
    }
}
