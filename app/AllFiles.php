<?php

namespace App;

class AllFiles
{    
    private $path;
    private $dir;
    private $files = [];

    public function __construct($filePath = 'files/')
    {
        $this->path = $filePath;    
    }

    private function openDirectory($path)
    {
        $this->dir = dir($path);
    }

    public function getFilesName()
    {
        @$this->openDirectory($this->path);
        
        if (!$this->dir) return false;

        while($file = $this->dir->read()) {
            $completePath   = $this->path . $file;
            $pathInfo       = pathinfo($completePath);

            if (!empty($pathInfo['extension'])) {
                array_push($this->files, $pathInfo['basename']);
            }
        }

        $this->dir->close();
        
        return $this->files;
    }

    public function getIcon($file)
    {
        $imageExtensions    = ['PNG','JPG','JPEG','GIF','SVG','BMP','TIFF','WEBP'];
        $pdfExtensions      = ['PDF'];
        $exeExtensions      = ['EXE'];
        $txtExtensions      = ['TXT','DOC'];
        $videoExtensions    = ['WAV', 'MP4', 'WMBP'];

        $completePath   = $this->path . $file;
        $pathInfo       = pathinfo($completePath);

        // print_r($pathInfo);

        $fileExtension  = strtoupper($pathInfo['extension']);

        foreach ($pdfExtensions as $pdfExtension) {
            if ($fileExtension == $pdfExtension) return 'assets/icons/pdf-icon.png';
        }

        foreach ($imageExtensions as $imgExtension) {
            if ($fileExtension == $imgExtension) return $completePath;
        }

        foreach ($txtExtensions as $txtExtension) {
            if ($fileExtension == $txtExtension) return 'assets/icons/text-icon.png';
        }

        foreach ($exeExtensions as $exeExtension) {
            if ($fileExtension == $exeExtension) return 'assets/icons/exe-icon.png';
        }

        foreach ($videoExtensions as $videoExtension) {
            if ($fileExtension == $videoExtension) return 'assets/icons/video-icon.png';
        }
    }
}