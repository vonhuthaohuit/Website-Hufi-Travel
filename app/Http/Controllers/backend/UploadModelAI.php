<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadModelAI extends Controller
{
    public function index()
    {
        return view('backend.uploadmodelai.index');
    }
    public function upLoadModel()
    {
        $pythonScript = base_path('app/Traits/model_ai/app/public/store_vectors.py');
        $command = "python \"$pythonScript\" 2>&1";
        $output = system($command);

        return redirect()->back()->with('success', 'Upload model thành công');
    }
}
