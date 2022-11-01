<?php

require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/includes/multi-form.php';

use \App\File\Upload;

if (isset($_FILES['sentFiles'])) {
    
    $uploads = Upload::createMultipleUploads($_FILES['sentFiles']);

    if ($uploads) {
        foreach($uploads as $uploadObj) {
            $uploadObj->generateRandomName();
            $success = $uploadObj->upload(__DIR__.'/files', false);

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