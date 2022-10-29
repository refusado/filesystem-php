<?php

namespace App\File;

class Upload
{
    private $name;
    private $extesion;
    private $type;
    private $tmpName;
    private $error;
    private $size;

    public function __construct($file)
    {
        $this->type     = $file['type'];
        $this->tmpName  = $file['tmp_name'];
        $this->error    = $file['error'];
        $this->size     = $file['size'];
    }
}
