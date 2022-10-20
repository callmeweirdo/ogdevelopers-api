<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'attributes' => [
                'project' => $this->project,
                'tech_stack' => $this->tech_stack,
                'live_link' => $this->live_link,
                'github_link' => $this->github_link,
                'project_cover' => $this->project_cover,
                'description' => $this->description
            ],
            'relationship' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email
            ]
        ];
    }
}
