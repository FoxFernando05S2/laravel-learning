<?php 
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    
    // public function saveFile($file, $folder = 'user'): string
    // {
    //     return $file->store($folder, 'public');
    // }

  
    public function saveBase64(string $base64Image, string $folder = 'user'): string
    {
        $image = base64_decode($base64Image);
        $filename = Str::uuid() . '.webp';
        $path = $folder . '/' . $filename;
        Storage::disk('public')->put($path, $image);
        return $path;
    }
}