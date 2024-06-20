<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function show()
    {
        $payload = [
            'document' => [
                'fileType' => 'docx',
                'key' => uniqid(),
                'title' => "test title",
                'url' => asset('test.docx'),
            ],
            'editorConfig' => [
                'callbackUrl' => route('documents.save'),
            ],
        ];

        $token = $this->generateToken($payload);

        $config = [
            'document' => [
                'fileType' => 'docx',
                'key' => uniqid(),
                'title' => "test title",
                'url' => asset('test.docx'),
                'token' => $token
            ],
            'editorConfig' => [
                'callbackUrl' => asset('callback.php?file_name=asset.docx'),
                'token' => $token
            ],
        ];
//        dd(123);
        return view('welcome', [
            'config' => $config
        ]);
    }

    private function generateToken($payload)
    {
        $key = config('services.onlyoffice.jwt_secret');
        return JWT::encode($payload, $key, 'HS256');
    }

    public function save(Request $request)
    {
//        dd($request);
        $token = $request->input('token');
        if (!$this->verifyToken($token)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Handle the document save callback from OnlyOffice
        $data = $request->all();
        $this->saveDocument($data);

        return response()->json(['success' => true]);
    }

    private function verifyToken($token)
    {
        $key = config('services.onlyoffice.jwt_secret');
        try {
            $decoded = JWT::decode($token, $key);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function getDocumentById($id)
    {
        // Implement your logic to fetch the document by ID
    }

    private function saveDocument($data)
    {
        // Implement your logic to save the document changes
    }
}
