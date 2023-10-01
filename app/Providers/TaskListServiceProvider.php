<?php

namespace App\Providers;

use App\Repositories\Interfaces\ITaskListRepository;
use App\Repositories\TaskListRepository;
use Illuminate\Support\ServiceProvider;

class TaskListServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ITaskListRepository::class, TaskListRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
