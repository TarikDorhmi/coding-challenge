<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileManagerService
{
    public function uploadImage(string $imageBase64Data, string $filename): string
    {
        // Decode the base64 encoded image data
        $imageRawData = base64_decode($imageBase64Data);

        // Create a unique directory path for storing the image
        $directoryPath = 'public/products/' . date('Ymd');
        Storage::makeDirectory($directoryPath);

        // Save the image file to the directory path
        $filePath = $directoryPath . '/' . $filename;
        Storage::put($filePath, $imageRawData);

        return $filePath;
    }
}
