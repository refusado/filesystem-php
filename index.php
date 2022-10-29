<link rel="stylesheet" href="styles/styles.css">
<?php

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;

if (isset($_FILES['fileTest'])) {

    $fileObject = new Upload($_FILES['fileTest']);
    echo "<pre>";
    print_r($fileObject);
    echo "</pre>";

    exit;
}

include __DIR__ . '/includes/form.php';
