<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    
    public function index(): JsonResponse
    {
        $profiles = Profile::all();
        return new JsonResponse($profiles);
    }

    public function show(Profile $profile): JsonResponse
    {
        return new JsonResponse($profile);
    }

    public function store(StoreProfileRequest $request): JsonResponse
    {
        Profile::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'document_number' => $request->document_number,
            'age' => $request->age,
            'address' => $request->address,
            'user_id' => $request->user_id,
        ]);
        return new JsonResponse(['message' => 'Profile registered successfully']);
    }

    public function update(Profile $profile, UpdateProfileRequest $request): JsonResponse
    {
        $profile->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'document_number' => $request->document_number,
            'age' => $request->age,
            'address' => $request->address,
        ]);
        return new JsonResponse(['message' => 'Profile updated successfully']);
    }

    public function delete(Profile $profile): JsonResponse
    {
        $profile->delete();
        return new JsonResponse(['message' => 'Profile deleted successfully']);
    }

}
