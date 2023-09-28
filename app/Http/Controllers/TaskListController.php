<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskList\UpdateTaskListRequest;
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
    public function store(Request $request)
    {
        try {
            $data = $this->taskListRepository->create($request->all());
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('task_list.store', null, $e);
        }

        return new TaskListResource($data, [
            'type' => 'store',
            'route' => 'task_list.store'
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
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.show',$id,$e);
        }

        return new TaskListResource($data, [
            'type' => 'show',
            'route' => 'task_list.show'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskListRequest $request, Int $id)
    {
        try{        
            $data = $this->taskListRepository->updateList($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.update',$id,$e);
        }

        return new TaskListResource($data, [
            'type' => 'update',
            'route' => 'task_list.update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $data = $this->taskListRepository->destroyList($id);
            $data->id = $id;
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.destroy',$id,$e);
        }
        return new TaskListResource($data, [
            'type' => 'destroy',
            'route' => 'task_list.destroy'
        ]); 
    }
}
