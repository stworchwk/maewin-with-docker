<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrefixPhoneNumberRequest;
use App\PrefixPhoneNumber;
use Illuminate\Http\Request;

class PrefixPhoneNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'prefixPhoneNumbers' => PrefixPhoneNumber::all(),
        ];
        return view('pages.manages.prefixPhoneNumbers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manages.prefixPhoneNumbers.components.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrefixPhoneNumberRequest $request)
    {
        $item = new PrefixPhoneNumber();
        $item->prefix = $request->input('prefix');
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        if ($item->save()) {
            return redirect(route('managePrefixPhoneNumbers'))->with('success', 'เพิ่มรหัสโทรศัพท์ของประเทศแล้ว');
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
            'prefixPhoneNumber' => PrefixPhoneNumber::findOrFail($id)
        ];
        return view('pages.manages.prefixPhoneNumbers.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrefixPhoneNumberRequest $request, $id)
    {
        $item = PrefixPhoneNumber::findOrFail($id);
        $item->prefix = $request->input('prefix');
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        if ($item->save()) {
            return redirect(route('managePrefixPhoneNumbers'))->with('success', 'แก้ไขรหัสโทรศัพท์ของประเทศแล้ว');
        } else {
            return back()->withErrors('แก้ไขข้อมูลล้มเหลว');
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
        $item = PrefixPhoneNumber::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('managePrefixPhoneNumbers'))->with('success', 'ลบรหัสโทรศัพท์ของประเทศแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบรหัสโทรศัพท์ของประเทศได้');
        }
    }
}
