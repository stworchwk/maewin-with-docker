<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelerRequest;
use App\Nationality;
use App\PrefixPhoneNumber;
use App\Traveler;
use Illuminate\Http\Request;

class TravelerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'travelers' => Traveler::all(),
        ];
        return view('pages.travelers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'nationalities' => Nationality::pluck('name_th', 'id'),
            'prefixPhoneNumbers' => PrefixPhoneNumber::pluck('prefix', 'id'),
        ];
        return view('pages.travelers.components.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelerRequest $request)
    {
        $item = new Traveler();
        $item->email = $request->input('email');
        $item->password = bcrypt($request->input('password'));
        $item->full_name = $request->input('full_name');
        $item->nationality_id = $request->input('nationality_id');
        $item->prefix_phone_number_id = $request->input('prefix_phone_number_id');
        $item->phone_number = $request->input('phone_number');
        $item->id_card = $request->input('id_card');
        $item->active = 1;
        if ($item->save()) {
            return redirect(route('travelers'))->with('success', 'เพิ่มข้อมูลนักท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('เพิ่มข้อมูลล้มเหลว');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'traveler' => Traveler::findOrFail($id),
            'nationalities' => Nationality::pluck('name_th', 'id'),
            'prefixPhoneNumbers' => PrefixPhoneNumber::pluck('prefix', 'id'),
        ];
        return view('pages.travelers.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelerRequest $request, $id)
    {
        $item = Traveler::findOrFail($id);
        $item->email = $request->input('email');
        $item->password = $request->input('password');
        $item->full_name = $request->input('full_name');
        $item->nationality_id = $request->input('nationality_id');
        $item->prefix_phone_number_id = $request->input('prefix_phone_number_id');
        $item->phone_number = $request->input('phone_number');
        $item->id_card = $request->input('id_card');
        if ($item->save()) {
            return redirect(route('travelers'))->with('success', 'แก้ไขข้อมูลนักท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('แก้ไขข้อมูลล้มเหลว');
        }
    }

    public function passwordUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|string|min:6|confirmed'
            ],
            [
                'password.required' => 'โปรดกรอกรหัสผ่านด้วย',
                'password.confirmed' => 'โปรดกรอกรหัสผ่านให้ตรงกันด้วย',
                'password.min' => 'รหัสผ่านควรมากกว่า :min ตัวอักษร'
            ]);

        $item = Traveler::findOrFail($id);
        $item->password = bcrypt($request->input('password'));
        if ($item->save()) {
            return redirect(route('travelers'))->with('success', 'รีเซ็ทรหัสผ่านผู้ใช้แล้ว');
        } else {
            return back()->withErrors('ระบบทำงานขัดข้อง');
        }
    }

    public function active($id)
    {
        $item = Traveler::findOrFail($id);
        $item->active = ($item->active == 0) ? 1 : 0;
        if ($item->save()) {
            return redirect(route('travelers'))->with('success', (($item->active == 0) ? 'ระงับบัญชีนี้แล้ว' : 'เปิดการใช้งานแล้ว'));
        } else {
            return back()->withErrors('ระบบทำงานขัดข้อง');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Traveler::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('travelers'))->with('success', 'ลบข้อมูลนักท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบข้อมูลนักท่องเที่ยวได้');
        }
    }
}
