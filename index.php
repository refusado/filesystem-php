<?php

include __DIR__ . '/includes/home/header.html';
require __DIR__ . '/vendor/autoload.php';
use \App\Upload;
use \App\AllFiles;

echo "<section class='files'>";

// SISTMEA PARA FORMULÁRIO DE UM ARQUIVO
echo "<div class='sendfiles'>";
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
echo "</div>";

// SISTEMA PARA MOSTRAR OS ARQUIVOS
echo "<aside>";
$filesObj = new AllFiles();

$allFiles = $filesObj->getFilesName();

if (!$allFiles) {
    echo "Não foi possível exibir os arquivos";
} else {
    echo "<h4>Lista de Arquivos</h4>";
    
    echo "<ul class='fileViewer'>";
    foreach ($allFiles as $file) {
        $iconPath = $filesObj->getIcon($file);
        // echo "O arquivo $file tem a extensão $iconName <br>";
        echo "<li class='fileViewer__file'>";
        echo "<img src='$iconPath'/>";
        echo "<span>$file</span>";
        echo "</li>";
    }
    
    echo "</ul>";
}

echo "</aside>";
echo "</section>";

include __DIR__ . '/includes/home/footer.html';