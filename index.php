<link rel="stylesheet" href="styles/styles.css">
<?php

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;

include __DIR__ . '/includes/form.php';

if (isset($_FILES['sentFile'])) {
    $fileObject = new Upload($_FILES['sentFile']);
    $success = $fileObject->upload(__DIR__.'/files');

    echo "<pre>";
    print_r($fileObject);
    echo "</pre>";
    
    if ($success) {
        echo "Arquivo enviado com sucesso!";
    } else {
        echo "Não foi possível enviar o arquivo";
    }

}