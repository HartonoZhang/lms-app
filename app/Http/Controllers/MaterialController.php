<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function getMaterialFile(Request $request, $id){
        $filePath = "materials/session_{$id}_{$request->sessionId}/" . $request->fileName;
        $materialPath = Storage::path($filePath);
        if (Storage::exists($filePath)) {
            return response()->download($materialPath);
        } else {
            abort(404);
        }
    }

    public function addMaterial(Request $request, $id){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'type' => 'required',
                'sessionId' => 'required',
                'title' => 'required',
                'link' => 'required_if:type,link|url:http,https',
                'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }

        if ($request->type == 'file') {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $fileName = str_replace(' ', '_', $fileName);
            // $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$id}_{$request->sessionId}/" . $fileName;
            Storage::put($filePath, file_get_contents($file));
            Material::create([
                'session_id' => $request->sessionId,
                'title' => $request->title,
                'value' => $fileName,
                'is_file' => 1,
            ]);
        } else {
            Material::create([
                'session_id' => $request->sessionId,
                'title' => $request->title,
                'value' => $request->link,
                'is_file' => 0,
            ]);
        }

        return response()->json(['success' => 'success']);
    }

    public function editMaterial(Request $request){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'type' => 'required',
                'sessionId' => 'required',
                'link' => 'required_if:type,link|url:http,https',
                'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }

        if ($request->type == 'file') {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $fileName;
            Storage::put($filePath, file_get_contents($file));
            $material = Material::find($request->materialId);
            $material->value = $fileName;
            $material->is_file = 1;
            $material->save();
        } else {
            $material = Material::find($request->materialId);
            $material->value = $request->link;
            $material->is_file = 0;
            $material->save();
        }

        return response()->json(['success' => 'success']);
    }

    public function deleteMaterial(Request $request){
        $material = Material::find($request->materialId);
        if ($material->is_file) {
            $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $material->value;
            Storage::delete($filePath);
        }
        $material->delete();

        return response()->json(['success' => 'success']);
    }
}
