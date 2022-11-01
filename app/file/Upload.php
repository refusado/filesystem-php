<?php

namespace App\File;

class Upload
{
    private $name;
    private $extension;
    private $type;
    private $tmpName;
    private $error;
    private $size;

    private $duplicates = 0;

    public function __construct($file = '')
    {
        if (!empty($file['name'])) {
            $info = pathinfo($file['name']);

            $this->name = $info['filename'];
            $this->extension = $info['extension'];
        }

        $this->type     = $file['type'];
        $this->tmpName  = $file['tmp_name'];
        $this->error    = $file['error'];
        $this->size     = $file['size'];
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function generateRandomName()
    {
        $this->name = time() . '-' . uniqid();
    }

    public function getBasename()
    {
        $extension = strlen($this->extension) ? '.' . $this->extension : '';
        $duplicates = $this->duplicates > 0 ? '-' . $this->duplicates : '';

        return $this->name . $duplicates . $extension;
    }

    private function getPossibleBaseName($dir, $overwrite)
    {
        if ($overwrite) return $this->getBasename();

        $basename = $this->getBasename();

        if (!file_exists($dir . '/' . $basename)) return $basename;

        $this->duplicates++;
        return $this->getPossibleBaseName($dir, $overwrite);
    }

    public function upload($dir, $overwrite = true)
    {
        if ($this->error != 0) return false;

        $path = $dir . '/' . $this->getPossibleBasename($dir, $overwrite);
        return move_uploaded_file($this->tmpName, $path);
    }

    public static function createMultipleUploads($files)
    {
        $uploads = [];

        if (!empty($files['name'][0])) {  
            foreach($files['name'] as $key => $value) {
                $file = [
                    'name'      => $files['name'][$key],
                    'type'      => $files['type'][$key],
                    'tmp_name'  => $files['tmp_name'][$key],
                    'error'     => $files['error'][$key],
                    'size'      => $files['size'][$key]
                ];
                
                $uploads[] = new Upload($file);
            }   
        } else {
            return false;
        }

        return $uploads;
    }
}
