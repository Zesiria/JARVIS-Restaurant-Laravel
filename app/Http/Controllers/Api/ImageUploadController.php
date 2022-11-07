<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageUploadController extends Controller
{
    function upload(Request $request){
        $file = $request->file('image');
        $name = 'images/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);

        return response()->json([
            'path' => $name
        ], Response::HTTP_CREATED);
    }
}
