<?php
require __DIR__ . '/vendor/autoload.php';

include __DIR__ . './home/header.html';

echo "<main>";

include __DIR__ . './home/forms.php';
include __DIR__ . './home/files.php';

include __DIR__ . './home/project-info.html';
include __DIR__ . './home/upload-configs.html';

echo "</main>";

include __DIR__ . './home/footer.html';