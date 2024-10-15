<?php 
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ImageService
{
    // public function saveBase64(string $base64Image, string $folder = 'user'): string
    // {
    //     $image = base64_decode(explode(',' , $base64Image)[1]);
    //     $extension = $this->getExtensionFromImage($image);
    //     $filename = Str::uuid() . $extension;
    //     $path = $folder . '/' . $filename;
    //     Storage::disk('public')->put($path, $image);
    //     return $path;
    // }

    // private function getExtensionFromImage(string $imageType): string
    // {
    //     return match ($imageType) {
    //         'image/jpeg' => 'jpg',
    //         'image/png' => 'png',
    //         'image/gif' => 'gif',
    //         'image/webp' => 'webp',
    //         'image/bmp' => 'bmp',
    //         default => throw new Exception("Formato de imagen no soportado: $imageType"),
    //     };
    // }



    public function saveBase64(string $base64Image, string $folder = 'user'): string
    {
        $image = base64_decode(explode(',', $base64Image)[1]);
        $extension = $this->getFileExtension($base64Image);
        $filename = Str::uuid() . '.' . $extension;
        $path = $folder . '/' . $filename;
        Storage::disk('public')->put($path, $image);
        return $path;
    }

    private function getFileExtension(string $imageBase64): string
    {
        $matches = [];
        if (preg_match('/data:image\/(?<type>[a-zA-Z0-9]+);base64,/', $imageBase64, $matches)) {
            $mimeType = $matches['type'];
            return match ($mimeType) {
                'jpeg', 'jpg' => 'jpg',
                'png' => 'png',
                'gif' => 'gif',
                'webp' => 'webp',
                'bmp' => 'bmp',
                default => throw new Exception("Formato de imagen no soportado: $mimeType"),
            };
        }
        throw new Exception("Formato base64 inválido o no soportado");
    }
}