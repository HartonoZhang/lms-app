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

    // public function getMaterialFile(Request $request, $id){
    //     $filePath = "materials/session_{$id}_{$request->sessionId}/" . $request->fileName;
    //     $materialPath = Storage::path($filePath);
    //     if (Storage::exists($filePath)) {
    //         return response()->download($materialPath);
    //     } else {
    //         abort(404);
    //     }
    // }

    // public function addMaterial(Request $request, $id){
    //     $validator = Validator::make(
    //         $request->all(),
    //         rules: [
    //             'type' => 'required',
    // 'sessionId' => 'required',
    // 'title' => 'required',
    // 'link' => 'required_if:type,link|url:http,https',
    // 'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
    //     }

    //     if ($request->type == 'file') {
    //         $file = $request->file('file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         // $fileName = str_replace(' ', '_', $fileName);
    //         // $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
    //         $filePath = "materials/session_{$id}_{$request->sessionId}/" . $fileName;
    //         Storage::put($filePath, file_get_contents($file));
    //         Material::create([
    //             'session_id' => $request->sessionId,
    //             'title' => $request->title,
    //             'value' => $fileName,
    //             'is_file' => 1,
    //         ]);
    //     } else {
    //         Material::create([
    //             'session_id' => $request->sessionId,
    //             'title' => $request->title,
    //             'value' => $request->link,
    //             'is_file' => 0,
    //         ]);
    //     }

    //     return response()->json(['success' => 'success']);
    // }

    // public function editMaterial(Request $request){
    //     $validator = Validator::make(
    //         $request->all(),
    //         rules: [
    //             'type' => 'required',
    //             'sessionId' => 'required',
    //             'link' => 'required_if:type,link|url:http,https',
    //             'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
    //     }

    //     if ($request->type == 'file') {
    //         $file = $request->file('file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
    //         $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $fileName;
    //         Storage::put($filePath, file_get_contents($file));
    //         $material = Material::find($request->materialId);
    //         $material->value = $fileName;
    //         $material->is_file = 1;
    //         $material->save();
    //     } else {
    //         $material = Material::find($request->materialId);
    //         $material->value = $request->link;
    //         $material->is_file = 0;
    //         $material->save();
    //     }

    //     return response()->json(['success' => 'success']);
    // }

    // public function deleteMaterial(Request $request){
    //     $material = Material::find($request->materialId);
    //     if ($material->is_file) {
    //         $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
    //         $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $material->value;
    //         Storage::delete($filePath);
    //     }
    //     $material->delete();

    //     return response()->json(['success' => 'success']);
    // }

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
            return back();
        }
    }

    public function updateMaterial($id)
    {
        $material = Material::findOrFail($id);
        return view('pages.materials.edit', [
            'material' => $material,
            'classroom' => $material->session->classroom
        ]);
    }

    public function editMaterial(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'title' => ['required'],
            'value' => ['required', 'url']
        ]);

        if ($material->is_file) {
            $validate = Validator::make($request->all(), [
                'file_upload' => ['mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc,txt', 'max:2048'],
                'title' => ['required']
            ]);
        }

        if ($validate->fails()) {
            return back()->withInput($request->input())->withErrors($validate);
        } else {
            $value = '';
            if ($material->is_file) {
                if ($request->file('file_upload')) {
                    $extension = $request->file('file_upload')->getClientOriginalExtension();
                    $value = Auth::user()->id . '-' . now()->timestamp . '.' . $extension;
                    $request->file('file_upload')->move('assets/material', $value);
                }else {
                    $value = $material->value;
                }
            } else {
                $value = $request->value;
            }

            $material->update([
                'title' => $request->title,
                'value' => $value
            ]);

            return redirect()->route('teacher-course-detail', $material->session->classroom->id)->with(['status' => 'success', 'message' => 'Successfully update material']);
        }
    }

    public function deleteMaterial($id)
    {
        $material = Material::findOrFail($id);
        $this->message('Successfully remove material "'.$material->title.'"', 'success');
        $material->delete();
        return back();
    }
}
