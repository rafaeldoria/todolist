<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskListRequest;
use App\Http\Requests\UpdateTaskListRequest;
use App\Repositories\TaskListRepository;
use App\Services\ResponseService;
use App\Transformer\TaskList\TaskListResource;
use App\Transformer\TaskList\TaskListResourceCollection;

class TaskListController extends Controller
{
    protected $taskListRepository;

    public function __construct(TaskListRepository $taskListRepository)
    {
        $this->taskListRepository = $taskListRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TaskListResourceCollection($this->taskListRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $request)
    {
        try {
            $data = $this->taskListRepository->create($request->all());
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasklist.store', null, $e);
        }

        return new TaskListResource($data, [
            'type' => 'store',
            'route' => 'tasklist.store'
        ]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(TaskList $taskList)
    public function show($id)
    {
        try{        
            $data = $this->taskListRepository->show($id);
            // TODO:: testar passando taskList diretamente
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.show',$id,$e);
        }

        return new TaskListResource($data, [
            'type' => 'show',
            'route' => 'tasklist.show'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateTaskListRequest $request, TaskList $taskList)
    public function update($request, $id)
    {
        try{        
            $data = $this->taskListRepository->updateList($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.update',$id,$e);
        }

        return new TaskListResource($data, [
            'type' => 'update',
            'route' => 'tasklist.update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $data = $this->taskListRepository->destroyList($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.destroy',$id,$e);
        }
        return new TaskListResource($data,[
            'type' => 'destroy',
            'route' => 'tasklist.destroy'
        ]); 
    }
}
