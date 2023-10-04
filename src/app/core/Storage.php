<?php

class Storage {

    private $dir_path;

    public function __construct($type = 'video')
    {
        if ($type == 'video') {
            $this->dir_path = __DIR__.'/../../storage/videos/';
        } else if ($type == 'image') {
            $this->dir_path = __DIR__.'/../../storage/images/';
        } else {
            throw new DisplayedException(415);
        }
    }

    public function uploadVideo($temp_video)
    {
        $video_size = filesize($temp_video);

        if ($video_size > MAX_UPLOAD_SIZE) {
            throw new DisplayedException(413, "File size limit (40 MB) exceeded");
        }

        $mime = mime_content_type($temp_video);
        if(!isset(VIDEO_FORMAT[$mime])) {
            throw new DisplayedException(415, "Video should be in MP4 format");
        }

        $video_name = $this->generateFileName(VIDEO_FORMAT[$mime]);

        $success = move_uploaded_file($temp_video, $this->dir_path . $video_name);

        if (!$success) {
            throw new DisplayedException(500, "An error occurred while uploading the file");
        }

        return $video_name;
    }

    public function uploadImage($temp_image)
    {
        $image_size = filesize($temp_image);

        if ($image_size > MAX_UPLOAD_SIZE) {
            throw new DisplayedException(413, "File size limit (40 MB) exceeded");
        }

        $mime = mime_content_type($temp_image);
        if(!isset(IMAGE_FORMAT[$mime])) {
            throw new DisplayedException(415, "Image should be in JPG/JPEG/PNG format");
        }

        $image_name = $this->generateFileName(IMAGE_FORMAT[$mime]);

        $success = move_uploaded_file($temp_image, $this->dir_path . $image_name);
        if (!$success) {
            throw new DisplayedException(500, "An error occurred while uploading the file");
        }

        return $image_name;
    }

    public function deleteFile($filename)
    {
        if (!$this->isFileExist($filename)) {
            return;
        }

        $success = unlink($this->dir_path . $filename);

        if (!$success) {
            throw new DisplayedException(500, "An error occurred while deleting the file");
        }
    }

    public function getVideoDurationSeconds($video_name)
    {
        $dur = shell_exec("ffmpeg -i ".$this->dir_path . $video_name ." 2>&1");

        if(preg_match("/: Invalid /", $dur)){
            return false;
        }

        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if(!isset($duration[1])){
            return false;
        }

        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];
        return $seconds + ($minutes * 60) + ($hours * 60 * 60);
    }

    public function getVideoDurationString($video_name)
    {
        $dur = shell_exec("ffmpeg -i ".$this->dir_path . $video_name ." 2>&1");

        if(preg_match("/: Invalid /", $dur)){
            return false;
        }

        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if(!isset($duration[1])){
            return false;
        }

        if ($duration[1] == 0 || $duration[1] == "0" || $duration[1] == "00") {
            return $duration[2].":".$duration[3];
        }

        return $duration[1].":".$duration[2].":".$duration[3];
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
