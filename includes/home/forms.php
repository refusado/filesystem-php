<?php

use \App\Upload;
use App\Notification;
$multFiles = false;
$allowedExtensions = ['png', 'jpg', 'txt', 'mp4'];
$preserveName = false;
$maxFileSize = 500000;

echo "<div class='send-files'>";

if ($multFiles) {
    // SISTEMA PARA FORMULÁRIO DE VÁRIOS ARQUIVOS
    include __DIR__ . '/uploads.html';

    if (isset($_FILES['sent-files'])) {
        
        $uploads = Upload::createMultipleUploads($_FILES['sent-files']);

        if ($uploads) {
            foreach($uploads as $uploadObj) {
                $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);

                if (!$preserveName) $uploadObj->generateRandomName();

                if ($success) {
                    $noti = new Notification("Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!", "success");
                } else {
                    new Notification("Não foi possível enviar o arquivo", "failure");
                }
            }
        } else {
            new Notification("Não foi possível enviar o arquivo", "failure");
        }
    }
} else {
    // SISTMEA PARA FORMULÁRIO DE UM ARQUIVO
    include __DIR__ . '/upload.html';

    if (isset($_FILES['sent-file'])) {
        $uploadObj = new Upload($_FILES['sent-file']);
        
        if (!$preserveName) $uploadObj->generateRandomName();
        
        $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);
        // echo "<h1>" . $uploadObj->getExtension() . "</h1><hr>";
        if ($success) {
            $noti = new Notification("Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!", "success");
        } else {
            new Notification("Não foi possível enviar o arquivo", "failure");
        }
    }
}

echo "</div>";
echo "<script src='app/js/upload-input.js'></script>";