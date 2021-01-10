<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;

class LocationAPIController extends Controller
{
    /**
     * @OA\Get(
     *      path="/locations",
     *      tags={"Locations"},
     *      operationId="locations",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Call Location Data",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "status": true,
     *                         "message": "",
     *                         "result": {
     *                              {
     *                                  "id": 1,
     *                                  "location_category_id": 1,
     *                                  "code": "MW9-00001",
     *                                  "title_th": "น้ำตกแม่สะป๊อก",
     *                                  "title_en": "Mae Sa Prock Waterfall",
     *                                  "mark_down": "fsafsafsaf",
     *                                  "village_name": "สันกับตอง",
     *                                  "village_no": 5,
     *                                  "address": "22/1 M.8 Saraphi",
     *                                  "owner_full_name": "ศตวรรษ อรชุนเวคิน",
     *                                  "tel": "0953685568",
     *                                  "latitude": "18.795824565103683",
     *                                  "longitude": "98.9686906612549",
     *                                  "destination_latitude": "18.795824565103683",
     *                                  "destination_longitude": "98.9686906612549",
     *                                  "budget": 200,
     *                                  "time_spent": 30,
     *                                  "active": 1,
     *                                  "thumbnail_url": "http://localhost:8000/images/locations/9fcb1c0058f8c2edf2ed2678a77b57ea98e661eb.jpg",
     *                                  "category": {
     *                                      {
     *                                          "id": 1,
     *                                          "name": "น้ำตก",
     *                                          "icon_url": "http://localhost:8000/images/locationCategories/6c00dbffd5ebc4ccf30b0ad40e2fc3200b988c35.png",
     *                                      }
     *                                  },
     *                                  "images": {
     *                                      {
     *                                          "id": 1,
     *                                          "location_id": 1,
     *                                          "title_th": "น้ำตกแม่สะป๊อก",
     *                                          "title_en": "Mae Sa Prock Waterfall",
     *                                          "detail_th": null,
     *                                          "detail_en": null,
     *                                          "image_url": "http://localhost:8000/images/locations/e75b99f7801c7cad86821a81b5f9c4510559d162.jpg"
     *                                      }
     *                                  },
     *                              },
     *                              {
     *                                  "id": 1,
     *                                  "location_category_id": 1,
     *                                  "code": "MW9-00001",
     *                                  "title_th": "น้ำตกแม่สะป๊อก",
     *                                  "title_en": "Mae Sa Prock Waterfall",
     *                                  "mark_down": "fsafsafsaf",
     *                                  "village_name": "สันกับตอง",
     *                                  "village_no": 5,
     *                                  "address": "22/1 M.8 Saraphi",
     *                                  "owner_full_name": "ศตวรรษ อรชุนเวคิน",
     *                                  "tel": "0953685568",
     *                                  "latitude": "18.795824565103683",
     *                                  "longitude": "98.9686906612549",
     *                                  "destination_latitude": "18.795824565103683",
     *                                  "destination_longitude": "98.9686906612549",
     *                                  "budget": 200,
     *                                  "time_spent": 30,
     *                                  "active": 1,
     *                                  "thumbnail_url": "http://localhost:8000/images/locations/9fcb1c0058f8c2edf2ed2678a77b57ea98e661eb.jpg",
     *                                  "category": {
     *                                      {
     *                                          "id": 1,
     *                                          "name": "น้ำตก",
     *                                          "icon_url": "http://localhost:8000/images/locationCategories/6c00dbffd5ebc4ccf30b0ad40e2fc3200b988c35.png",
     *                                      }
     *                                  },
     *                                  "images": {
     *                                      {
     *                                          "id": 1,
     *                                          "location_id": 1,
     *                                          "title_th": "น้ำตกแม่สะป๊อก",
     *                                          "title_en": "Mae Sa Prock Waterfall",
     *                                          "detail_th": null,
     *                                          "detail_en": null,
     *                                          "image_url": "http://localhost:8000/images/locations/e75b99f7801c7cad86821a81b5f9c4510559d162.jpg"
     *                                      }
     *                                  },
     *                              }
     *                         }
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     */

    public function index()
    {
        $data = [
            'status' => true,
            'message' => '',
            'result' => Location::with(['category', 'images'])->get()
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
