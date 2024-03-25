<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function getTaskData(Request $request, $id)
    {
        $class = Classroom::find($id);
        $tasks = $class->tasks;
        $tasks->load('category');
        foreach ($tasks as $task) {
            $task->dueDate = $task->getDueDate();
            $task->timeRemaining = $task->getTimeRemaining();
            $task->studentSubmitted = $task->uploads->count();
        }
        $data = [
            'tasks' => $tasks,
            'studentCount' => $class->studentClassroom->count(),
        ];
        return response()->json($data);
    }

    public function getTaskDetail(Request $request, $id)
    {
        if (!$request->taskId) {
            return response()->json(['data' => null]);
        }
        $taskUploads = Task::find($request->taskId)->uploads;
        $taskUploads->load('student.user');
        $data = [];
        foreach ($taskUploads as $upload) {
            $data[] = [
                'id' => $upload->id,
                'student_name' => $upload->student->user->name,
                'file' => $upload->file_upload ?? false,
                'upload_date' => $upload->upload_date ?? '-',
                'status' => $upload->status ?? 'Not Submitted',
                'score' => $upload->score ?? '-'
            ];
        }
        $totalData = $taskUploads->count();
        $totalFiltered = $totalData;
        $json = [
            "draw"            => intval($request->draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ];

        return response()->json($json);
    }

    public function getTaskUploadFile(Request $request, $id)
    {
        $taskUpload = TaskUpload::find($request->taskUploadId);
        if (!$taskUpload) {
            abort(404);
        }
        $filePath = "task_uploads/task_{$request->taskUploadId}/" . $taskUpload->file_upload;
        $taskUploadPath = Storage::path($filePath);
        if (Storage::exists($filePath)) {
            return response()->download($taskUploadPath, $taskUpload->file_upload);
        } else {
            abort(404);
        }
    }

    public function taskUpload(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'file_upload_'.$id => ['required', 'mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc', 'max:2048']
        ]);

        if ($validate->fails()) {
            Session::flash('failSubmitAnswer', $id);
            return back()->withErrors($validate);
        } else {
            $extension = $request->file('file_upload_'.$id)->getClientOriginalExtension();
            $fileName = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
            $request->file('file_upload_'.$id)->move('assets/tasks/answer', $fileName);

            $student = Student::where('user_id', '=', Auth::user()->id)->first();
            $isTaskUploaded = TaskUpload::where([
                ['student_id', '=', $student->id],
                ['task_id', '=', $id],
            ])->first();

            if($isTaskUploaded === null) {
                TaskUpload::create([
                    'task_id' => $id,
                    'student_id' => $student->id,
                    'file_upload' => $fileName,
                    'status' => 'In Review'
                ]);
            }else {
                $isTaskUploaded->update([
                    'file_upload' => $fileName,
                    'status' => 'In Review'
                ]);
            }

        
            $this->message('Upload task successfully', 'success');
            return back();
        }
    }
}
