<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function saveAttendance(Request $request, $id, $sessionId){
        $present = [];
        if ($request["present-list-{$sessionId}"] ?? false) {
            $string = $request["present-list-{$sessionId}"];
            $present = explode(",", $string);
            $present = array_map('intval', $present);
        }
        $allStudentId = Classroom::find($id)->studentClassroom->pluck('student_id')->toArray() ?? [];
        $notPresent = array_diff($allStudentId, $present);
        $data = [];
        foreach ($present ?? [] as $studentId) {
            $data[] = ['session_id' => $sessionId, 'student_id' => $studentId, 'is_present' => 1];
        }
        foreach ($notPresent ?? [] as $studentId) {
            $data[] = ['session_id' => $sessionId, 'student_id' => $studentId, 'is_present' => 0];
        }
        Attendance::upsert($data, uniqueBy: ['session_id', 'student_id'], update: ['is_present']);

        $this->message('Attendance saved successfully.', 'success');
        $previousUrl = app('url')->previousPath();
        return redirect()->to($previousUrl . '?' . http_build_query(['session' => $request->sessionId]));
    }
}
