<?php

namespace App\Repositories\Interfaces;

interface ITaskListRepository
{
    public function index();
    public function create($data);
    public function show($id);
    public function updateList($data, $id);
    public function destroyList($id);
}
