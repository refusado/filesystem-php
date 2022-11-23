<?php

namespace App;

class ListFiles
{    
    private $path;
    private $dir;
    private $files = [];

    // DEFINIR O DIRETÓRIO DOS ARQUIVOS A SEREM LISTADOS
    public function __construct($filePath = 'files/')
    {
        $this->path = $filePath;    
    }

    // ABRIR DIRETÓRIO DE ARQUIVOS PARA VARREDURA
    private function openDirectory($path)
    {
        $this->dir = dir($path);
    }

    // VARRE ARQUIVOS E ADICIONA NOME DE CADA UM À ARRAY
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

    public function getFileExtension($file)
    {
        $completePath   = $this->path . $file;
        $pathInfo       = pathinfo($completePath);

        return strtoupper($pathInfo['extension']);
    }

    // OBTER O CAMINHO DO ÍCONE DE CADA TIPO DE ARQUIVO
    public function getTypeIcon($file)
    {
        $imageExtensions    = ['PNG','JPG','JPEG','GIF','SVG','BMP','TIFF','WEBP'];
        $pdfExtensions      = ['PDF'];
        $exeExtensions      = ['EXE'];
        $txtExtensions      = ['TXT','DOC'];
        $videoExtensions    = ['WAV', 'MP4', 'WMBP'];

        $completePath   = $this->path . $file;
        $pathInfo       = pathinfo($completePath);

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