<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DevsResource extends JsonResource
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
            'attributes' => [
                'id' => $this->id,
                'username' => $this->name,
                'firstName' => $this->first_name,
                'lastName' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'photoUrl' => $this->photo_url,
                'has2fa' => $this->two_factor_secret ? true : false

            ],
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
            'projects' => ProjectResource::collection($this->whenLoaded('projects')),
            'socials' => SocialResource::collection($this->whenLoaded('socials')),
            'home' => HomeResource::collection($this->whenLoaded('home'))
        ];
    }
}
