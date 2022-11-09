<?php

use \App\Upload;
$multFiles = true;
$allowedExtensions = ['png', 'jpg', 'txt'];
$preserveName = false;
$maxFileSize = 500000;

echo "<div class='send-files'>";

if ($multFiles) {
    // SISTEMA PARA FORMULÁRIO DE VÁRIOS ARQUIVOS
    include __DIR__ . '/multi-form.html';

    if (isset($_FILES['sentFiles'])) {
        
        $uploads = Upload::createMultipleUploads($_FILES['sentFiles']);

        if ($uploads) {
            foreach($uploads as $uploadObj) {
                $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);

                if (!$preserveName) $uploadObj->generateRandomName();

                if ($success) {
                    echo "Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso! <br>";
                } else {
                    echo "Não foi possível enviar o arquivo <br>";
                }
            }
        } else {
            echo "Não foi possível enviar o arquivo <br>";
        }
    }
} else {
    // SISTMEA PARA FORMULÁRIO DE UM ARQUIVO
    include __DIR__ . '/form.html';

    if (isset($_FILES['sentFile'])) {
        $uploadObj = new Upload($_FILES['sentFile']);
        
        if (!$preserveName) $uploadObj->generateRandomName();
        
        $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);
        echo "<h1>" . $uploadObj->getExtension() . "</h1><hr>";
        if ($success) {
            echo "Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!";
        } else {
            echo "Não foi possível enviar o arquivo";
        }
    }
}

echo "</div>";
echo "<script src='app/js/upload-input.js'></script>";