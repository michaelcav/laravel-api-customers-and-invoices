<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\type;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id' => $this->id,
           'name' => $this->name,
           'type' => $this->type,
           'email' => $this->email,
           'adress' => $this->address,
           'city' => $this->city,
           'state' => $this->state,
           'potalCode' => $this->postal_code
        ];
    }
}