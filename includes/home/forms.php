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
            foreach($uploads as $uploadObj) {
                if (!$preserveName) $uploadObj->generateRandomName();
                
                $success = $uploadObj->upload('files', false, $maxFileSize, $allowedExtensions);

                if ($success) {
                    $successFiles .= "· <b>" . $uploadObj->getBasename() . "</b> ";
                    $successNo++;
                } else {
                    $errorFiles .= "· <b>" . $uploadObj->getBasename() . "</b> ";
                    $errorsNo++;
                }
            }
            $notifySuccess = null;
            $successType = null;
            if ($successNo) {
                $notifySuccess  = "Arquivos enviados ($successNo): $successFiles";
                $successType = "success";
            }
            $notifyError = null;
            $errorType = null;
            if ($errorsNo) {
                $notifyError = "Arquivos não enviados ($errorsNo): $errorFiles";
                $errorType = "error";
            }
            new Notification($notifySuccess, $successType, $notifyError, $errorType);
        } else {
            // new Notification("Não foi possível enviar o arquivo", "error");
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