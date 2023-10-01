<?php

namespace App\Repositories\Interfaces;

interface IBaseRepository
{
    public function index();
    public function show(int $id);
    public function store(array $data);
    public function update(array $data, int $id);
    public function destroy(int $id);
}
