<link rel="stylesheet" href="styles/styles.css">
<?php

require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/includes/form.php';

use \App\File\Upload;

if (isset($_FILES['sentFile'])) {
    $uploadObj = new Upload($_FILES['sentFile']);

    // $uploadObj->setName('novo-arquivo');
    $uploadObj->generateRandomName();

    $success = $uploadObj->upload(__DIR__.'/files', false);
    if ($success) {
        echo "Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!";
    } else {
        echo "Não foi possível enviar o arquivo";
    }

}