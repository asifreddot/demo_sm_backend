<?php

namespace App\Services\Task;

use App\Utils\ResponseUtils;
use App\Utils\ValidatorUtils;
use Illuminate\Http\Request;

class TaskService extends TaskRepository implements TaskInterface
{

    public function getAllTask()
    {
        $data= $this->findAll("Task");
        return ResponseUtils::message($data, 'Success');
    }

    public function getAllTaskByUser()
    {
        $conditions = [
            'user_id' => auth()->user()->id,
            'status' => ['!=', 'delete'],
        ];

        $data= $this->findAll("Task" , 10,$conditions);
        return ResponseUtils::message($data, 'Success');
    }

    public function saveTask(Request $request)
    {

        $validator = ValidatorUtils::taskCreateValidate($request->all());
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'Validation error', 401);
        }
        // Add login user in request
        $modifiedData = $this->addDefaultUser($request->all());

        $task = $this->save("Task",$modifiedData);
        return ResponseUtils::message($task, 'Task create successful');
    }

    public function storeBulkTasks(Request $request){
        $tasksData = $request->tasks;
        foreach ($tasksData as &$task) {
            $task['user_id'] = auth()->user()->id;
        }
        $this->createBatchTasks($tasksData);
        return ResponseUtils::message('Task create successful', "success");
    }


    private function addDefaultUser(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }

    public function updateTask(Request $request)
    {
        $validator = ValidatorUtils::taskUpdateValidate($request->all());;
        if ($validator->fails()) {
            return ResponseUtils::message(['errors' => $validator->errors()], 'Validation error',401);
        }
        $task = $this->update("Task",$request->all() , $request->id);
        return ResponseUtils::message($task, 'Task create successful');
    }

    public function deleteTask($id)
    {
        $task = $this->getTaskbyidAndUser($id ,auth()->user()->id);
        if($task){
            $this->delete("Task",$id);
            return ResponseUtils::message(['success' => "Task deleted success"], 'success');
        }else{
            return ResponseUtils::message(['errors' => "Invalid Task"], 'error' , 401);
        }
    }

    public function changeStatus(Request $request)
    {
        $task = $this->findById("Task",$request->id);
        if($task){
            $this->updateTaskStatus($task, $request->status);
            return ResponseUtils::message(['success' => "Status update success"], 'success');
        }else{
            return ResponseUtils::message(['errors' => "Invalid Task"], 'error',401);
        }
    }
}
