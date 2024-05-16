<?php

namespace App\Http\Controllers;

use App\Models\ExpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExpSettingController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }
    
    public function update(Request $request)
    {
        $validation = $request->validate([
            'exp_bronze' => ['required', 'integer', 'min:0', 'lte:exp_silver'],
            'exp_silver' => ['required', 'integer', 'min:0', 'gte:exp_bronze'],
            'exp_gold' => ['required', 'integer', 'min:0', 'gte:exp_silver'],
            'exp_purple' => ['required', 'integer', 'min:0', 'gte:exp_gold'],
            'exp_emerald' => ['required', 'integer', 'min:0', 'gte:exp_purple'],
            'do_quest' => ['required', 'integer', 'min:0'],
            'do_asg' => ['required', 'integer', 'min:0'],
            'do_exam' => ['required', 'integer', 'min:0'],
            'do_project' => ['required', 'integer', 'min:0'],
            'create_task' => ['required', 'integer', 'integer', 'min:0'],
            'create_question' => ['required', 'integer', 'min:0']

        ]);

        if ($validation) {
            $expSetting = ExpSetting::first();
            $expSetting->update([
                'exp_bronze' => $request->exp_bronze,
                'exp_silver' => $request->exp_silver,
                'exp_gold' => $request->exp_gold,
                'exp_purple' => $request->exp_purple,
                'exp_emerald' => $request->exp_emerald,
                'do_quest' => $request->do_quest,
                'do_asg' => $request->do_asg,
                'do_exam' => $request->do_exam,
                'do_project' => $request->do_project,
                'create_task' => $request->create_task,
                'create_question' =>  $request->create_question
            ]);

            $this->message('Exp Setting Successfully Updated!', 'success');
            return back();
        }
    }
}
