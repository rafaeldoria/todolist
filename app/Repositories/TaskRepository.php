<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ITaskRepository;
use App\Models\Tasks;

class TaskRepository implements ITaskRepository
{
    public function index()
    {
        return auth()->user()->tasks;
    }

    public function show($id)
    {
        $show = auth()->user()->tasks->find($id);
        
        if (!$show) {
            throw new \Exception('Not found', -404);
        }

        return $show;
    }

    public function store($data)
    {
        $list = auth()->user()->taskList->find($data['list_id']);

        if (!$list) {
            throw new \Exception('List not found', -404);
        }

        if ($list['user_id'] !== auth()->user()->id) {
            throw new \Exception('This lits doesnt belong this user.', -403);
        }

        $list->update(['status' => 0]);

        return $list->tasks()->create($data); 
    }

    public function updateTask($data, $id)
    {
        $task = $this->show($id);

        $task->update($data);
        return $task;
    }

    public function destroy($id)
    {
        $task = $this->show($id);
        $task->delete();
        
        $list = auth()->user()->taskList->find($task['list_id']);

        $taskOpen = Auth()->user()->tasks
            ->where('list_id', '=', $task['list_id'])
            ->where('status', 0);
        
        if(count($taskOpen) === 0){
            $list->update(['status' => 1]);
        }

        return New Tasks;
    }

    public function tasksByList($list_id)
    {
        $tasks = auth()
            ->user()
            ->tasks
            ->where('list_id', '=', $list_id);

        return $tasks;
    }

    public function closeTask($id)
    {
        $task = $this->show($id);

        $task->update(['status' => 1]);
        
        $list = auth()->user()->taskList->find($task['list_id']);

        $taskOpen = auth()
            ->user()
            ->tasks
            ->where('list_id', '=', $task['list_id'])
            ->where('status', 0);
        
        if(count($taskOpen) === 0){
            $list->update(['status' => 1]);
        }

        return $task;
    }
}
