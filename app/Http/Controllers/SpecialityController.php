<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Speciality;
use App\Http\Requests\Speciality\StoreSpecialityRequest;


class SpecialityController extends Controller
{
    public function store(StoreSpecialityRequest $request): JsonResponse
    {
        Speciality::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return new JsonResponse(['message' => 'Speciality registered successfully']);
    }
}
