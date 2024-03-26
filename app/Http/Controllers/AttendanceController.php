<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\StudentClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function teacherCourseDetailAttendance($id)
    {
        $courseController = new CourseController();
        $data = $courseController->teacherCourseDetail($id);
        return view('pages.courses.teacher.attendance', [
            'classroom' => $data['classroom'],
            'sessions' => $data['sessions'],
            'teacherClassroom' => $data['teacherClassroom']
        ]);
    }

    public function teacherCourseDetailAttendanceView(Request $request, $id, $sessionId)
    {
        // TODO filter student_id
        $courseController = new CourseController();
        $data = $courseController->teacherCourseDetail($id);
        $session = \App\Models\Session::find($sessionId);
        $class = Classroom::find($id);
        $listStudent = $class->studentClassroom()
            ->whereHas('student.user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            });
        if ($request->attendanceFilter == 'present') {
            $listStudent = $listStudent->whereHas('student.attendanceBySession', function ($query) use ($request, $sessionId){
                $query->where('session_id', $sessionId)->where('is_present', 1);
            });
        } else if ($request->attendanceFilter == 'notPresent') {
            $listStudent = $listStudent->where(function ($query) use ($request, $sessionId) {
                $query->whereHas('student.attendanceBySession', function ($query) use ($request, $sessionId) {
                    $query->where('session_id', $sessionId)->where('is_present', 0);
                })->orWhereDoesntHave('student.attendanceBySession', function ($query) use ($sessionId) {
                    $query->where('session_id', $sessionId);
                });
            });
        }
        $listStudent = $listStudent->with(['student.user', 'student.attendanceBySession' => function ($query) use ($sessionId) {
            $query->where('session_id', $sessionId);
        }])->paginate(10);
        session()->flash('attendance_name', $request->name);
        session()->flash('attendance_student_id', $request->studentId);
        session()->flash('attendance_filter', $request->attendanceFilter);
        return view('pages.courses.teacher.attendance-view', [
            'classroom' => $data['classroom'],
            'session' => $session,
            'teacherClassroom' => $data['teacherClassroom'],
            'listStudent' => $listStudent
        ]);
    }

    public function teacherCourseDetailAttendanceSave(Request $request, $id, $sessionId){
        $data = [];
        foreach ($request->present ?? [] as $studentId) {
            $data[] = ['session_id' => $sessionId, 'student_id' => $studentId, 'is_present' => 1];
        }
        foreach ($request->notPresent ?? [] as $studentId) {
            $data[] = ['session_id' => $sessionId, 'student_id' => $studentId, 'is_present' => 0];
        }
        Attendance::upsert($data, uniqueBy: ['session_id', 'student_id'], update: ['is_present']);
        return back()->with(['status' => 'success', 'message' => 'Attandance saved successfully.']);
    }
}
