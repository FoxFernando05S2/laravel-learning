<?php

declare(strict_types=1);

namespace Src\Profile\Infrastructure\Controller;

use App\Http\Requests\Profile\StoreProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\Profile\Application\DTO\ProfileRequest;
use Src\Profile\Application\UseCase\GetProfiles;
use Src\Profile\Application\UseCase\RegisterProfile;
use Src\Profile\Domain\Exception\UserAlreadyHasProfileException;

class ProfileController extends Controller
{
    public function __construct(
        private GetProfiles $getProfiles,
        private RegisterProfile $registerProfile,
    ){
    }
    public function index()
    {
       $getProfiles = $this->getProfiles->execute();
       return new JsonResponse($getProfiles,200);
    }

    public function store(Request $request): JsonResponse
    {  
        // $validated = $request->validated(); 

        $profileRequest = new ProfileRequest(
            $request['name'],
            $request['lastname'],
            $request['document_number'],
            $request['age'],
            $request['address'],
            $request['user_id']
        );

        $this->registerProfile->execute($profileRequest);

        return response()->json(['message' => 'Profile created successfully'], 201);
    }













    
    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         return $this->registerProfile->execute(
    //             $request->input('name'),
    //             $request->input('lastname'),
    //             $request->input('document_number'),
    //             (int) $request->input('age'),
    //             $request->input('address'),
    //             (int) $request->input('user_id')
    //         );
    //     } catch (UserAlreadyHasProfileException $e) {
    //         return $e->render();  // Maneja la excepción y devuelve la respuesta adecuada
    //     }
    // }

}