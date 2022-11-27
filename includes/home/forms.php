<?php

use \App\Upload;
use App\Notification;
$multFiles = true;
$allowedExtensions = ['png', 'jpg', 'txt', 'mp4'];
$preserveName = true;
$maxFileSize = 500000;

echo "<div class='send-files'>";

if ($multFiles) {
    // SISTEMA PARA FORMULÁRIO DE VÁRIOS ARQUIVOS
    include __DIR__ . '/uploads.html';

    if (isset($_FILES['sent-files'])) {
        
        $uploads = Upload::createMultipleUploads($_FILES['sent-files']);

        if ($uploads) {
            $successFiles   = "";
            $errorFiles     = "";
            $successNo      = 0;
            $errorsNo       = 0;
            $notifySuccess  = null;
            $successType    = null;
            $notifyError    = null;
            $errorType      = null;

            foreach($uploads as $uploadObj) {
                if (!$preserveName) $uploadObj->generateRandomName();
                
                $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);

                if ($success) {
                    $successFiles .= "| <b>" . $uploadObj->getBasename() . "</b> ";
                    $successNo++;
                } else {
                    $errorFiles .= "| <b>" . $uploadObj->getBasename() . "</b> ";
                    $errorsNo++;
                }
            }
            if ($successNo) {
                $notifySuccess  = "Arquivo enviado ($successNo): $successFiles";
                $successType = "success";
            }
            if ($errorsNo) {
                $notifyError = "Não enviado ($errorsNo): $errorFiles";
                $errorType = "error";
            }
            new Notification($notifySuccess, $successType, $notifyError, $errorType);
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
            new Notification("Não foi possível enviar o arquivo", "error");
        }
    }
}

echo "</div>";
echo "<script src='app/js/upload.js'></script>";