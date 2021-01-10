<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelerRequest extends FormRequest
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
                    'email' => 'required|email|unique:travelers',
                    'password' => 'required|min:6|confirmed',
                    'full_name' => 'required|max:100',
                    'phone_number' => 'required',
                    'id_card' => 'required|max:20',
                ];
            }
            case 'PUT':
            {
                return [
                    'full_name' => 'required',
                    'phone_number' => 'required',
                    'id_card' => 'required|max:20',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'email.unique' => 'อีเมลนี้มีอยู่ในระบบแล้ว',
            'email.required' => 'โปรดกรอกอีเมลด้วย',
            'email.max' => 'อีเมลไม่ควรเกิน :max ตัวอักษร',
            'password.required' => 'โปรดกรอกรหัสผ่านด้วย',
            'password.min' => 'รหัสผ่านควรมีมากกว่า :min ตัวอักษร',
            'password.confirmed' => 'รหัสผ่านยืนยัน ไม่ตรงกัน!',
            'full_name.required' => 'โปรดกรอกชื่อนามสกุลของนักท่องเที่ยวด้วย',
            'full_name.max' => 'ชื่อนามสกุลของนักท่องเที่ยวไม่ควรเกิน :max ตัวอักษร',
            'phone_number.required' => 'โปรดกรอเบอร์โทรศัพท์ด้วย',
            'phone_number.numeric' => 'เบอร์โทรศัพท์ควรเป็นตัวเลขเท่านั้น',
            'id_card.required' => 'โปรดกรอกรหัสประจำตัวนักท่องเที่ยวด้วย',
            'id_card.max' => 'รหัสประจำตัวนักท่องเที่ยวไม่ควรเกิน :max ตัวอักษร',
            'id_card.numeric' => 'รหัสประจำตัวนักท่องเที่ยวควรเป็นตัวเลขเท่านั้น',
        ];
    }
}
