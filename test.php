<?php
$keyword = "token"; // Reemplaza con la palabra clave que deseas buscar
$directory = new RecursiveDirectoryIterator('.');
$iterator = new RecursiveIteratorIterator($directory);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() == 'html') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, $keyword) !== false) {
            echo "Encontrado en el archivo: " . $file->getPathname() . "<br>";
        }
    }
}
?>
