<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use App\Http\Requests\API\V1\ProfileRequest;
use App\Http\Requests\API\V1\SignUpRequest;
use App\Traveler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     *      path="/signup",
     *      tags={"Authentication"},
     *      operationId="signup",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string",
     *                     example="Satawat Orachunwekhin",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="email",
     *                     example="stworchwk@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="password",
     *                     example="123456"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="password",
     *                     example="123456"
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Sign Up Success",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "Successfully created user!",
     *                         "user": {
     *                              "id": 6,
     *                              "full_name": "Chonnikan",
     *                              "email": "chnkkpch@gmail.com",
     *                              "created_at": "2020-10-30T08:39:13.000000Z",
     *                              "updated_at": "2020-10-30T08:39:13.000000Z",
     *                          }
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     * @param SignUpRequest $request
     */

    public function signup(SignUpRequest $request)
    {
        $user = new Traveler([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Successfully created user!',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'fail to create user!'
            ], 404);
        }


    }

    /**
     * @OA\Post(
     *      path="/login",
     *      tags={"Authentication"},
     *      operationId="login",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="email",
     *                     example="stworchwk@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="password",
     *                     example="123456"
     *                 ),
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Success",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhd....",
     *                         "token_type": "Bearer",
     *                         "expires_at": "2020-11-14 08:46:17",
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     * @param LoginRequest $request
     */

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::guard('traveler')->attempt($credentials)) {
            return response()->json([
                'message' => 'อีเมล หรือรหัสผ่านไม่ถูกต้อง!'
            ], 401);
        }
        $user = $request->user('traveler');
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * @OA\Get(
     *      path="/logout",
     *      tags={"Authentication"},
     *      operationId="logout",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Login Success",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "message": "Successfully logged out.",
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     * @param Request $request
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @OA\Get(
     *      path="/profile",
     *      tags={"Authentication"},
     *      operationId="profile",
     *      security={{"Bearer": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Call Profile Data",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "status": true,
     *                         "message": "",
     *                         "result": {
     *                              "id": 6,
     *                              "email": "chnkkpch@gmail.com",
     *                              "email_verified_at": null,
     *                              "social_google": null,
     *                              "full_name": "Chonnikan",
     *                              "nationality_id": null,
     *                              "prefix_phone_number_id": null,
     *                              "phone_number": null,
     *                              "id_card": null,
     *                              "active": 1,
     *                              "created_at": "2020-10-30T08:39:13.000000Z",
     *                              "updated_at": "2020-10-30T08:39:13.000000Z",
     *                          }
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     * @param Request $request
     */

    public function profile(Request $request)
    {
        return response()->json(['status' => true, 'message' => '', 'result' => $request->user()]);
    }

    /**
     * @OA\Put(
     *      path="/profileUpdate",
     *      tags={"Authentication"},
     *      operationId="profile_update",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string",
     *                     example="Satawat Orachunwekhin",
     *                 ),
     *                 @OA\Property(
     *                     property="nationality_id",
     *                     type="integer",
     *                     example=4
     *                 ),
     *                 @OA\Property(
     *                     property="prefix_phone_number_id",
     *                     type="integer",
     *                     example=46
     *                 ),
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="string",
     *                     example="953685568"
     *                 ),
     *                 @OA\Property(
     *                     property="id_card",
     *                     type="string",
     *                     example="1509901361170"
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Success",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example={
     *                         "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhd....",
     *                         "token_type": "Bearer",
     *                         "expires_at": "2020-11-14 08:46:17",
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     * )
     *
     * @param LoginRequest $request
     */

    public function profileUpdate(ProfileRequest $request)
    {
        $item = Traveler::findOrFail($request->user()->id);
        $item->full_name = $request->input('full_name');
        $item->nationality_id = $request->input('nationality_id');
        $item->prefix_phone_number_id = $request->input('prefix_phone_number_id');
        $item->phone_number = $request->input('phone_number');
        $item->id_card = $request->input('id_card');
        if ($item->save()) {
            return response()->json(['status' => true, 'message' => 'Update Profile Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Update Profile Failed.']);
        }
    }
}
