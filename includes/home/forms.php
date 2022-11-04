<?php

use \App\Upload;

echo "<div class='sendfiles'>";

// SISTMEA PARA FORMULÁRIO DE UM ARQUIVO
include __DIR__ . '/form.html';

if (isset($_FILES['sentFile'])) {
    $uploadObj = new Upload($_FILES['sentFile']);

    $uploadObj->generateRandomName();

    $success = $uploadObj->upload(__DIR__.'/files', false);
    if ($success) {
        echo "Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!";
    } else {
        echo "Não foi possível enviar o arquivo";
    }
}

// SISTEMA PARA FORMULÁRIO DE VÁRIOS ARQUIVOS
include __DIR__ . '/multi-form.html';

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
echo "</div>";