<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DocumentService
{
    public array $config = [];

    public function __construct()
    {
        $this->config =[
            "type" => "desktop",
            "documentType"=> "word",
            'document' => [
                'fileType' => 'docx',
                'key' => uniqid(),
                'title' => "test title",
                'url' => "http://proxy/download/test.docx",
            ],
            'editorConfig' => [
                "mode" => "edit",
                'callbackUrl' => "http://proxy/documents/save",
            ],
        ];
    }

    public function getOrCreateFileByName($filename = "test.docx")
    {
        sendlog("downloading file", 'download');

        $filePath = public_path($filename);

        if (!file_exists($filePath)) {
            file_put_contents(public_path($filename), "");
        }

        return $filePath;
    }

    /**
     * @throws \Exception
     */
    public function saveFile($data)
    {
        sendlog("start saving process", 'save');

        if (!isset($data['url'])) {
            throw new \Exception("url is required");
        }

        $downloadUri = $data['url'];
        $downloadUri = str_replace("http://localhost:8081", "http://proxy:8080", $downloadUri);

        try {
            $response = Http::get($downloadUri);
            if (!$response->successful()) {
                throw new \Exception("Bad response");
            }

            $path_for_save = public_path('/test.docx');

            file_put_contents($path_for_save, $response->body(), LOCK_EX);

            sendlog("end saving process", 'save');
        } catch (\Exception $e) {
            sendlog("saving process error" . $e->getMessage(), "save");

        }
    }
}
