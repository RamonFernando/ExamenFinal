<?php

        // Controlador principal para marcar una tarea como completada: solicita ID y cambia estado a true
        function checkTaskWrapper(){
            message("Marcar tarea como completada");

            $path = getPathTask();
            $tasks = loadJson($path);

            $pendingTasks = getPendingTasks($tasks);
            if (!isValidateTask($pendingTasks)) {
                message("No hay tareas pendientes para marcar como completadas.");
                printPressEnterToContinue();
                return;
            }

            // Usar do-while para validar el ID hasta que sea válido y exista (solo entre pendientes)
            $searchTask = false;
            $taskToUpdate = null;

            do {
                showNameTask($tasks);
                message("Ingrese el ID de la tarea que desea marcar como completada (Enter para salir al menú): ");
                $input = trim(fgets(STDIN));

                // Si presiona Enter sin ingresar nada, salir al menú
                if(empty($input)){
                    return;
                }

                if (!is_numeric($input)) {
                    message("El ID debe ser un número. Por favor, ingrese un ID válido.");
                    continue;
                }

                $id = (int)$input;
                $searchTask = false;

                // Buscar la tarea (solo entre pendientes)
                foreach ($pendingTasks as $task) {
                    if ($task->getId() == $id) {
                        $searchTask = true;
                        $taskToUpdate = $task;
                        break;
                    }
                }

                if (!$searchTask) {
                    message("No se encontró una tarea con ese ID. Por favor, ingrese un ID válido.");
                }
            } while (!$searchTask);

            // Mostrar la información completa de la tarea seleccionada
            message("\n=== Información de la tarea seleccionada ===");
            $taskToUpdate->toString();
            
            // Marcar la tarea como completada (si llegamos aquí, ya sabemos que es pendiente)
            $taskToUpdate->setStatus(true);
            saveJson($path, $tasks);
            message("Tarea marcada como completada exitosamente.");
            printPressEnterToContinue();
        }
?>