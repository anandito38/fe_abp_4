<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // public function getImageByPath(Request $request){
    //     try {
    //         return response()->file(public_path('storage/images/menu/4_1716996787_3684434291.png'));
    //     } catch (\Exception $error) {
    //         return response()->json(['error' => $error->getMessage()], 500);
    //     }
    // }

    public function getImageByPath(Request $request, $imagePath){
        try {
            $filePath = 'storage/images/menu/' . $imagePath;
            // dd($filePath);
            return response()->file(public_path($filePath));
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}