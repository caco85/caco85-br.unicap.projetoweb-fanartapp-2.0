<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class FanartCategoryResource extends JsonResource
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
            'nameCategory' => $this->nameCategory,
            'created_at' => (new \DateTime($this->created_at))->format('d/m/Y H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('d/m/Y H:i:s'),
        ];
    }
}
