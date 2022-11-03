<?php

include __DIR__ . '/includes/home/header.html';
require __DIR__ . '/vendor/autoload.php';
use \App\Upload;
use \App\AllFiles;

// SISTMEA PARA FORMULÁRIO DE UM ARQUIVO
include __DIR__ . '/includes/form.html';

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
include __DIR__ . '/includes/multi-form.html';

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

// SISTEMA PARA MOSTRAR OS ARQUIVOS
$filesObj = new AllFiles();

echo "<h4>Lista de Arquivos</h4>";
if (!$filesObj->getFilesName()) {
    echo "Não foi possível exibir os arquivos";
}


include __DIR__ . '/includes/home/footer.html';