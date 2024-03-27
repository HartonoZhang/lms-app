<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskUpload;
use App\Models\Teacher;
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

    public function taskUpload(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'file_upload_' . $id => ['required', 'mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc,txt', 'max:2048']
        ]);

        if ($validate->fails()) {
            Session::flash('failSubmitAnswer', $id);
            return back()->withErrors($validate);
        } else {
            $extension = $request->file('file_upload_' . $id)->getClientOriginalExtension();
            $fileName = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
            $request->file('file_upload_' . $id)->move('assets/tasks/answer', $fileName);

            $student = Student::where('user_id', '=', Auth::user()->id)->first();
            $isTaskUploaded = TaskUpload::where([
                ['student_id', '=', $student->id],
                ['task_id', '=', $id],
            ])->first();

            if ($isTaskUploaded === null) {
                TaskUpload::create([
                    'task_id' => $id,
                    'student_id' => $student->id,
                    'file_upload' => $fileName,
                    'status' => 'In Review'
                ]);
            } else {
                $isTaskUploaded->update([
                    'file_upload' => $fileName,
                    'status' => 'In Review'
                ]);
            }


            $this->message('Upload task successfully', 'success');
            return back();
        }
    }

    public function createTask($classroomId)
    {
        $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
        $classroom = Classroom::findOrFail($classroomId);
        $listCategory = TaskCategory::all();
        return view('pages.task.create', [
            'teacher' => $teacher,
            'classroom' => $classroom,
            'listCategory' => $listCategory
        ]);
    }

    public function addTask(Request $request, $classroomId)
    {
        $validation = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required', 'date', 'after_or_equal:now'],
            'file_upload' => ['required', 'mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc,txt', 'max:2048']
        ]);

        if ($validation) {
            $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
            $extension = $request->file('file_upload')->getClientOriginalExtension();
            $file = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
            $request->file('file_upload')->move('assets/tasks/question', $file);
           
            Task::create([
                'task_category_id' => $request->category_id,
                'teacher_id' => $teacher->id,
                'classroom_id' => $classroomId,
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'question_file' => $file
            ]);

            return redirect()->route('teacher-course-detail-assignment', $classroomId)->with(['status' => 'success', 'message' => 'Successfully create task']);
        }
    }

    public function taskDetail($classroomId, $taskId)
    {
        $task = Task::with('teacher', 'category')->findOrFail($taskId);
        $classroom = Classroom::findOrFail($classroomId);
        $listCategory = TaskCategory::all();
        $listUpload = TaskUpload::with('student')->where('task_id', '=', $taskId)->get();
        return view('pages.task.detail', [
            'task' => $task,
            'classroom' => $classroom,
            'listCategory' => $listCategory,
            'listUpload' => $listUpload
        ]);
    }

    public function updateTask($classroomId, $taskId)
    {
        $task = Task::with('teacher', 'category')->findOrFail($taskId);
        $classroom = Classroom::findOrFail($classroomId);
        $listCategory = TaskCategory::all();
        return view('pages.task.edit', [
            'task' => $task,
            'classroom' => $classroom,
            'listCategory' => $listCategory
        ]);
    }

    public function editTask(Request $request, $classroomId, $taskId)
    {
        $validation = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required', 'date'],
            'file_upload' => ['mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc,txt', 'max:2048']
        ]);

        if ($validation) {
            $task = Task::findOrFail($taskId);

            $file = '';
            if ($request->file('file_upload')) {
                $extension = $request->file('file_upload')->getClientOriginalExtension();
                $file = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
                $request->file('file_upload')->move('assets/tasks/question', $file);
            } else {
                $file = $task->question_file;
            }

            $task->update([
                'task_category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'question_file' => $file
            ]);

            return redirect()->route('task-detail', ['classroom' => $classroomId, 'task' => $taskId])->with(['status' => 'success', 'message' => 'Successfully update task']);
        }
    }

    public function doneUpload($taskId, $studentId)
    {
        $upload = TaskUpload::where([['task_id', '=', $taskId], ['student_id', '=', $studentId]])->first();
        if ($upload) {
            $upload->update([
                'status' => 'Done'
            ]);
        }
        $this->message('Change status done', 'success');
        return back();
    }

    public function revisionUpload($taskId, $studentId)
    {
        $upload = TaskUpload::where([['task_id', '=', $taskId], ['student_id', '=', $studentId]])->first();
        if ($upload) {
            $upload->update([
                'status' => 'Revision'
            ]);
        }
        $this->message('Change status revision', 'success');
        return back();
    }

    public function deleteTask($classroomId, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        return redirect()->route('teacher-course-detail-assignment', $classroomId)->with(['status' => 'success', 'message' => 'Successfully remove task']);
    }
}
