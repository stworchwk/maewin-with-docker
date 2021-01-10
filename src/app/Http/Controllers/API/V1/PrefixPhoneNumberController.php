<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\PrefixPhoneNumber;
use Illuminate\Http\Request;

class PrefixPhoneNumberController extends Controller
{

    /**
     * @OA\Get(
     *      path="/prefixPhoneNumbers",
     *      tags={"Prefix Phone Number"},
     *      operationId="prefixPhoneNumbers",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Call Prefix Phone Number Data",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "status": true,
     *                         "message": "",
     *                         "result": {
     *                              {
     *                                  "id": 6,
     *                                  "prefix": "66",
     *                                  "name_th": "ไทย",
     *                                  "name_en": "Thai",
     *                              },
     *                              {
     *                                  "id": 7,
     *                                  "prefix": "91",
     *                                  "name_th": "อินเดีย",
     *                                  "name_en": "Indian",
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
            'result' => PrefixPhoneNumber::all()
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
