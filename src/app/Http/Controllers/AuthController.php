<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $image_directory = "images/manages/users/";

    public function authProfile()
    {
        $data = [
            'user' => User::findOrFail(Auth::id())
        ];
        return view('pages.auth.profile', $data);
    }
    public function authProfileEdit()
    {
        $data = [
            'user' => User::findOrFail(Auth::id()),
        ];
        return view('pages.auth.profileEdit', $data);
    }
    public function authProfileUpdate(Request $request)
    {
        $request->validate(['full_name' => 'required'], ['full_name.required' => 'ข้อมูลชื่อนามสกุล ควรมีอยู่']);
        $user = User::findOrFail(Auth::user()->id);
        $user->full_name = $request->input('full_name');
        $user->contact = $request->input('contact');

        if ($user->save()) {
            return back()->with('success', 'เปลี่ยนแปลงข้อมูลแล้ว');
        } else {
            return back()->withErrors('เปลี่ยนแปลงข้อมูลล้มเหลว');
        }
    }
    public function authPasswordUpdate(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ],
            [
                'old_password.required' => 'โปรดกรอกข้อมูลรหัสผ่านเดิม',
                'password.required' => 'โปรดกรอกข้อมูลรหัสผ่านใหม่',
                'password.confirmed' => 'รหัสผ่านใหม่ไม่ตรงกับยืนยันรหัสผ่านใหม่',
            ]
        );
        $user = User::findOrFail(Auth::id());
        $user->password = bcrypt($request->input('password'));
        if ($user->save()) {
            Auth::logout();
            return redirect(route('login'))->with('success', 'เปลี่ยนแปลงรหัสผ่านใหม่แล้วโปรดเข้าสู่ระบบใหม่อีกครั้ง');
        } else {
            return back()->withErrors('เปลี่ยนแปลงข้อมูลล้มเหลว');
        }
    }
}
