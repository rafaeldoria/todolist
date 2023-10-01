<?php

namespace App\Repositories\Interfaces;

interface ITaskRepository extends IBaseRepository
{
    public function closeTask(int $id);
    public function tasksByList(int $list_id);
}
