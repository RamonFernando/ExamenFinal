<?php

// Guarda un array de tareas en un archivo JSON en la ruta especificada
function saveJson(string $path, array $tasks): void
{
    $data = [];

    foreach ($tasks as $task) {
        $data[] = [
            'id' => $task->getId(),
            'titulo' => $task->getTitle(),
            'descripcion' => $task->getDescription(),
            'fecha' => $task->getDate(),
            'completada' => $task->getStatus()
        ];
    }

    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if ($json === false) {
        echo "Error al convertir los datos a JSON.\n";
        return;
    }

    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    if (file_put_contents($path, $json) === false) {
        echo "Error al guardar el archivo JSON.\n";
        return;
    }
}
?>