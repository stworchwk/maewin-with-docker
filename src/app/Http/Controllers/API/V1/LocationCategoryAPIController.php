<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\LocationCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationCategoryAPIController extends Controller
{
    /**
     * @OA\Get(
     *      path="/locationCategories",
     *      tags={"Location Categories"},
     *      operationId="locationCategories",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Call Location Category Data",
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
     *                                  "name": "น้ำตก",
     *                                  "icon_url": "http://localhost:8000/images/locationCategories/6c00dbffd5ebc4ccf30b0ad40e2fc3200b988c35.png",
     *                              },
     *                              {
     *                                  "id": 1,
     *                                  "name": "น้ำตก",
     *                                  "icon_url": "http://localhost:8000/images/locationCategories/6c00dbffd5ebc4ccf30b0ad40e2fc3200b988c35.png",
     *                              },
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
            'result' => LocationCategory::select('id', 'name', 'icon_path')->get()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
