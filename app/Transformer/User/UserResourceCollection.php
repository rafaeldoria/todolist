<?php

namespace App\Transformer\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    public function toArray($request) : array 
    {
        return ['data' => $this->collection];
    }

    public function with($request) : array 
    {
        return [
            'status' => true,
            'msg' => 'Listing data',
            'url' => route('users.index')
        ];
    }

    public function withResponse($request, $response) : void
    {
        $response->setStatusCode(200);
    }
}