<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function filterAttendance(Request $request, $id){
        // $validator = Validator::make(
        //     $request->all(),
        //     rules: [
        //         'name' => 'required_without_all:name,studentId',
        //         'studentId' => 'required_without_all:name,studentId',
        //     ]
        // );

        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        // }

        $class = Classroom::find($id);
        $students = $class->studentClassroom()->whereHas('student.user', function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        })->where(function ($query) use ($request) {
            if ($request->attendanceFilter == 'present') {
                $query->whereHas('student.attendanceBySession', function ($query) {
                    $query->where('is_present', 1);
                });
            } else if ($request->attendanceFilter == 'notPresent') {
                $query->whereDoesntHave('student.attendanceBySession')
                    ->orWhereHas('student.attendanceBySession', function ($query) {
                        $query->whereNull('is_present')
                            ->orWhere('is_present', 0);
                    });
            }
        })->with(['student.user', 'student.attendanceBySession'])->get()->toArray();

        $data = [
            'success' => 'success',
            'students' => $students,
        ];
        return response()->json($data);
    }

    public function saveAttendance(Request $request, $id){
        // $validator = Validator::make(
        //     $request->all(),
        //     rules: [
        //         'name' => 'required_without_all:name,studentId',
        //         'studentId' => 'required_without_all:name,studentId',
        //     ]
        // );
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        // }

        $data = [];
        foreach ($request->present ?? [] as $studentId) {
            $data[] = ['session_id' => (int) $request->sessionId, 'student_id' => (int) $studentId, 'is_present' => 1];
        }
        foreach ($request->notPresent ?? [] as $studentId) {
            $data[] = ['session_id' => (int) $request->sessionId, 'student_id' => (int) $studentId, 'is_present' => 0];
        }
        Attendance::upsert($data, uniqueBy: ['session_id', 'student_id'], update: ['is_present']);
        // $class = Classroom::find($id);
        // $students = $class->studentClassroom->load([
        //     'student.user',
        //     'student.attendanceBySession' => function ($query) use ($request) {
        //         $query->where('session_id', $request->sessionId);
        //     },
        // ]);

        $data = [
            'success' => 'success',
            // 'students' => $students,
        ];
        return response()->json($data);
    }
}
