<?php

namespace App\Http\Controllers;

use App\CheckRequest;
use App\Http\Requests\CheckRequestRequest;
use Illuminate\Http\Request;

class CheckRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'checkRequests' => CheckRequest::all(),
        ];
        return view('pages.checkRequests.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.checkRequests.components.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckRequestRequest $request)
    {
        $item = new CheckRequest();
        $item->title_th = $request->input('title_th');
        $item->title_en = $request->input('title_en');
        $item->detail_th = $request->input('detail_th');
        $item->detail_en = $request->input('detail_en');
        if ($item->save()) {
            return redirect(route('checkRequests'))->with('success', 'เพิ่มข้อความโต้ตอบแล้ว');
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
            'checkRequest' => CheckRequest::findOrFail($id)
        ];
        return view('pages.checkRequests.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckRequestRequest $request, $id)
    {
        $item = CheckRequest::findOrFail($id);
        $item->title_th = $request->input('title_th');
        $item->title_en = $request->input('title_en');
        $item->detail_th = $request->input('detail_th');
        $item->detail_en = $request->input('detail_en');
        if ($item->save()) {
            return redirect(route('checkRequests'))->with('success', 'แก้ไขข้อความโต้ตอบแล้ว');
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
        $item = CheckRequest::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('checkRequests'))->with('success', 'ลบข้อความโต้ตอบแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบข้อความโต้ตอบได้');
        }
    }
}
