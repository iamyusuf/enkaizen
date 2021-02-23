<?php

namespace App\Http\Controllers;

use App\Jobs\UploadImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function index()
    {
        $images = Image::latest()
            ->limit(10)
            ->get();

        return response()->json($images);
    }

    public function store(Request $request)
    {
        UploadImage::dispatch(
            $request->url,
            auth()->id()
        );

        return response()->json(['message' => 'processing']);
    }
}
