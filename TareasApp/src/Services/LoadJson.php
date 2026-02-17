<?php

// Carga las tareas desde un archivo JSON y retorna un array de objetos Task
function loadJson(string $path): array {

    if (!file_exists($path)) {
        return [];
    }

    $container = file_get_contents($path);
    if(!$container){
        message("Error al leer el archivo JSON.
        Asegúrese de que el archivo exista y tenga permisos de lectura.");
        return [];
    }
    $data = json_decode($container, true);

    if (!is_array($data)) {
        return [];
    }

    $tasks = [];

    foreach ($data as $item) {

        // Si el item no es un array, lo ignoramos
        if (!is_array($item)) {
            continue;
        }

        // Valores seguros (evita warnings)
        $id = $item['id'] ?? 0;
        $title = $item['titulo'] ?? '';
        $description = $item['descripcion'] ?? '';
        $status = $item['completada'] ?? false;
        $date = $item['fecha'] ?? date('Y-m-d');
        

        // No cargamos tareas sin título
        if (empty($title)) {
            continue;
        }

        $tasks[] = new Task(
            $id,
            $title,
            $description,
            (bool)$status,
            $date
            
        );
    }

    return $tasks;
}
?>