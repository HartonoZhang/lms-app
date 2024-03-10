<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function create(Request $request){

    }

    public function delete($id){
        $classroom = Classroom::findOrFail($id);
        $this->message('Successfully remove classroom "'.$classroom->name.'"', 'success');
        $classroom->delete();
        return back();
    }
}
