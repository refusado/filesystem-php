<?php

// SISTEMA PARA LISTAR ARQUIVOS NO DOM
use App\ListFiles;

$filesObj = new ListFiles();
$allFiles = $filesObj->getFilesName();

if (@$_GET['delete']) {
    unlink('files/' . $_GET['delete']);
    header('Location:?deleted=' . $_GET['delete']);
}

if (@$_GET['deleted']) {
    echo 'Arquivo <b>' . $_GET['deleted'] . '</b> removido com sucesso.';
}

echo "<aside>";

if ($allFiles) {
    echo "<h4>Lista de Arquivos</h4>";
    
    echo "<ul class='fileViewer'>";

    foreach ($allFiles as $file) {
        $iconPath = $filesObj->getTypeIcon($file);
        
        echo "<li class='fileViewer__item'>";
        echo    "<a id='fileAnchor' href='files/$file'>";
        echo        "<img src='$iconPath'/>";
        echo        "<span id='fileName'>$file</span>";
        echo        "<a id='xis' href='?delete=$file'>✖</a>";
        echo    "</a>";
        echo "</li>";
    }
    
    echo "</ul>";
} else {
    echo "Não foi possível exibir os arquivos";
}

echo "</aside>";