<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:10',
            'street' => 'required',
        ];
    }
    public function messages()
    {
      return[
          'name.required'=>"Hotel must have name",
          'name.min'=>'Hotel name should be at least 10 chars',
          'street.required'=>"Hotel must have Street",
      ];
    }
}
