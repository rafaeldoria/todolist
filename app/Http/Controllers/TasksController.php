<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Repositories\TaskRepository;
use App\Transformer\Task\TaskResourceCollection;
use App\Transformer\Task\TaskResource;
use App\Services\ResponseService;

class TasksController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try{        
            $data = $this->taskRepository->store($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasks.store',null,$e);
        }

        return new TaskResource($data,[
            'type' => 'store',
            'route' => 'tasks.store'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{        
            $data = $this->taskRepository->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasks.show',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'show',
            'route' => 'tasks.show'
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
            return ResponseService::exception('tasks.update',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'update',
            'route' => 'tasks.update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $data = $this->taskRepository->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasks.destroy',$id,$e);
        }
        return new TaskResource($data,[
            'type' => 'destroy',
            'route' => 'tasks.destroy'
        ]); 
    }

    public function tasksByList($id)
    {
        try{        
            $data = $this->taskRepository->tasksByList($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasks.tasksByList',$id,$e);
        }

        return new TaskResourceCollection($data);
    }

    public function closeTask($id)
    {
        try{        
            $data = $this->taskRepository->closeTask($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasks.closeTask',$id,$e);
        }

        return new TaskResource($data,[
            'type' => 'update',
            'route' => 'tasks.closeTask'
        ]);
    }
}
