<?php

namespace App\Http\Controllers;

use App\CheckResponse;
use App\Http\Requests\CheckResponseRequest;
use Illuminate\Http\Request;

class CheckResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($checkRequest_id)
    {
        $data = [
            'checkRequest_id' => $checkRequest_id,
            'checkResponses' => CheckResponse::where('check_request_id', $checkRequest_id)->get(),
        ];
        return view('pages.checkResponses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($checkRequest_id)
    {
        return view('pages.checkResponses.components.create', ['checkRequest_id' => $checkRequest_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckResponseRequest $request, $checkRequest_id)
    {
        $item = new CheckResponse();
        $item->check_request_id = $checkRequest_id;
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        $item->level = $request->input('level');
        $item->skip_time = $request->input('skip_time');
        if ($item->save()) {
            return redirect(route('checkRequests'))->with('success', 'เพิ่มรายการคำตอบแล้ว');
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
            'checkResponse' => CheckResponse::findOrFail($id)
        ];
        return view('pages.checkResponses.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckResponseRequest $request, $id)
    {
        $item = CheckResponse::findOrFail($id);
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        $item->level = $request->input('level');
        $item->skip_time = $request->input('skip_time');
        if ($item->save()) {
            return redirect(route('checkRequests'))->with('success', 'แก้ไขคำตอบแล้ว');
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
        $item = CheckResponse::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('checkRequests'))->with('success', 'ลบคำตอบแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบคำตอบนี้ได้');
        }
    }
}
