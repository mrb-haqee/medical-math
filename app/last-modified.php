<?php
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('.'),
    RecursiveIteratorIterator::SELF_FIRST
);

$lastModified = 0;

foreach ($files as $file) {
    if ($file->isFile()) {
        $lastModified = max($lastModified, $file->getMTime());
    }
}

echo json_encode(['lastModified' => $lastModified]);
