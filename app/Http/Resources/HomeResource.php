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
            // 'id' => $this->when(is_null($this->id) || empty($this->id), function () {
            //     return null;
            // }),
            // 'user_id' => $this->when(
            //     is_null($this->user_id),
            //     function () {
            //         return null;
            //     }
            // ),
            // 'id' =>  !is_null($this->id) || !empty($this->id) ? $this->id : null,
            'id' =>   empty($this->id) ? null : $this->id,
            'user_id' => empty($this->user_id) ? null : $this->user_id,
            'home_welcome' => empty($this->home_welcome) ? null : $this->home_welcome,
            'home_title' => empty($this->home_title) ? null : $this->home_title,
            'home_description' => empty($this->home_description) ? null : $this->home_description,
            'about_title' => empty($this->about_title) ? null : $this->about_title,
            'about_description' => empty($this->about_description) ? null : $this->about_description
        ];
    }
}
