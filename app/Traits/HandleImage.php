<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandleImage
{
    public function uploadImage($image, $file)
    {
        if (is_file($image)) {
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $uplodedImage = $image->storeAs($file, $imageName, 'public');
    
            return $uplodedImage;
        }
    }

    public function destroyImage($imagePath)
    {
        if ($imagePath) {
            
            if (Storage::disk('public')->exists($imagePath)) {
                
                Storage::disk('public')->delete($imagePath);
            }
        }
    }
}