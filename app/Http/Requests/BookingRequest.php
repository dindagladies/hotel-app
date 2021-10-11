<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        $todayDate = date('m/d/Y');

        return [
            'room' => 'required',
            'data_user' => 'required',
            'checkout' => 'required|date|date_format:Y-m-d|after:checkin',
            'checkin' => 'required|date|date_format:Y-m-d|after_or_equal:'.$todayDate,
            'status' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'data_user.required' => 'Data Customer wajib diisi.',
            'checkin.required' => 'Tanggal checkin wajib diisi.',
            'checkout.required' => 'Tanggal checkout wajib diisi.',
            'checkin.after_or_equal' => 'Tanggal harus sama atau lebih dari tanggal hari ini',
            'checkout.after' => 'Tanggal tidak boleh sebelum tanggal checkin'
        ];
    }
}
