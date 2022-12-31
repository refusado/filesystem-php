<?php
require './vendor/autoload.php';
use App\Notification;

$styleUrls = [
    "src/shared/css/reset.css",
    "src/styles.css",
    "src/page/header/header.css",
    "src/page/files-view/file-list.css",
    "src/page/files-view/file-details.css",
    "src/page/config-view/settings.css",
    "src/page/info-view/info.css",
    "src/page/upload-form/upload-form.css",
    "src/shared/css/notify.css",
];

$scriptUrls = [
    "src/shared/js/popups.js",
    "src/shared/js/upload-config.js",
];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filesystem</title>
    <?php
foreach ($styleUrls as $url) { echo "<link rel='stylesheet' href='$url'>";}  
foreach ($scriptUrls as $url) { echo "<script src='$url' defer></script>";}
    ?>
</head>

<?php

if (@$_GET['delete']) {
    unlink('files/' . $_GET['delete']);
    header('Location:?deleted=' . $_GET['delete']);
}

if (@$_GET['deleted']) {
    new Notification('Arquivo "<b>' . $_GET['deleted'] . '</b>" removido com sucesso.', 'success');
}

include __DIR__ . './page/header/header.html';

echo "      <main>";
include __DIR__ . './page/upload-form/forms.php';
include __DIR__ . './page/files-view/files.php';

include __DIR__ . './page/info-view/info.html';
include __DIR__ . './page/config-view/settings.html';
echo "      </main>";
echo "  </body>";
echo "</html>";