<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChirpResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'message' => $this->message,
            'created_at' => $this->resource->created_at,
            'edited' => $this->resource->created_at != $this->resource->update_at,
            'user' => UserResource::make($this->whenLoaded('user'))

        ];
    }
}
