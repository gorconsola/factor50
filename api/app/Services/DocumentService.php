<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DocumentService
{
	protected $memoryLimit = '256M';
	protected $uploadMaxFilesize = '25M';
	protected $postMaxSize = '25M';
	protected $timeLimit = 120;

	protected $diskName;
    public $storageDisk;

	public function __construct($diskName) {
		$this->disk = $diskName;
        $this->storageDisk = Storage::disk($this->disk);
	}

	public function uploadAndGetFileUrl ($path, $data) {
		ini_set('memory_limit', $this->memoryLimit);
        ini_set('upload_max_filesize', $this->uploadMaxFilesize);
        ini_set('post_max_size', $this->postMaxSize);
        set_time_limit($this->timeLimit);

        if ($this->fileExists($path)) {
            throw new \Exception("File already exists");
        };

        return $this->storeFile($path, $data);
	}

	public function fileExists ($path) {
        return $this->storageDisk->exists($path);
	}

	public function storeFile ($path, $data) {
        $data = explode(";base64,", $data)[1];
        $file = $this->storageDisk->put($path, base64_decode($data));

        return $this->storageDisk->url($path);
	}

	public function deleteFile ($path) {
		return $this->storageDisk->delete($path);
	}

	public function getDownloadLink ($folder, $filename) {
		$baseUrl = config('app.url');
		$apiUri = '/api';

		return $baseUrl . $apiUri . '/documents/download/' . $folder . '/' . $filename;
	}
}