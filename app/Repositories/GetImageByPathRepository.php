<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;


class GetImageByPathRepository
{
    public function getImageByPath(string $image){
        try {
            $path = public_path('/' . $image);

            if (!file_exists($path)) {
                throw new Exception("File not found: $image");
            }

            if (!getimagesize($path)) {
                throw new \InvalidArgumentException("File is not an image: $image");
            }

            // $file = file_get_contents($path);
            return response()->file(public_path($image));
            // $file = file_get_contents($path);
            // $type = pathinfo($path, PATHINFO_EXTENSION);
            // $base64 = 'data:/' . $type . ';base64,' . base64_encode($file);

            // return $base64;
        }  catch (\InvalidArgumentException $error) {
            throw new Exception($error->getMessage());
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
