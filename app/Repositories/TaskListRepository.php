<?php

namespace App\Repositories;

use App\Models\TaskList;
use App\Repositories\Interfaces\ITaskListRepository;

class TaskListRepository implements ITaskListRepository
{
    public function index() : TaskList {
        return auth()->user()->TaskList->sortBy('status');
    }

    public function create($data) : TaskList {
        return auth()->user()->TaskList->create($data);
    }

    public function show($id) : TaskList {
        $taskList = auth()->user()->TaskList->find($id);

        if(!$taskList){
            throw new \Exception('Not found', -404);
        }

        return $taskList;
    }

    public function updateList($data, $id) : TaskList {
        $taskList = $this->show($id);
        $taskList->update($data);
        return $taskList;
    }

    public function destroyList($id) : void {
        $taskList = $this->show($id);
        $taskList->delete();
    }
}
