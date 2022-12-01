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
}