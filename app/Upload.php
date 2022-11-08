<?php

namespace App;

class Upload
{
    private $name;
    private $extension;
    private $type;
    private $tmpName;
    private $error;
    private $size;

    private $duplicates = 0;

    // SETANDO OS VALORES NA INICIALIZAÇÃO DA CLASSE
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

    // ESCOLHER UM NOME DIFERENTE PARA O ARQUIVO
    public function setName($name)
    {
        $this->name = $name;
    }

    // GERAR UM NOME ALEATÓRIO PARA O ARQUIVO
    public function generateRandomName()
    {
        $this->name = time() . '-' . uniqid();
    }

    // PEGAR O NOME FINAL DO ARQUIVO
    public function getBasename()
    {
        $extension = strlen($this->extension) ? '.' . $this->extension : '';
        $duplicates = $this->duplicates > 0 ? '-' . $this->duplicates : '';

        return $this->name . $duplicates . $extension;
    }

    //  PEGAR UM NOME POSSÍVEL PARA O ARQUIVO EM CASO DE NOME JÁ EXISTENTE
    private function getPossibleBasename($dir, $overwrite)
    {
        // SE FOR PARA SOBRESCREVER, NÃO É NECESSÁRIO ESCOLHER OUTRO NOME
        if ($overwrite) return $this->getBasename();

        $basename = $this->getBasename();
        if (!file_exists($dir . '/' . $basename)) return $basename;
        $this->duplicates++;

        return $this->getPossibleBasename($dir, $overwrite);
    }

    // FUNÇÃO PARA FAZER DE FATO O UPLOAD DO ARQUIVO
    public function upload($dir, $overwrite = true, $maxSize, $allowedExtensions)
    {
        if ($this->error != 0) return false;
        if ($this->size > $maxSize) return false;

        $hasMatch = false;
        foreach ($allowedExtensions as $ex) {
            if ($ex == $this->extension) {
                $hasMatch = true;
            }
        }

        if (!$hasMatch) return false;

        $path = $dir . '/' . $this->getPossibleBasename($dir, $overwrite);
        return move_uploaded_file($this->tmpName, $path);
    }

    // FUNÇÃO PARA FAZER O UPLOAD DE MAIS DE UM ARQUIVO AO MESMO TEMPO
    public static function createMultipleUploads($files)
    {
        $uploads = [];

        if (empty($files['name'][0])) return false;
        
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

        return $uploads;
    }
}
