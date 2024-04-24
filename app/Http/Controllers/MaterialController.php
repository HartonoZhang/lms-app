<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function addMaterial(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'material_sessionId' => 'required',
            'material_title' => 'required',
            'material_value' => ['required', 'url']
        ]);

        if ($request->is_file) {
            $validate = Validator::make($request->all(), [
                'file_upload' => ['required', 'mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc,txt', 'max:2048'],
                'material_sessionId' => 'required',
                'material_title' => 'required'
            ]);
        }

        if ($validate->fails()) {
            Session::flash('failCreateMaterial');
            return back()->withInput($request->input())->withErrors($validate);
        } else {
            $value = '';
            $isFile = 0;
            if ($request->is_file) {
                $extension = $request->file('file_upload')->getClientOriginalExtension();
                $value = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
                $request->file('file_upload')->move('assets/material', $value);
                $isFile = 1;
            } else {
                $value = $request->material_value;
            }

            Material::create([
                'session_id' => $request->material_sessionId,
                'title' => $request->material_title,
                'value' => $value,
                'is_file' => $isFile
            ]);

            $this->message('Add new material successfully', 'success');
            $previousUrl = app('url')->previousPath();
            return redirect()->to($previousUrl . '?' . http_build_query(['session' => $request->material_sessionId]));
        }
    }

    public function deleteMaterial($id)
    {
        $material = Material::findOrFail($id);
        $sessionId = $material->session_id;
        $this->message('Successfully remove material "' . $material->title . '"', 'success');
        $material->delete();
        $previousUrl = app('url')->previousPath();
        return redirect()->to($previousUrl . '?' . http_build_query(['session' => $sessionId]));
    }
}
