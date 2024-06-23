<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(
        private readonly DocumentService $documentService
    )
    {
    }

    public function show()
    {
        return view('editor', [
            'js_url' => config('services.onlyoffice.url') . "/web-apps/apps/api/documents/api.js",
            'config' => $this->documentService->config,
            'token' => generateToken($this->documentService->config)
        ]);
    }

    public function download($file)
    {
        try {
            $filePath = $this->documentService->getOrCreateFileByName($file);

            return response()->streamDownload(function () use ($filePath) {
                $fileStream = fopen($filePath, 'rb');
                fpassthru($fileStream);
                fclose($fileStream);
            }, $file);

        } catch (\Exception) {
            sendlog("error while downloading file", 'download');
            return ["error" => "File not found"];
        }
    }

    /**
     * @throws \Exception
     */
    public function save(Request $request): JsonResponse
    {
        $data = $request->all();

        if (isset($data['status']) && $data['status'] == 2) {
            $this->documentService->saveFile($data);
        }

        return response()->json(['error' => 0]);
    }
}
