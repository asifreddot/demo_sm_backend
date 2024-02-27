<?php

namespace App\Services\Task;
use Illuminate\Http\Request;

interface TaskInterface
{
    /**
     * Retrieve all tasks.
     *
     * @return array An array containing all tasks.
     */
    public function getAllTask();

    /**
     * Retrieve all tasks associated with a user.
     *
     * @return array An array containing all tasks for a specific user.
     */
    public function getAllTaskByUser();

    /**
     * Save a new task based on the provided request data.
     *
     * @param Request $request The request object containing task information.
     * @return void
     */
    public function saveTask(Request $request);


    /**
     * Store tasks in bulk using Eloquent.
     *
     * @param array $tasksData An array containing task data to be stored.
     * @return void
     */
    public function storeBulkTasks(Request $request);


    /**
     * Update an existing task based on the provided request data.
     *
     * @param Request $request The request object containing updated task information.
     * @return void
     */
    public function updateTask(Request $request);

    /**
     * Delete a task by its identifier.
     *
     * @param int $id The identifier of the task to be deleted.
     * @return void
     */
    public function deleteTask($id);
}
