<?php
require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/includes/header.html';

echo "<main>";

include __DIR__ . '/includes/home/forms.php';
include __DIR__ . '/includes/home/files.php';

include __DIR__ . '/includes/about/project-info.html';
include __DIR__ . '/includes/admin/upload-configs.html';

echo "</main>";

include __DIR__ . '/includes/footer.html';