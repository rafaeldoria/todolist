<?php

namespace App\Repositories;

use App\Models\TaskList;
use App\Models\User;
use App\Repositories\Interfaces\ITaskListRepository;

class TaskListRepository implements ITaskListRepository
{
    public function index() {
        return Auth()->User()->taskList;
    }

    public function create($data) : TaskList {
        $data['user_id'] = auth()->User()->id;
        return TaskList::create($data);
    }

    public function show($id) : TaskList {
        $taskList = auth()->user()->taskList->find($id);

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

    public function destroyList($id) : TaskList {
        $taskList = $this->show($id);
        $taskList->delete();
        return new TaskList;
    }
}
