<?php

namespace App\Transformer\Task;

use App\Services\ResponseService;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'list_id' => $this->list_id,
            'title' => $this->title,
            'status' => $this->status
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
