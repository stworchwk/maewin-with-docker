<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationCategoryRequest extends FormRequest
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
                    'name' => 'required|max:100',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max:100',
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'โปรดกรอกชื่อหมวดหมู่สถานที่ท่องเที่ยวด้วย',
            'name.max' => 'ชื่อหมวดหมู่สถานที่ท่องเที่ยวไม่ควรเกิน :max ตัวอักษร',
        ];
    }
}
