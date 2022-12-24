<?php

// SISTEMA PARA LISTAR ARQUIVOS NO DOM
use App\ListFiles;
use App\Notification;

if (@$_GET['delete']) {
    unlink('files/' . $_GET['delete']);
    header('Location:?deleted=' . $_GET['delete']);
}

if (@$_GET['deleted']) {
    new Notification('Arquivo "<b>' . $_GET['deleted'] . '</b>" removido com sucesso.', 'success');
}

if (@$_GET['file']) {
    $hasFile = file_exists('files/' . $_GET['file']);
    
    if (!$hasFile) {
        new Notification('Arquivo "<b>' . $_GET['file'] . '</b>" não encontrado no servidor.', 'error');
    } else {
        echo "<head><link rel='stylesheet' href='styles/details.css'></head>";

        $filePath = "files/" . $_GET['file'];
        $info = pathinfo($filePath);

        $name       = $info['filename'];
        $fullName   = $info['basename'];
        $extension  = $info['extension'];
        $type       = mime_content_type($filePath);
        $size       = filesize($filePath);
        $finalSize  = formatBytes($size, 0);

        echo "<div id='details'>";
        echo "  <a id='details__bg-back' href='./'></a>";
        echo "  <div id='details__container'>";
        echo "      <div id='details__data'>";
        echo "          <p id='details__name'><span class='details__mark'>Nome:</span> $name</p>";
        echo "          <p id='details__extension'><span class='details__mark'>Extensão:</span> $extension</p>";
        echo "          <p id='details__size' title='$size'><span class='details__mark'>Tamanho:</span> $finalSize</p>";
        echo "          <p id='details__type'><span class='details__mark'>Tipo:</span> $type</p>";
        echo "          <p id='details__fullname'><span class='details__mark'>Nome completo:</span> $fullName</p>";
        echo "      </div>";

        
        echo "      <div id='details__preview'>";

        // SE FOR UMA IMAGEM OU VÍDEO, EXIBIR DEMO
        if(strstr($type, 'image/')) {
            echo "      <img width='100%' src='$filePath' title='$name' alt='$fullName'/>";
        } else if(strstr($type, 'video/')) {
            echo "      <video controls width='100%' src='$filePath' title='$name' alt='$fullName'/>";
        } else if(strstr($type, 'text/')) {
            $fileContent    = file_get_contents($filePath, false, null, 0, 350);
            $detected       = mb_detect_encoding($fileContent, 'UTF-8, ISO-8859-1', true);
            $fileContent    = mb_convert_encoding($fileContent, 'UTF-8', $detected);
            
            echo "      <span id='preview__content'>$fileContent</span>";
        } else {
            echo "      <span id='preview__default'>Sem demo para este arquivo.</span>";
        }

        echo "      </div>";


        echo "      <div class='details__btns'>";
        echo "        <button class='details__delete-btn details-btn' id='openDelete'>Excluir arquivo</button>";
        echo "        <a class='details-btn details__back-btn' href='./'>Voltar</a>";
        echo "        <a class='details-btn details__download-btn' href='$filePath' download>Baixar</a>";
        echo "      </div>";

        echo "      <div class='details__delete-warning' id='deleteBox'>";
        echo "        <div class='details__delete-container'>";
        echo "            <p>Tem certeza que deseja excluir <b>$fullName</b>? Esta ação não poderá ser desfeita.</p>";
        echo "            <div class='details__btns'>";
        echo "                <a class='details-btn details__delete-confirm-btn' href='?delete=$fullName'>Sim, excluir arquivo</a>";
        echo "                <button class='details-btn details__delete-cancel-btn' id='closeDelete'>Cancelar</button>";
        echo "            </div>";
        echo "        </div>";
        echo "      </div>";

        echo "  </div>";
        echo "</div>";
        echo "<script src='./app/js/delete-file.js'></script>";
    }
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