<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationCategoryRequest;
use App\LocationCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LocationCategoryController extends Controller
{
    private $image_directory = "images/locationCategories/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'locationCategories' => LocationCategory::all(),
        ];
        return view('pages.manages.locationCategories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manages.locationCategories.components.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationCategoryRequest $request)
    {
        $item = new LocationCategory();
        $item->name = $request->input('name');

        $main_folder_path = public_path() . '/' . $this->image_directory;

        if (!File::exists($main_folder_path)) {
            File::makeDirectory($main_folder_path);
        }
        if ($request->hasFile('icon')) {
            #img upload
            $image_extension = $request->file('icon')->getClientOriginalExtension();
            $image_name = sha1(Carbon::now() . microtime()) . '.' . $image_extension;
            $request->file('icon')->move(public_path() . '/' . $this->image_directory, $image_name);
            $full_image_path = public_path() . '/' . $this->image_directory . '/' . $image_name;
            Image::make($full_image_path)
                ->resize(720, NULL, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($full_image_path);
            $item->icon_path = $this->image_directory . $image_name;
        } else {
            $item->icon_path = '';
        }

        if ($item->save()) {
            return redirect(route('manageLocationCategories'))->with('success', 'เพิ่มหมวดหมู่สถานที่ท่องเที่ยวแล้ว');
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
            'locationCategory' => LocationCategory::findOrFail($id)
        ];
        return view('pages.manages.locationCategories.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationCategoryRequest $request, $id)
    {
        $item = LocationCategory::findOrFail($id);
        $item->name = $request->input('name');

        if ($request->hasFile('icon')) {
            File::delete($item->icon_path);
            #img upload
            $image_extension = $request->file('icon')->getClientOriginalExtension();
            $image_name = sha1(Carbon::now() . microtime()) . '.' . $image_extension;
            $request->file('icon')->move(public_path() . '/' . $this->image_directory, $image_name);
            $full_image_path = public_path() . '/' . $this->image_directory . '/' . $image_name;
            Image::make($full_image_path)
                ->resize(720, NULL, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($full_image_path);
            $item->icon_path = $this->image_directory . $image_name;
        }

        if ($item->save()) {
            return redirect(route('manageLocationCategories'))->with('success', 'แก้ไขหมวดหมู่สถานที่ท่องเที่ยวแล้ว');
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
        $item = LocationCategory::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('manageLocationCategories'))->with('success', 'ลบหมวดหมู่สถานที่ท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบหมวดหมู่สถานที่ท่องเที่ยวได้');
        }
    }
}
