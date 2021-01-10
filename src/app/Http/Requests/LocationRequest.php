<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
                    'code' => 'required|max:20',
                    'title_th' => 'required|max:100',
                    'title_en' => 'required|max:100',
                    'latitude' => 'required|max:50',
                    'longitude' => 'required|max:50',
                    'destination_latitude' => 'required|max:50',
                    'destination_longitude' => 'required|max:50'
                ];
            }
            case 'PUT':
            {
                return [
                    'code' => 'required|max:20',
                    'title_th' => 'required|max:100',
                    'title_en' => 'required|max:100',
                    'latitude' => 'required|max:50',
                    'longitude' => 'required|max:50',
                    'destination_latitude' => 'required|max:50',
                    'destination_longitude' => 'required|max:50'
                ];
            }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'code.required' => 'โปรดกรอกรหัสสถานที่ท่องเที่ยวด้วย',
            'code.max' => 'รหัสสถานที่ท่องเที่ยวไม่ควรเกิน :max ตัวอักษร',
            'title_th.required' => 'โปรดกรอกชื่อสถานที่ท่องเที่ยว(TH) ด้วย',
            'title_th.max' => 'ชื่อสถานที่ท่องเที่ยว(TH) ไม่ควรเกิน :max ตัวอักษร',
            'title_en.required' => 'โปรดกรอกชื่อสถานที่ท่องเที่ยว(EN) ด้วย',
            'title_en.max' => 'ชื่อสถานที่ท่องเที่ยว(EN) ไม่ควรเกิน :max ตัวอักษร',
            'latitude.required' => 'ตำแหน่งสถานที่ท่องเที่ยวควรมีข้อมูล',
            'latitude.max' => 'ตำแหน่งสถานที่ท่องเที่ยวไม่ถูกต้อง',
            'longitude.required' => 'ตำแหน่งสถานที่ท่องเที่ยวควรมีข้อมูล',
            'longitude.max' => 'ตำแหน่งสถานที่ท่องเที่ยวไม่ถูกต้อง',
            'destination_latitude.required' => 'ตำแหน่งสถานที่ท่องเที่ยวควรมีข้อมูล',
            'destination_latitude.max' => 'ตำแหน่งสถานที่ท่องเที่ยวไม่ถูกต้อง',
            'destination_longitude.required' => 'ตำแหน่งสถานที่ท่องเที่ยวควรมีข้อมูล',
            'destination_longitude.max' => 'ตำแหน่งสถานที่ท่องเที่ยวไม่ถูกต้อง',
        ];
    }
}
