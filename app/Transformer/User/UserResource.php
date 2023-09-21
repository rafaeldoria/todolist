<?php 

namespace App\Transformer\User;

use App\Services\ResponseService;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $config;

    public function __construct($resource, $config = [])
    {
        parent::__construct($resource);

        $this->config = $config;
    }

    public function toArray($request) : array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function with($request) {
        return ResponseService::default($this->config, $this->id);
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
    
}
