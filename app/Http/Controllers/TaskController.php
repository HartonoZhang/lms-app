<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTaskData(Request $request, $id){
        $class = Classroom::find($id);
        $tasks = $class->tasks;
        $tasks->load('category');
        foreach ($tasks as $task) {
            $task->dueDate = $task->getDueDate();
            $task->timeRemaining = $task->getTimeRemaining();
        }
        $data = [
            'tasks' => $tasks,
        ];
        return response()->json($data);
    }

    public function getTaskDetail(Request $request, $id){
        // $class = Classroom::find($id);
        // $tasks = $class->tasks;
        // $tasks->load('category');
        // foreach ($tasks as $task) {
        //     $task->dueDate = $task->getDueDate();
        //     $task->timeRemaining = $task->getTimeRemaining();
        // }
        // $data = [
        //     'tasks' => $tasks,
        // ];
        // return response()->json($data);
    }
}
