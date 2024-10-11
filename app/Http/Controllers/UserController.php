<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    

    public function __construct(private UserService $userService)
    {
        
    }

    public function index(): JsonResponse
    {
        $profiles = User::all();
        return new JsonResponse(UserResource::collection($profiles));
    }

    public function show(User $user): JsonResponse
    {
        return new JsonResponse(new UserResource($user));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        User::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return new JsonResponse(['message' => 'Profile registered successfully']);
    }

    public function update(User $profile, UpdateUserRequest $request): JsonResponse
    {
        $profile->update([
            'email' => $request->email,
            'password' => $request->password,
            
        ]);
        return new JsonResponse(['message' => 'Profile updated successfully']);
    }

    public function delete(User $profile): JsonResponse
    {
        $profile->delete();
        return new JsonResponse(['message' => 'Profile deleted successfully']);
    }

    public function assignSpeciality(Request $request): JsonResponse
    {
        $user = User::find($request->user_id);
        $user->specialities()->attach($request->speciality_id);

        return new JsonResponse(['message' => 'Type assigned successfully']);
    }

    public function assignBlock(Request $request): JsonResponse
    {
        $user = User::find($request->user_id);

        return $this->userService->assignBlockToUser($user, $request->block_id);
    }
}
