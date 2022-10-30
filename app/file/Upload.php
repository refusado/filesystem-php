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

    public function __construct($file = '')
    {
        $info = pathinfo($file['name']);
        
        $this->name     = $info['filename'];
        $this->extension= $info['extension'];
        $this->type     = $file['type'];
        $this->tmpName  = $file['tmp_name'];
        $this->error    = $file['error'];
        $this->size     = $file['size'];
        
        
        echo "<pre>PATH INFO";
        print_r($info);
        echo "</pre>";

        
        echo "<pre>FILE INFO";
        print_r($file);
        echo "</pre>";
    }

    public function getBaseName()
    {
        $extension = strlen($this->extension) ? '.' .$this->extension : '';

        return $this->name . $extension;
    }

    public function upload($dir)
    {
        if ($this->error != 0) return false;

        $path = $dir . '/' . $this->getBasename();
        
        // echo "<hr> PATH: " . $path . "<hr>";
        return move_uploaded_file($this->tmpName, $path);
    }
}