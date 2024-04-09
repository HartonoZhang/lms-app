<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuestQuestion;
use App\Models\QuestStudentAnswer;
use App\Models\Student;
use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function studentView()
    {
        $answerData = QuestQuestion::with(['questStudentAnswer.student', 'course'])->whereHas('questStudentAnswer.student', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();
        $studentData = Student::where('user_id', '=', Auth::user()->id)->first();
        $listQuestion = QuestQuestion::with(['questStudentAnswer.student', 'course'])->get();
        return view('pages.quests.student.index', [
            'listQuestion' => $listQuestion,
            'studentData' => $studentData,
            'answerData' => $answerData,
        ]);
    }

    public function doQuest($id)
    {
        $student = Student::where('user_id', '=', Auth::user()->id)->first();
        $question = QuestQuestion::findOrFail($id);
        $questionAnswer = QuestStudentAnswer::with('questQuestion')->where([['student_id', '=', $student->id], ['quest_question_id', '=', $id]])->first();
        if($questionAnswer){
            return back();
        }
        return view('pages.quests.student.do-quest', [
            'question' => $question
        ]);
    }

    public function checkBadge($student, $level)
    {
        $badge = $student->badge_name;
        if ($level >= 1 && $level <= 50) {
            $badge = 'bronze';
        }else if($level >= 51 && $level <= 100) {
            $badge = 'silver';
        }else if($level >= 101 && $level <= 150) {
            $badge = 'gold';
        }else if($level >= 151 && $level <= 200) {
            $badge = 'purple';
        }else if($level >= 200) {
            $badge = 'emerald';
        }
        return $badge;
    }

    public function updateExpAndLevel($profile)
    {
        $currentExp = $profile->current_exp + 10;
        $currentLevel = $profile->level;

        if($currentExp % 100 === 0) {
            $currentLevel += 1;
        }

        $badge = $this->checkBadge($profile, $currentLevel);

        $profile->update([
            'current_exp' => $currentExp,
            'level' => $currentLevel,
            'badge_name' => $badge,
        ]);
    }

    public function validateQuestAnswer(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'option' => ['required']
        ]);

        if ($validate->fails()) {
            $this->message('Please select the answer', 'fail');
            return back();
        } else {
            $question = QuestQuestion::findOrFail($id);
            $student = Student::with('profile')->where('user_id', '=', Auth::user()->id)->first();
            $status = '';
            if ($question->correct_answer === $request->option) {
                $status = 'Correct';
            } else {
                $status = 'Wrong';
            }
            QuestStudentAnswer::create([
                'quest_question_id' => $id,
                'student_id' => $student->id,
                'answer' => $request->option,
                'status' => $status
            ]);
            if($status === 'Correct') {
                $this->updateExpAndLevel($student->profile);
            }
            return redirect()->route('quest-answer-result', $id);
        }
    }

    public function questResult($id)
    {
        $student = Student::where('user_id', '=', Auth::user()->id)->first();
        $questionAnswer = QuestStudentAnswer::with('questQuestion')->where([['student_id', '=', $student->id], ['quest_question_id', '=', $id]])->first();
        return view('pages.quests.student.result', [
            'student' => $student,
            'questionAnswer' => $questionAnswer,
            'question' => $questionAnswer->questQuestion
        ]);
    }

    public function teacherView()
    {
        $teacher = Teacher::where('user_id', '=', Auth::user()->id)->first();
        $listQuestion = QuestQuestion::where('teacher_id', '=', $teacher->id)->get();
        return view('pages.quests.teacher.index', [
            'listQuestion' => $listQuestion
        ]);
    }

    public function createQuestion()
    {
        $listCourse = Course::all();
        $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
        return view('pages.quests.teacher.create', [
            'listCourse' => $listCourse,
            'teacher' => $teacher
        ]);
    }

    public function addQuestion(Request $request)
    {
        $validation = $request->validate([
            'course_id' => ['required'],
            'question' => ['required'],
            'answer1' => ['required', 'different:answer2', 'different:answer3', 'different:answer4'],
            'answer2' => ['required', 'different:answer1', 'different:answer3', 'different:answer4'],
            'answer3' => ['required', 'different:answer1', 'different:answer2', 'different:answer4'],
            'answer4' => ['required', 'different:answer1', 'different:answer2', 'different:answer3'],
            'correct_answer' => [
                "required",
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $listAnswer = [$request->answer1, $request->answer2, $request->answer3, $request->answer4];
                    if (!in_array($request->correct_answer, $listAnswer)) {
                        $fail("Must be the same as one of the four answers above.");
                    }
                }
            ],
        ], ["correct_answer.required" => "The correct answer field is required."]);

        if ($validation) {
            QuestQuestion::create([
                'teacher_id' => $request->teacher_id,
                'course_id' => $request->course_id,
                'question' => $request->question,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
                'correct_answer' => $request->correct_answer
            ]);
            $teacher = Teacher::with('profile')->where('user_id', '=', Auth::user()->id)->first();
            $this->updateExpAndLevel($teacher->profile);

            return redirect()->route('teacher-quest')->with(['status' => 'success', 'message' => 'Successfully add new question']);
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = QuestQuestion::findOrfail($id);
        $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
        $listCourse = Course::all();
        return view('pages.quests.teacher.edit', [
            'question' => $question,
            'listCourse' => $listCourse,
            'teacher' => $teacher
        ]);
    }

    public function editQuestion(Request $request, $id)
    {
        $validation = $request->validate([
            'course_id' => ['required'],
            'question' => ['required'],
            'answer1' => ['required', 'different:answer2', 'different:answer3', 'different:answer4'],
            'answer2' => ['required', 'different:answer1', 'different:answer3', 'different:answer4'],
            'answer3' => ['required', 'different:answer1', 'different:answer2', 'different:answer4'],
            'answer4' => ['required', 'different:answer1', 'different:answer2', 'different:answer3'],
            'correct_answer' => [
                "required",
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $listAnswer = [$request->answer1, $request->answer2, $request->answer3, $request->answer4];
                    if (!in_array($request->correct_answer, $listAnswer)) {
                        $fail("Must be the same as one of the four answers above.");
                    }
                }
            ],
        ], ["correct_answer.required" => "The correct answer field is required."]);

        if ($validation) {
            $quest = QuestQuestion::findOrFail($id);
            $quest->update([
                'course_id' => $request->course_id,
                'question' => $request->question,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
                'correct_answer' => $request->correct_answer
            ]);

            return redirect()->route('teacher-quest')->with(['status' => 'success', 'message' => 'Successfully update question']);
        }
    }

    public function deleteQuestion($id)
    {
        $quest = QuestQuestion::findOrFail($id);
        $this->message('Successfully remove student "' . $quest->question . '"', 'success');
        $quest->delete();
        return back();
    }
}
