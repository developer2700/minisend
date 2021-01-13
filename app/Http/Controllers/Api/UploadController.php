<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class UploadController extends Controller
{

    /**
     * Store uploaded file in storage folder and return file name.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10240|mimetypes:image/*,application/pdf,.psd,application/*,text/*'
        ]);
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = '/storage/' . $request->file('file')->storeAs('uploads', $fileName, 'public');
            return response()->json(['filename'=>  $fileName] , 200);
        }
    }

    /**
     * Store uploaded file in storage folder and return file name.
     *
     * @param string $filename
     * @return \Illuminate\Http\JsonResponse
     */
    public function download(string $filename)
    {
        $path = storage_path().'/'.'app'.'/public/uploads/'.$filename;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

}
