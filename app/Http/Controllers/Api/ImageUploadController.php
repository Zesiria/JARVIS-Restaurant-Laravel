<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageUploadController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth('api')->check()){
            $this->middleware('auth:api');
        }
        else {
            $this->middleware('auth:customer');
        }
    }

    function upload(Request $request){
        $file = $request->file('image');
        $name = 'storage/images/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);

        return response()->json([
            'path' => $name
        ], Response::HTTP_CREATED);
    }
}
