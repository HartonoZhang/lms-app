<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }
    public function upsert($data){
        if($data->id == null){
            $result = Period::create([
                'name' => $data->period_name
            ]);
        } else {
            $result = Period::find($data->id)->update([
                'name' => $data->period_name
            ]);
        }
        return $result;
    }

    public function update(Request $request, $id){
        $oldData = Period::find($id);
        $validation = $request->validate([
            'period_name' => ['required','unique:periods,name,'.$id],
        ],[
            'period_name.unique' => '"'.$request->period_name.'" period already has been created',
        ]);
        if($validation){
            $request->merge(['id' => $id]);  
            $this->upsert($request);
            return redirect()->route('period-list')->with(['status'=> 'success','message'=> 'Period successfully updated.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }
    
    public function create(Request $request){
        $validation = $request->validate([
            'period_name' => ['required','unique:periods,name'],
        ],[
            'period_name.unique' => '"'.$request->period_name.'" period already has been created',
        ]);
        if($validation){
            $this->upsert($request);
            return redirect()->route('period-list')->with(['status'=> 'success','message'=> 'Period successfully created.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function delete($id){
        $period = Period::findOrFail($id);
        $this->message('Successfully remove period "'.$period->name.'"', 'success');
        $period->delete();
        return back();
    }
}