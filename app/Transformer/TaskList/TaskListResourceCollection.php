<?php

namespace App\Transformer\TaskList;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskListResourceCollection extends ResourceCollection
{
    public function toArray($request) : array
    {
        return ['data' => $this->collection];
    }

    public function with($request) : array
    {
        return [
            'status' => true,
            'msg' => 'Data Listening',
            'url' => route('task_list.index')
        ];
    }

    public function withResponse($request, $response) : void
    {
        $response->setStatusCode(200);
    }
}
