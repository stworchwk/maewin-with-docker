<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'username' => 'required|min:5|max:100|unique:users',
                    'password' => 'required|min:5|confirmed',
                    'full_name' => 'required|max:100',
                    'contact' => 'required|max:100'
                ];
            }
            case 'PUT':
            {
                return [
                    'full_name' => 'required|max:100',
                    'contact' => 'required|max:100'
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'username.unique' => 'ชื่อผู้ใช้นี้ซ้ำกันในระบบ',
            'username.required' => 'โปรดกรอกข้อมูลชื่อผุ้ใช้ด้วย',
            'username.min' => 'ชื่อผู้ใช้ควรมากกว่า :min ตัวอักษร',
            'username.max' => 'ชื่อผู้ใช้ไม่ควรเกิน :max ตัวอักษร',
            'password.required' => 'โปรดกรอกรหัสผ่านด้วย',
            'password.min' => 'รหัสผ่านควรมีมากกว่า :min ตัวอักษร',
            'password.confirmed' => 'รหัสผ่านยืนยัน ไม่ตรงกัน!',
            'full_name.required' => 'โปรดกรอกชื่อนามสกุลของผู้ใช้ด้วย',
            'full_name.max' => 'ชื่อนามสกุลของผู้ใช้ไม่ควรเกิน :max ตัวอักษร',
            'contact.required' => 'โปรดกรอกข้อมูลการติดต่อของผู้ใช้ด้วย',
            'contact.max' => 'ข้อมูลการติดต่อของผู้ใช้ไม่ควรเกิน :max ตัวอักษร'
        ];
    }
}
