<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class destinationRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string|max:255',
            'creator_id' => 'required|numeric|exists:users,id',
        ];
    }


    public function messages(){

        return [
            "required" => "This Field Is Required",
            "string"=>"Thit Field Must Be String",
            "max"=>"This Field Can not Exceed 255 Characters",
            "creator_id.exists" => "Creator Should Be Exist"
        ];
    }
}
