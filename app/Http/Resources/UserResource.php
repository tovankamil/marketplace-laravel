<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
<<<<<<< HEAD
       return [
        'id'=>$this->id,
        'name'=>$this->name,
        'email'=> $this->email
       ];
=======
        return  [
            'id'=>$this->id,
            'name'=>$this->name,
            'emmail'=>$this->email,
        ];
>>>>>>> create-api
    }
}
