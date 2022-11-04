<?php

// SISTEMA PARA LISTAR ARQUIVOS NO DOM
use \App\AllFiles;

$filesObj = new AllFiles();
$allFiles = $filesObj->getFilesName();

echo "<aside>";

if ($allFiles) {
    echo "<h4>Lista de Arquivos</h4>";
    
    echo "<ul class='fileViewer'>";

    foreach ($allFiles as $file) {
        $iconPath = $filesObj->getIcon($file);
        
        echo "<li class='fileViewer__item'>";
        echo    "<a href='files/$file'>";
        echo        "<img src='$iconPath'/>";
        echo        "<span>$file</span>";
        echo    "</a>";
        echo "</li>";
    }
    
    echo "</ul>";
} else {
    echo "Não foi possível exibir os arquivos";
}

echo "</aside>";