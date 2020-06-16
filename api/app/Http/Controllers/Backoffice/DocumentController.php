<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $disk;
    protected $documentService;

    /**
     * DocumentController constructor.
     */
    public function __construct()
    {
        $this->disk = 'documents';
        $this->documentService = new DocumentService($this->disk);
    }

    /*
    * Upload new document
    */
    public function upload(Request $request)
    {   
        $folder = $request->folder;
        $filesArray = $request->toArray()['files'];

        $downloadUrls = [];

        foreach ($filesArray as $key => $file) {
            $filename = $file['name'];
            $path = "$folder/$filename";

            $document = $this->documentService
                ->uploadAndGetFileUrl($path, $file['data']);
        
            $downloadLink = $this->documentService->getDownloadLink($folder, $filename);
            $downloadUrls[] = [
                'name' => $filename,
                'path' => $downloadLink
            ];
        }

        return response()->json([
            'data' => [
                'files' => $downloadUrls
            ]
        ]);
    }

    public function download ($folder, $fileName) {
        return response()
            ->download(storage_path("uploads/documents/$folder/$fileName"));
    }
}
