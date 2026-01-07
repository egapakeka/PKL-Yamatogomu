<?php
$files = [];
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/..'));
foreach ($rii as $file) {
    if ($file->isDir()) continue;
    if (pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'php') {
        $files[] = $file->getPathname();
    }
}
$errors = [];
foreach ($files as $f) {
    $output = null;
    $ret = null;
    exec("php -l " . escapeshellarg($f) . " 2>&1", $output, $ret);
    if ($ret !== 0) {
        $errors[$f] = implode("\n", $output);
    }
}
if (empty($errors)) {
    echo "No syntax errors found.\n";
    exit(0);
}
foreach ($errors as $file => $msg) {
    echo "ERROR in $file:\n$msg\n\n";
}
exit(1);
