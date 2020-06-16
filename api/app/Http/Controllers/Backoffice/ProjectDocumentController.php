<?php

namespace App\Http\Controllers\Backoffice;

use App\ProductDocument;
use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductDocumentRequest;
use App\Http\Resources\Documents\ProductDocumentResource;

class ProjectDocumentController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $productId)
    {
        $productDocuments = ProductDocument::where('base_product_id', $productId)->get();

        return ProductDocumentResource::collection($productDocuments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDocumentRequest $request)
    {
        $validated = $request->validated();
        $document = ProductDocument::create($validated);

        return new ProductDocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDocumentRequest $request, $productId, $id)
    {
        $validated = $request->validated();
        $document = ProductDocument::findOrFail($id);

        $document->fill($validated)->save();

        return new ProductDocumentResource($document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, $id)
    {   
        $document = ProductDocument::findOrFail($id);
        $path = '/' . $productId . '/' . $document->name;

        $this->documentService->deleteFile($path);
        $document->delete();

        return response()
            ->json([
                'status' => '200',
                'data' => 'Ok'  
            ]);
    }
}
