<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckResponseRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name_th' => 'required|max:100',
                    'name_en' => 'required|max:100',
                    'level' => 'required',
                    'skip_time' => 'required|numeric',
                ];
            }
            case 'PUT':
            {
                return [
                    'name_th' => 'required|max:100',
                    'name_en' => 'required|max:100',
                    'level' => 'required',
                    'skip_time' => 'required|numeric',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name_th.required' => 'โปรดกรอกชื่อรายการคำตอบ(TH) ด้วย',
            'name_th.max' => 'ชื่อรายการคำตอบ(TH) ไม่ควรเกิน :max ตัวอักษร',
            'name_en.required' => 'โปรดกรอกชื่อรายการคำตอบ(EN) ด้วย',
            'name_en.max' => 'ชื่อรายการคำตอบ(EN) ไม่ควรเกิน :max ตัวอักษร',
            'level.required' => 'โปรดเลือกระดับของคำตอบด้วย',
            'skip_time.required' => 'โปรดเลือกเวลาที่จะเลื่อนเวลา',
            'skip_time.numeric' => 'เวลาที่เลื่อน จะต้องเป็นตัวเลขเท่านั้น',
        ];
    }
}
