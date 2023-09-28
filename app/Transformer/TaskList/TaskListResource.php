<?php

namespace App\Transformer\TaskList;

use App\Services\ResponseService;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskListResource extends JsonResource
{
    private $config;

    public function __construct($resource, $config = [])
    {
        parent::__construct($resource);

        $this->config = $config;
    }

    public function toArray($request)
    {
        return [
            'id' => !is_null($this->id) ? $this->id : '',
            'user_id' => !is_null($this->user_id) ? $this->user_id : '',
            'title' => !is_null($this->title) ? $this->title : '',
            'status' => !is_null($this->title) ? ($this->status == 1 ? 'Done' : 'To Do') : ''
        ];
    }

    public function with($request) : array
    {
        return ResponseService::default($this->config, $this->id);
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
