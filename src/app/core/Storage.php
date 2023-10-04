<?php

class Storage {

    private $dir_path;

    public function __construct($type = 'video')
    {
        if ($type == 'recipe') {
            $this->dir_path = __DIR__.'/../../storage/video/';
        } else if ($type == 'image') {
            $this->dir_path = __DIR__.'/../../storage/image/';
        } else {
            // TODO: throw exception 400
        }
    }

    public function uploadVideo($prev_name)
    {
        $file_size = filesize($prev_name);
    }

    public function uploadImage()
    {

    }

    public function deleteFile($filename)
    {
        if (!$this->isFileExist($filename)) {
            return;
        }

        $success = unlink($this->dir_path . $filename);

        if (!$success) {
            // TODO: error handling
        }
    }

    public function getVideoDuration()
    {

    }

    private function generateUUID()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    }

    private function generateFileName($ext)
    {
        $curr_file_name = $this->generateUUID() . $ext;

        while ($this->isFileExist($curr_file_name))
        {
            $curr_file_name = $this->generateUUID() . $ext;
        }

        return $curr_file_name;
    }

    private function isFileExist($file_name)
    {
        return file_exists($this->dir_path . $file_name);
    }
}
