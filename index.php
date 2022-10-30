<link rel="stylesheet" href="styles/styles.css">
<?php

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;

include __DIR__ . '/includes/form.php';

if (isset($_FILES['sentFile'])) {
    $uploadObj = new Upload($_FILES['sentFile']);

    // $uploadObj->setName('novo-arquivo');
    $uploadObj->generateRandomName();

    $success = $uploadObj->upload(__DIR__.'/files', false);

    // echo "<pre>";
    // print_r($uploadObj);
    // echo "</pre>";
    
    if ($success) {
        echo "Arquivo <b>" . $uploadObj->getBasename() . "</b> enviado com sucesso!";
    } else {
        echo "Não foi possível enviar o arquivo";
    }

}