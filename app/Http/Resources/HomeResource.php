<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'id' => (string)$this->id,
            'user_id' => $this->user->id,
            'home_welcome' => $this->home_welcome,
            'home_title' => $this->home_title,
            'home_description' => $this->home_description,
            'about_title' => $this->about_title,
            'about_description' => $this->about_description
        ];
    }
}
