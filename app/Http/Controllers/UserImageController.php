<?php 

declare(strict_types=1);

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
// use App\Models\PostPhoto;
// use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Str;

use App\Models\image;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importar Storage para manejar archivos
use Illuminate\Support\Str;

use App\Services\ImageService;


class UserImageController extends Controller
{

    public function __construct(private ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function save(Request $request, User $user)
    {
        return Image::create([
            'images_type'=>User::class, 
            'images_id'=>$user->id,  
            'uri'=> $request->file('image')->store('user','public')
        ]);
    }

    
    public function saveBase64(Request $request, User $user): JsonResponse
    {
        $path = $this->imageService->saveBase64($request->image_base64);

        $image = Image::create([
            'images_type' => User::class,
            'images_id' => $user->id,
            'uri' => $path
        ]);

        return response()->json($image, 201);
    }
    
    public function getUserImage(User $user)
    {
        $photo = $user->images;
        return new JsonResponse($photo);
    }
}