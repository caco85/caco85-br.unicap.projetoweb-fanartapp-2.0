<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo ? URL::to($this->photo) : null,
            'instagram' => $this->instagram,
            'birthday' => (new \DateTime($this->birthday))->format('d/m/Y'),
            'id_usersTypes' => $this->id_usersTypes,
            'created_at' => (new \DateTime($this->created_at))->format('d/m/Y H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('d/m/Y H:i:s')
        ];
    }
}
