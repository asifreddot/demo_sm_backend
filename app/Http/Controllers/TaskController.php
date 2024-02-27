<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->taskService->getAllTask();
    }


    public function list()
    {
        return $this->taskService->getAllTaskByUser();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created batch resource in storage.
     */
    public function batchStore(Request $request)
    {
        return $this->taskService->storeBulkTasks($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->taskService->saveTask($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->taskService->updateTask($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->taskService->deleteTask($id);
    }

    /**
     * Update status the specified resource from storage.
     */
    public function changeStatus(Request $request)
    {
        return $this->taskService->changeStatus($request);
    }
}
