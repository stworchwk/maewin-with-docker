<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationImageRequest extends FormRequest
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
                    'title_th' => 'required|max:100',
                    'title_en' => 'required|max:100',
                ];
            }
            case 'PUT':
            {
                return [
                    'title_th' => 'required|max:100',
                    'title_en' => 'required|max:100',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'title_th.required' => 'โปรดกรอกหัวข้อคำอธิบายภาพ(TH) ด้วย',
            'title_th.max' => 'หัวข้อคำอธิบายภาพ(TH) ไม่ควรเกิน :max ตัวอักษร',
            'title_en.required' => 'โปรดกรอกหัวข้อคำอธิบายภาพ(EN) ด้วย',
            'title_en.max' => 'หัวข้อคำอธิบายภาพ(EN) ไม่ควรเกิน :max ตัวอักษร',
        ];
    }
}
