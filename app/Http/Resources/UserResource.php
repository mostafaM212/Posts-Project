<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id ,
            'name'=>$this->name,
            'email'=>$this->email,
            'postsCount'=>$this->posts->count(),
            'admin'=>$this->admin,
            'photo'=>asset('/images/users/'.$this->photo),
            'created_at'=>$this->created_at->diffForHumans()
        ];
    }
}
