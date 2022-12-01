<?php

// SISTEMA PARA LISTAR ARQUIVOS NO DOM
use App\ListFiles;
use App\Notification;

if (@$_GET['delete']) {
    unlink('files/' . $_GET['delete']);
    header('Location:?deleted=' . $_GET['delete']);
}

if (@$_GET['deleted']) {
    new Notification('Arquivo <b>' . $_GET['deleted'] . '</b> removido com sucesso.', 'success');
}

if (@$_GET['file']) {
    echo "<head><link rel='stylesheet' href='styles/details.css'></head>";

    $info = pathinfo($_GET['file']);

    $name       = $info['filename'];
    $fullName   = $info['basename'];
    $extension  = $info['extension'];
    $type       = mime_content_type("files/" . $_GET['file']);
    $size       = filesize("files/" . $_GET['file']);
    $finalSize  = formatBytes($size, 0);

    echo "<div id='details'>";
    echo "  <div>";
    echo "      <div>";
    echo "          <p>Nome: $name</p>";
    echo "          <p>Nome completo: $fullName</p>";
    echo "          <p title='$size'>Tamanho: $finalSize</p>";
    echo "          <p>Tipo: $type</p>";
    echo "          <p>Extensão: $extension</p>";
    echo "      </div>";
    echo "      <button id='delete-btn'>Excluir arquivo</button>";
    echo "      <div id='delete-file-box'>";
    echo "          <p>Cuidado! Isto irá remover o arquivo permanentemente do servidor, você tem certeza que desja excluir <b>$fullName</b>?</p>";
    echo "          <a href='?delete=$fullName'>Sim, excluir arquivo</a>";
    echo "          <button id='nodelete-btn'>Não</button>";
    echo "      </div>";
    echo "  </div>";
    echo "</div>";
}

$filesObj = new ListFiles();
$allFiles = $filesObj->getFilesName();

echo "<section id='files'>";
echo "  <ul class='files__container'>";

foreach ($allFiles as $file) {
    $extension = $filesObj->getFileExtension($file);
    
    echo "<li title=$file>";
    echo "  <a class='files__item' href='?file=$file'>";
    echo "    <div class='files__box'>";
    echo "        <div class='files__extension'>$extension</div>";
    echo "    </div>";
    echo "    <p class='files__name'>$file</p>";
    echo "  </a>";
    echo "</li>";
}

echo "  </ul>";
echo "</section>";

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 