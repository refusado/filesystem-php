<?php

namespace App;

class AllFiles
{    
    private $path;
    private $dir;

    public function __construct($filePath = 'files/')
    {
        $this->path = $filePath;    
    }

    public function getFilesName()
    {
        @$this->openDirectory($this->path);
        if (!$this->dir) return false;

        $imageExtensions = [
            'png', 'PNG', 'Png',
            'jpg', 'JPG', 'Jpg',
            'jpeg', 'JPEG', 'Jpeg',
            'gif', 'GIF', 'Gif',
            'svg', 'SVG', 'Svg',
            'bmp', 'BMP', 'Bmp',
            'tiff', 'TIFF', 'Tiff',
            'webp', 'WEBP', 'Webp'
        ];

        while($file = $this->dir->read()) {
            $completePath   = $this->path . $file;
            $pathInfo       = pathinfo($completePath);
            $fileBasebame   = $pathInfo['basename'];
            $fileName       = $pathInfo['filename'];
            $fileExtension  = $pathInfo['extension'];

            // echo "<pre>";
            // print_r($pathInfo);
            // echo "</pre>";

            // echo $fileExtension;
            
            if ($fileExtension == "png" || $fileExtension == "jpg" || $fileExtension == "jpeg") {
                echo "
                    <img width='200px' src='" . $this->path . $file . "'/>
                ";
            }

            // echo "<a href='".$this->path . $file . "'>" . $file . "</a><br />";
        }

        $this->dir->close();
        
        return true;
    }

    private function openDirectory($path)
    {
        $this->dir = dir($path);
    }
}