<?php

namespace App\Http\Controllers;

use App\Models\ExpLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpLogController extends Controller
{
    public function list()
    {
        $expLog = ExpLog::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.exp-log.list')->with([
            'expLog' => $expLog
        ]);
    }
}
