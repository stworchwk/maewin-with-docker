<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 0) {
            $users = User::where('id', '!=', Auth::id())->get();
        }else{
            $users = User::where('type', 1)->where('id', '!=', Auth::id())->get();
        }
        $data = [
            'users' => $users,
        ];
        return view('pages.manages.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manages.users.components.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $item = new User();
        $item->username = $request->input('username');
        $item->password = bcrypt($request->input('password'));
        $item->full_name = $request->input('full_name');
        $item->contact = $request->input('contact');
        $item->active = 1;
        $item->type = $request->input('type');
        if ($item->save()) {
            return redirect(route('manageUsers'))->with('success', 'เพิ่มข้อมูลผู้ใช้แล้ว');
        } else {
            return back()->withErrors('เพิ่มข้อมูลผู้ใช้ล้มเหลว');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'user' => User::findOrFail($id),
        ];
        return view('pages.manages.users.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $item = User::findOrFail($id);
        $item->full_name = $request->input('full_name');
        $item->contact = $request->input('contact');
        $item->type = $request->input('type');
        if ($item->save()) {
            return redirect(route('manageUsers'))->with('success', 'แก้ไขข้อมูลผู้ใช้แล้ว');
        } else {
            return back()->withErrors('แก้ไขข้อมูลผู้ใช้ล้มเหลว');
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

        $item = User::findOrFail($id);
        $item->password = bcrypt($request->input('password'));
        if ($item->save()) {
            return redirect(route('manageUsers'))->with('success', 'รีเซ็ทรหัสผ่านผู้ใช้แล้ว');
        } else {
            return back()->withErrors('ระบบทำงานขัดข้อง');
        }
    }

    public function active($id)
    {
        $item = User::findOrFail($id);
        $item->active = ($item->active == 0) ? 1 : 0;
        if ($item->save()) {
            return redirect(route('manageUsers'))->with('success', (($item->active == 0) ? 'ระงับบัญชีนี้แล้ว' : 'เปิดการใช้งานแล้ว'));
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
        $item = User::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('manageUsers'))->with('success', 'ลบข้อมูลผู้ใช้แล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบข้อมูลผู้ใช้ได้');
        }
    }
}
