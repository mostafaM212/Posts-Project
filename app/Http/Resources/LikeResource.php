<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'like'=>$this->like ,
            'user'=>new UserResource($this->user),
            'post'=>new PostResource($this->post)
        ];
    }
}
