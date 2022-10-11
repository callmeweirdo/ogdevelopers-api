<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'skill' => $this->skill,
                'type' => $this->type,
                'experience' => $this->experience,
                'logo' => $this->logo
            ],
            'relationship' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email
            ]
        ];
    }
}
