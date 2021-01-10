<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
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
                ];
            }
            case 'PUT':
            {
                return [
                    'name_th' => 'required|max:100',
                    'name_en' => 'required|max:100',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name_th.required' => 'โปรดกรอกชื่อสัญชาติ(TH) ด้วย',
            'name_th.max' => 'ชื่อสัญชาติ(TH) ไม่ควรเกิน :max ตัวอักษร',
            'name_en.required' => 'โปรดกรอกชื่อสัญชาติ(EN) ด้วย',
            'name_en.max' => 'ชื่อสัญชาติ(EN) ไม่ควรเกิน :max ตัวอักษร',
        ];
    }
}
