<?php

    // Controlador principal para eliminar una tarea: solicita ID, valida existencia y elimina del JSON
    function deleteTaskWrapper (){
        message("Eliminar tarea");
        $path = getPathTask();
        $tasks = loadJson($path);
        $pendingTasks = getPendingTasks($tasks);

        if (!isValidateTask($pendingTasks)) {
            message("No hay tareas pendientes para eliminar.");
            printPressEnterToContinue();
            return;
        }

        do{
            showNameTask($tasks);
            message("Ingrese el ID de la tarea que desea eliminar (Enter para salir al menú): ");
            $input = trim(fgets(STDIN));

            // Si presiona Enter sin ingresar nada, salir al menú
            if(empty($input)){
                return;
            }

            if(!is_numeric($input)){
                message("El ID debe ser un número. Por favor, ingrese un ID válido.");
                continue;
            }

                $id = (int)$input;
            $taskExists = false;

            // Verificar si la tarea con el ID proporcionado existe (solo entre pendientes)
            foreach($pendingTasks as $task){
                if($task->getId() == $id){
                    $taskExists = true;
                    break;
                }
            }
        if(!$taskExists){
            message("No se encontró una tarea con el ID proporcionado. Por favor, ingrese un ID válido.");
        }

        if($taskExists){
            $tasks = deleteTaskById($tasks, $id);
            // Reindexar el array para evitar índices huecos en el JSON
            $tasks = array_values($tasks);
            saveJson($path, $tasks);
            message("Tarea eliminada exitosamente.");
            printPressEnterToContinue();
        }
        }while(!$taskExists);
    }

    // Elimina una tarea del array por su ID y retorna el array modificado
    function deleteTaskById(array $tasks, int $id): array {
        for ($i = 0; $i < count($tasks) ; $i++) {
            if($tasks[$i]->getId() == $id){
                unset($tasks[$i]);
                break;
            }
        }
        return $tasks;
    }
    // Función alternativa para eliminar tarea usando array_filter (no utilizada actualmente)
    function deleteTaskById1($tasks, $id){
        return array_filter($tasks, fn($task) => $task->getId() != $id);
    }
    
?>