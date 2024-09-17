<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "lastname" => $this->lastname,
            "document_number" => $this->document_number,
            "age" => $this->age,
            "address" => $this->address,
            'user' => new UserResource($this->whenLoaded('user')),
            /* "user_id" => $this->user_id, */
        ];
    }
}
