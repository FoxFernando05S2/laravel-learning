<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $profiles = User::all();
        
        return new JsonResponse(UserResource::collection($profiles));
    }

    public function show(User $profile): JsonResponse
    {
        return new JsonResponse($profile);
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
}
