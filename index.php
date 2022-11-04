<?php
require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/includes/header.html';

echo "<section class='files'>";

include __DIR__ . '/includes/home/forms.php';
include __DIR__ . '/includes/home/file-list.php';

echo "</section>";

include __DIR__ . '/includes/footer.html';