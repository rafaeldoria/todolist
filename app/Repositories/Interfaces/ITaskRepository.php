<?php

namespace App\Repositories\Interfaces;

interface ITaskRepository
{
    public function index();
    public function store($id);
    public function show($id);
    public function updateTask($data, $id);
    public function destroy($id);
    public function closeTask($data);
    public function tasksByList($id);
}
