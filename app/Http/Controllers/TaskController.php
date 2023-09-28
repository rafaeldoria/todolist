<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Repositories\TaskRepository;
use App\Transformer\Task\TaskResourceCollection;
use App\Transformer\Task\TaskResource;
use App\Services\ResponseService;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TaskResourceCollection($this->taskRepository->index());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{        
            $data = $this->taskRepository->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.show',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'show',
            'route' => 'task.show'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try{        
            $data = $this->taskRepository->store($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.store',null,$e);
        }

        return new TaskResource($data,[
            'type' => 'store',
            'route' => 'task.store'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{        
            $data = $this->taskRepository->updateTask($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.update',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'update',
            'route' => 'task.update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $data = $this->taskRepository->destroy($id);
            $data->id = $id;
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.destroy',$id,$e);
        }
        return new TaskResource($data,[
            'type' => 'destroy',
            'route' => 'task.destroy'
        ]); 
    }

    public function tasksByList($list_id)
    {
        try{        
            $data = $this->taskRepository->tasksByList($list_id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.bylist',$list_id,$e);
        }

        return new TaskResourceCollection($data);
    }

    public function closeTask($id)
    {
        try{        
            $data = $this->taskRepository->closeTask($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('task.close',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'update',
            'route' => 'task.close'
        ]);
    }
}
