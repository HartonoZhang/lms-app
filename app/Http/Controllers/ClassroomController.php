<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\StudentClassroom;
use App\Models\TeacherClassroom;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassroomController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function upsertClassroom($data)
    {
        $assignment = $data->asg == null ? 0 : $data->asg;
        $exam = $data->exam == null ? 0 : $data->exam;
        $project = $data->project == null ? 0 : $data->project;
        if ($data->id == null) {
            $result = Classroom::create([
                "code" => $data->code,
                "name" => $data->name,
                "course_id" => $data->course,
                "student_capacity" => $data->student_capacity,
                "period_id" => $data->period,
                "asg" => $assignment,
                "project" => $exam,
                "exam" => $project,
                'min_score' => $data->min_score
            ]);
        } else {
            $result = Classroom::find($data->id)->update([
                "code" => $data->code,
                "name" => $data->name,
                "course_id" => $data->course,
                "student_capacity" => $data->student_capacity,
                "period_id" => $data->period,
                "asg" => $assignment,
                "project" => $exam,
                "exam" => $project,
                'min_score' => $data->min_score
            ]);
        }
        return $result;
    }

    public function upsertTeacherClassroom($data)
    {
        TeacherClassroom::where('classroom_id', $data->id)->delete();
        foreach ($data->teachers as $teacher) {
            $result = TeacherClassroom::create([
                "classroom_id" => $data->classroom_id,
                "teacher_id" => (int)$teacher
            ]);
        }
    }

    public function upsertStudentClassroom($data)
    {
        StudentClassroom::where('classroom_id', $data->id)->delete();
        foreach ($data->students as $student) {
            $result = StudentClassroom::create([
                "classroom_id" => $data->classroom_id,
                "student_id" => (int)$student
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $oldData = Classroom::find($id);
        $validation = $request->validate([
            "code" => ["max:10"],
            "name" => ["required"],
            "course" => ["required"],
            'period' => ['required'],
            'min_score' => ['required', 'integer', 'min:0', 'max:100'],
            "student_capacity" => ['nullable', 'integer', 'min:1'],
            "studentLists" => [
                "required",
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $studentList = explode(",", $value);
                    if (count($studentList) == 0) {
                        $fail("Must be at least 1 student in the class");
                    } else if ($request->student_capacity != null) {
                        if (count($studentList) > $request->student_capacity) {
                            $fail("Total student must not exceed max capacity for student");
                        }
                    }
                }
            ],
            "teacherLists" => [
                "required",
            ],
            "taskScore" => [
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $assignment = $request->asg == null ? 0 : $request->asg;
                    $exam = $request->exam == null ? 0 : $request->exam;
                    $project = $request->project == null ? 0 : $request->project;
                    $totalScore = $assignment + $exam + $project;
                    if ($totalScore != 100) {
                        $fail("Total sum of 3 fields must be 100 (currently is " . $totalScore . ")");
                    }
                }
            ]
        ], [
            "studentLists.required" => "Must be at least 1 student in the class",
            "teacherLists.required" => "Must be at least 1 teacher in the class",
            'asg.integer' => 'The assignment must be an integer.',
            'asg.min' => 'The assignment must be at least 0',
            'asg.max' => 'The assignment must not be greater than 100.',
        ]);

        if ($validation) {
            $request->merge(['id' => $oldData->id]);
            $classroom = $this->upsertClassroom($request);
            $request->merge(['classroom_id' => $oldData->id]);
            $request->merge(['students' => explode(",", $request->studentLists)]);
            $request->merge(['teachers' => explode(",", $request->teacherLists)]);

            $this->upsertTeacherClassroom($request);
            $this->upsertStudentClassroom($request);

            return redirect()->route('class-list')->with(['status' => 'success', 'message' => 'Class successfully updated.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            "code" => ["max:10"],
            "name" => ["required"],
            "course" => ["required"],
            'period' => ['required'],
            'min_score' => ['required', 'integer', 'min:0', 'max:100'],
            'asg' => ['nullable', 'integer', 'min:0', 'max:100'],
            'exam' => ['nullable', 'integer', 'min:0', 'max:100'],
            'project' => ['nullable', 'integer', 'min:0', 'max:100'],
            "student_capacity" => ['nullable', 'regex:/^[1-9]+$/'],
            "studentLists" => [
                "required",
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $studentList = explode(",", $value);
                    if (count($studentList) == 0) {
                        $fail("Must be at least 1 student in the class");
                    } else if ($request->student_capacity != null) {
                        if (count($studentList) > $request->student_capacity) {
                            $fail("Total student must not exceed max capacity for student");
                        }
                    }
                }
            ],
            "teacherLists" => [
                "required",
            ],
            "taskScore" => [
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $assignment = $request->asg == null ? 0 : $request->asg;
                    $exam = $request->exam == null ? 0 : $request->exam;
                    $project = $request->project == null ? 0 : $request->project;
                    $totalScore = $assignment + $exam + $project;
                    if ($totalScore != 100) {
                        $fail("Total sum of 3 fields must be 100 (currently is " . $totalScore . ")");
                    }
                }
            ]
        ], [
            "studentLists.required" => "Must be at least 1 student in the class",
            "teacherLists.required" => "Must be at least 1 teacher in the class",
            'asg.integer' => 'The assignment must be an integer.',
            'asg.min' => 'The assignment must be at least 0',
            'asg.max' => 'The assignment must not be greater than 100.',
        ]);
        if ($validation) {
            $classroom = $this->upsertClassroom($request);
            $request->merge(['classroom_id' => $classroom->id]);
            $request->merge(['students' => explode(",", $request->studentLists)]);
            $request->merge(['teachers' => explode(",", $request->teacherLists)]);

            $this->upsertTeacherClassroom($request);
            $this->upsertStudentClassroom($request);

            return redirect()->route('class-list')->with(['status' => 'success', 'message' => 'Class successfully created.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function updateStudentScore($classroomId, $studentId)
    {
        $studentScore = StudentClassroom::with('student')->where([['student_id', '=', $studentId], ['classroom_id', '=', $classroomId]])->first();
        $classroom = Classroom::findOrFail($classroomId);
        return view('pages.student-class-score.edit', [
            'classroom' => $classroom,
            'studentScore' => $studentScore
        ]);
    }

    public function editStudentScore(Request $request, $classroomId, $studentId)
    {
        $validation = $request->validate([
            'asg' => ['nullable', 'integer', 'min:0', 'max:100'],
            'project' => ['nullable', 'integer', 'min:0', 'max:100'],
            'exam' => ['nullable', 'integer', 'min:0', 'max:100']
        ]);

        if ($validation) {
            $studentScore = StudentClassroom::with('student')->where([['student_id', '=', $studentId], ['classroom_id', '=', $classroomId]])->first();
            $studentScore->update([
                'asg' => $request->asg,
                'project' => $request->project,
                'exam' => $request->exam
            ]);

            return redirect()->route('teacher-course-detail-score', $classroomId)->with(['status' => 'success', 'message' => 'Successfully update student score']);
        }
    }

    public function delete($id)
    {
        $classroom = Classroom::findOrFail($id);
        $this->message('Successfully remove classroom "' . $classroom->name . '"', 'success');
        $classroom->delete();
        return back();
    }
}
