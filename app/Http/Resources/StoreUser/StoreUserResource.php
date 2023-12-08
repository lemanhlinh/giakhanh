<?php

namespace App\Http\Resources\StoreUser;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'address' => $this->address,
            'birthday' => $this->birthday,
            'email' => $this->email,
            'gender' => $this->gender,
            'id' => $this->id,
            'type' => $this->type,
            'stores' => $this->stores,
            'name' => $this->name,
            'phone' => $this->phone,
            'active' => $this->active,
        ];
    }
}
