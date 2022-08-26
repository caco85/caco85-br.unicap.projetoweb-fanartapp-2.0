<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;


class FanartResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image ? URL::to($this->image) : null,
            'mediaRating' => $this->mediaRating,
            'id_users' => $this->id_users,
            'id_fanartCategories' => $this->id_fanartCategories,
            'created_at' => (new \DateTime($this->created_at))->format('d/m/Y H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('d/m/Y H:i:s'),
        ];
    }
}
