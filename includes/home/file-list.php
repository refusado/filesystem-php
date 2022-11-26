<?php

// SISTEMA PARA LISTAR ARQUIVOS NO DOM
use App\ListFiles;
use App\Notification;

$filesObj = new ListFiles();
$allFiles = $filesObj->getFilesName();

if (@$_GET['delete']) {
    unlink('files/' . $_GET['delete']);
    header('Location:?deleted=' . $_GET['delete']);
}

if (@$_GET['deleted']) {
    new Notification('Arquivo <b>' . $_GET['deleted'] . '</b> removido com sucesso.');
}

echo "<section id='files'>";
echo "  <ul class='files__container'>";

foreach ($allFiles as $file) {
    $extension = $filesObj->getFileExtension($file);
    
    echo "<li class='files__item' title=$file>";
    echo "  <a class='files__box'>";
    echo "      <div class='files__extension'>$extension</div>";
    echo "  </a>";
    echo "  <p class='files__name'>$file</p>";
    echo "</li>";
}

echo "  </ul>";
echo "</section>";