<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class staffRequest extends FormRequest
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
            'name' => 'required',
            'hourly_wage' => 'required',
            //
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'スタッフ名',
            'hourly_wage' => '時給',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください',
            'hourly_wage.required' => ':attributeを入力してください',
        ];
    }
}
