<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class Upload {

    protected string $uploadDir;
    protected Logger $logger;

    public function __construct() {
        $config = require __DIR__ . '/../../config/app.php' ?? ['upload_dir' => __DIR__ . '/../../var/files/'];

        $this->uploadDir = $config['upload_dir'];
        $this->logger = new Logger();

        if (!is_dir($this->uploadDir)) mkdir($this->uploadDir, 0777, true);
    }

    public function upload(UploadedFile $file) : bool|string
    {

        $filename = $file->getClientOriginalName();
        $randomString = bin2hex(random_bytes(16));

        // Check if the extension is not PHP
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $extension = $file->guessExtension();

        // Check file size (10MB)
        $fileSize = $file->getSize();

        // Upload file

        try {
            $file->move($this->uploadDir, $randomString);
        } catch (FileException $fileException) {
            $this->logger->log("Unable to upload file $filename : " . $fileException->getMessage());
            return false;
        }

        return rtrim($this->uploadDir, '/') . '/' . $randomString;
    }

    public function download(string $path, string $filename): Response
    {
        $response = new Response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]
        );
        return $response->send();
    }

    public function delete(string $path): bool
    {
        return unlink($path);
    }

}