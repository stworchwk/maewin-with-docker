<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequestRequest extends FormRequest
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
                    'detail_th' => 'required|max:150',
                    'title_en' => 'required|max:100',
                    'detail_en' => 'required|max:150',
                ];
            }
            case 'PUT':
            {
                return [
                    'title_th' => 'required|max:100',
                    'detail_th' => 'required|max:150',
                    'title_en' => 'required|max:100',
                    'detail_en' => 'required|max:150',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'title_th.required' => 'โปรดกรอกหัวข้อ ข้อความโต้ตอบ(TH) ด้วย',
            'title_th.max' => 'หัวข้อข้อความโต้ตอบ(TH) ไม่ควรเกิน :max ตัวอักษร',
            'detail_th.required' => 'โปรดกรอกรายละเอียด ข้อความโต้ตอบ(TH) ด้วย',
            'detail_th.max' => 'รายละเอียดข้อความโต้ตอบ(TH) ไม่ควรเกิน :max ตัวอักษร',
            'title_en.required' => 'โปรดกรอกหัวข้อ ข้อความโต้ตอบ(EN) ด้วย',
            'title_en.max' => 'หัวข้อข้อความโต้ตอบ(EN) ไม่ควรเกิน :max ตัวอักษร',
            'detail_en.required' => 'โปรดกรอกรายละเอียด ข้อความโต้ตอบ(EN) ด้วย',
            'detail_en.max' => 'รายละเอียดข้อความโต้ตอบ(EN) ไม่ควรเกิน :max ตัวอักษร',
        ];
    }
}
