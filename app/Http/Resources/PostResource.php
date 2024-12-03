<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'body' => $this->body,
            //when this resource is loaded, it loads the relationship inside it and then returns the instance of the model that relationship originates from
            'user' => UserResource::make($this->whenLoaded('user')) //we cant reference the collection since user is not a collection but one item, so we make
        ];
    }
}
