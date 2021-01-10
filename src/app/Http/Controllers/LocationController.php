<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationImageRequest;
use App\Http\Requests\LocationRequest;
use App\Location;
use App\LocationCategory;
use App\LocationImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LocationController extends Controller
{
    private $image_directory = "images/locations/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter)
    {
        if ($filter == 'all') {
            $locations = Location::all();
        } else {
            $locations = Location::where('location_category_id', $filter)->get();
        }

        $data = [
            'locations' => $locations,
            'categories' => LocationCategory::pluck('name', 'id'),
            'select_filter' => $filter == 'all' ? 0 : $filter,
        ];
        return view('pages.locations.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => LocationCategory::pluck('name', 'id'),
        ];

        return view('pages.locations.components.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $item = new Location();
        $item->location_category_id = $request->input('location_category_id');
        $item->code = $request->input('code');
        $item->title_th = $request->input('title_th');
        $item->title_en = $request->input('title_en');
        $item->mark_down = null;
        $item->village_name = $request->input('village_name');
        $item->village_no = $request->input('village_no');
        $item->address = $request->input('address');
        $item->owner_full_name = $request->input('owner_full_name');
        $item->tel = $request->input('tel');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->destination_latitude = $request->input('destination_latitude');
        $item->destination_longitude = $request->input('destination_longitude');
        $item->budget = $request->input('budget');
        $item->time_spent = $request->input('time_spent');
        $item->active = 1;

        $main_folder_path = public_path() . '/' . $this->image_directory;

        if (!File::exists($main_folder_path)) {
            File::makeDirectory($main_folder_path);
        }
        if ($request->hasFile('thumbnail')) {
            #img upload
            $image_extension = $request->file('thumbnail')->getClientOriginalExtension();
            $image_name = sha1(Carbon::now() . microtime()) . '.' . $image_extension;
            $request->file('thumbnail')->move(public_path() . '/' . $this->image_directory, $image_name);
            $full_image_path = public_path() . '/' . $this->image_directory . '/' . $image_name;
            Image::make($full_image_path)
                ->resize(720, NULL, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($full_image_path);
            $item->thumbnail = $this->image_directory . $image_name;
        } else {
            $item->thumbnail = null;
        }

        if ($item->save()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', 'เพิ่มสถานที่ท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('เพิ่มข้อมูลล้มเหลว');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'location' => Location::findOrFail($id),
            'categories' => LocationCategory::pluck('name', 'id'),
        ];
        return view('pages.locations.components.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        $item = Location::findOrFail($id);
        $item->location_category_id = $request->input('location_category_id');
        $item->code = $request->input('code');
        $item->title_th = $request->input('title_th');
        $item->title_en = $request->input('title_en');
        $item->village_name = $request->input('village_name');
        $item->village_no = $request->input('village_no');
        $item->address = $request->input('address');
        $item->owner_full_name = $request->input('owner_full_name');
        $item->tel = $request->input('tel');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->destination_latitude = $request->input('destination_latitude');
        $item->destination_longitude = $request->input('destination_longitude');
        $item->budget = $request->input('budget');
        $item->time_spent = $request->input('time_spent');

        if ($request->hasFile('thumbnail')) {
            File::delete($item->thumbnail);
            #img upload
            $image_extension = $request->file('thumbnail')->getClientOriginalExtension();
            $image_name = sha1(Carbon::now() . microtime()) . '.' . $image_extension;
            $request->file('thumbnail')->move(public_path() . '/' . $this->image_directory, $image_name);
            $full_image_path = public_path() . '/' . $this->image_directory . '/' . $image_name;
            Image::make($full_image_path)
                ->resize(720, NULL, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($full_image_path);
            $item->thumbnail = $this->image_directory . $image_name;
        }

        if ($item->save()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', 'แก้ไขสถานที่ท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('แก้ไขข้อมูลล้มเหลว');
        }
    }

    public function showAlbums($id)
    {
        $data = [
            'location' => Location::findOrFail($id),
        ];
        return view('pages.locations.components.showAlbum', $data);
    }

    public function albumStore(LocationImageRequest $request, $id)
    {
        if ($request->hasFile('file')) {
            $item = new LocationImage();
            $item->location_id = $id;
            $item->title_th = $request->input('title_th');
            $item->title_en = $request->input('title_en');
            $item->detail_th = $request->input('detail_th');
            $item->detail_en = $request->input('detail_en');

            $main_folder_path = public_path() . '/images/locationAlbums/';

            if (!File::exists($main_folder_path)) {
                File::makeDirectory($main_folder_path);
            }
            #img upload
            $image_extension = $request->file('file')->getClientOriginalExtension();
            $image_name = sha1(Carbon::now() . microtime()) . '.' . $image_extension;
            $request->file('file')->move(public_path() . '/' . $this->image_directory, $image_name);
            $full_image_path = public_path() . '/' . $this->image_directory . '/' . $image_name;
            Image::make($full_image_path)
                ->resize(720, NULL, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($full_image_path);
            $item->path = $this->image_directory . $image_name;

            if ($item->save()) {
                return redirect(route('locations', ['filter' => 'all']))->with('success', 'เพิ่มรูปาภในอัลบั้มแล้ว');
            } else {
                return back()->withErrors('เพิ่มรูปาภในอัลบั้มล้มเหลว');
            }
        }else{
            return back()->withErrors('โปรดเลือกไฟล์รูปภาพ');
        }
    }

    public function albumDestroy($image_id)
    {
        $item = LocationImage::findOrFail($image_id);
        File::delete($item->path);
        if ($item->delete()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', 'ลบรูปาภพในอัลบั้มแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบรูปภาพในอัลบั้มได้');
        }
    }

    public function showWebview($id)
    {
        $data = [
            'location' => Location::findOrFail($id),
        ];

        return view('pages.locations.components.showWebview', $data);
    }

    public function webviewUpdate(Request $request, $id)
    {
        $item = Location::findOrFail($id);
        $item->mark_down = $request->input('markdown');
        if ($item->save()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', 'อัพเดทบทความแล้ว');
        } else {
            return back()->withErrors('ระบบทำงานขัดข้อง');
        }
    }

    public function active($id)
    {
        $item = Location::findOrFail($id);
        $item->active = ($item->active == 0) ? 1 : 0;
        if ($item->save()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', (($item->active == 0) ? 'ปิดใช้งานแล้ว' : 'เปิดการใช้งานแล้ว'));
        } else {
            return back()->withErrors('ระบบทำงานขัดข้อง');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Location::findOrFail($id);
        if ($item->delete()) {
            return redirect(route('locations', ['filter' => 'all']))->with('success', 'ลบสถานที่ท่องเที่ยวแล้ว');
        } else {
            return back()->withErrors('ไม่สามารถลบสถานที่ท่องเที่ยวนี้ได้');
        }
    }
}
