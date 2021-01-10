<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrefixPhoneNumberRequest extends FormRequest
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
                    'prefix' => 'required|max:5',
                    'name_th' => 'required|max:100',
                    'name_en' => 'required|max:100',
                ];
            }
            case 'PUT':
            {
                return [
                    'prefix' => 'required|max:5',
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
            'prefix.required' => 'โปรดกรอกรหัสโทรศัพท์ประเทศด้วย',
            'prefix.max' => 'รหัสโทรศัพท์ประเทศไม่ควรเกิน :max ตัวอักษร',
            'name_th.required' => 'โปรดกรอกชื่อประเทศภาษาไทยด้วย',
            'name_th.max' => 'ชื่อประเทศภาษาไทยไม่ควรเกิน :max ตัวอักษร',
            'name_en.required' => 'โปรดกรอกชื่อประเทศภาษาอังกฤษด้วย',
            'name_en.max' => 'ชื่อประเทศภาษาอังกฤษไม่ควรเกิน :max ตัวอักษร',
        ];
    }
}
