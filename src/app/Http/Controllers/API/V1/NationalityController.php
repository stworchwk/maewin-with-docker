<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * @OA\Get(
     *      path="/nationalities",
     *      tags={"Nationality"},
     *      operationId="nationality",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Call Nationality Data",
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
     *                                  "name_th": "ไทย",
     *                                  "name_en": "Thai",
     *                              },
     *                              {
     *                                  "id": 7,
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
            'result' => Nationality::all()
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
