<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Utils\CrudRepoImpl;

class TaskRepository extends CrudRepoImpl
{

    public function createBatchTasks(array $tasksData){
        Task::insert($tasksData);
    }

    public function getTaskbyidAndUser($id , $userId){
        return Task::where("id", $id)->where("user_id" , $userId)->first();
    }

    public function updateTaskStatus(Task $task, $status){
        $task->status = $status;
        $task->save();
    }

}
