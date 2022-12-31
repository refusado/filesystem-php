<?php

use \App\Upload;
use App\Notification;

$multFiles = true;
$allowedExtensions = ['png', 'jpg', 'txt', 'mp4'];
$preserveName = true;
$maxFileSize = 50000000;

echo "  <div class='send-files'>";
echo "      <div id='upload-container'>";
echo "      <form id='upload-form' action='index.php' method='post' enctype='multipart/form-data'>";
echo "          <label id='file-list-box' class='upload__box'>";
echo "              <input type='file' name='sent-files[]' id='upload__input' multiple hidden>";
echo "              <img fill='red' src='src/assets/icons/upload.svg' alt='Upload'>";
echo "          </label>";
echo "          <div id='upload__btns-container'>";
echo "              <button class='upload__btn' id='upload__cancel-btn' type='button'>Cancelar</button>";
echo "              <button class='upload__btn' id='upload__sent-btn' type='submit'>Enviar</button>";
echo "          </div>";
echo "      </form>";
echo "      </div>";
echo "  </div>";

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