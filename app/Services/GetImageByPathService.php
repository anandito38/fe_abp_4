<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;

use App\Repositories\GetImageByPathRepository;

class GetImageByPathService {
    public function __construct(
        private GetImageByPathRepository $getImageByPathRepository
    ) {}

    /**
     * 
     * 
     */
    public function getImageByPath(Request $request) {
        try {
            $request->validate([
                'image' => 'required',
            ]);

            $image = $request->image;

            return $this->getImageByPathRepository->getImageByPath($image);

        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}

?>
