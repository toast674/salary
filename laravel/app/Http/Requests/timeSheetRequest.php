<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class timeSheetRequest extends FormRequest
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
            //
            'workday' => 'required',
            'work_start_hour' => 'required',
            'work_start_minute' => 'required',
            'work_end_minute' => 'required',
            'work_end_hour' => [
                'required',
                function($attribute, $value, $fail) {
                    $work_start = Carbon::parse($this->ConvertStringToTime($this->work_start_hour, $this->work_start_minute));
                    $work_end = Carbon::parse($this->ConvertStringToTime($this->work_end_hour, $this->work_end_minute));
                    if($work_end < $work_start) {
                        $fail('退勤時間は出勤時間より後にしてください。');
                    }
                },
            ]
        ];
    }

    public function attributes()
    {
        return [
            'workday' => '日付',

        ];
    }

    public function messages()
    {
        return [
            'workday.required' => ':attributeを入力してください',
        ];
    }

    private function ConvertStringToTime($hour, $minute) {
        return $hour . ':' . $minute . ':00';
    }
}
