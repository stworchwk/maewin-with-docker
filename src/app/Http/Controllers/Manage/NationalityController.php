<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalityRequest;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'nationalities' => Nationality::all(),
        ];
        return view('pages.manages.nationalities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manages.nationalities.components.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NationalityRequest $request)
    {
        $item = new Nationality();
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        if ($item->save()) {
            return redirect(route('manageNationalities'))->with('success', 'เพิ่มข้อมูลสัญชาติแล้ว');
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
            'nationality' => Nationality::findOrFail($id)
        ];
        return view('pages.manages.nationalities.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NationalityRequest $request, $id)
    {
        $item = Nationality::findOrFail($id);
        $item->name_th = $request->input('name_th');
        $item->name_en = $request->input('name_en');
        if ($item->save()) {
            return redirect(route('manageNationalities'))->with('success', 'แก้ไขข้อมูลสัญชาติแล้ว');
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
        $item = Nationality::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('manageNationalities'))->with('success', 'ลบข้อมูลสัญชาติแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบข้อมูลสัญชาติได้');
        }
    }
}
