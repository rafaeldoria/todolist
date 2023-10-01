<?php

namespace App\Repositories;

use App\Models\TaskList;

class TaskListRepository extends BaseRepository
{
    public function index() {
        return Auth()->User()->taskList;
    }

    public function show(int $id) : TaskList {
        $taskList = auth()->user()->taskList->find($id);

        if(!$taskList){
            throw new \Exception('Not found', -404);
        }

        return $taskList;
    }

    public function store(array $data) : TaskList {
        $data['user_id'] = auth()->User()->id;
        return TaskList::create($data);
    }


    public function update(array $data,int $id) : TaskList {
        $taskList = $this->show($id);
        $taskList->update($data);
        return $taskList;
    }

    public function destroy(int $id) : TaskList {
        $taskList = $this->show($id);
        $taskList->delete();
        return new TaskList;
    }
}
