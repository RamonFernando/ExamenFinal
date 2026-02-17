<?php

    // Controlador principal para actualizar una tarea existente: permite modificar título, descripción y fecha
    function updateTaskWrapper(){
        message("Actualizar tarea");

        $path = getPathTask();
        $tasks = loadJson($path);

        $pendingTasks = getPendingTasks($tasks);
        if (!isValidateTask($pendingTasks)) {
            message("No hay tareas pendientes para actualizar.");
            printPressEnterToContinue();
            return;
        }

        // Usar do-while para pedir ID hasta que sea válido y exista (solo entre pendientes)
        do {
            showNameTask($tasks);
            message("Ingrese el ID de la tarea que desea actualizar (Enter para salir al menú): ");
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
            $taskExists = false;
            $taskToUpdate = null;

            // Buscar la tarea (solo entre pendientes)
            foreach ($pendingTasks as $task) {
                if ($task->getId() == $id) {
                    $taskExists = true;
                    $taskToUpdate = $task;
                    break;
                }
            }

            if (!$taskExists) {
                message("No se encontró una tarea con ese ID. Por favor, ingrese un ID válido.");
            }
        } while (!$taskExists);

        // Si llegamos aquí, tenemos una tarea válida
        $title = $taskToUpdate->getTitle();
        $description = $taskToUpdate->getDescription();
        $date = $taskToUpdate->getDate();

        message("Deje vacío para mantener el valor actual.");

        // Título: si ingresa algo, debe ser válido (do-while)
        do {
            message("Título actual: {$taskToUpdate->getTitle()}");
            message("Nuevo título (vacío para mantener): ");
            $newTitle = trim(fgets(STDIN));
            
            // Mantener el valor actual
            if (validateEmpty($newTitle)) break;
            
            if (!validateInput($newTitle))
                message("El título no puede estar vacío. Por favor, ingrese un título válido o deje vacío para mantener el actual.");
            
        } while (!validateEmpty($newTitle) && !validateInput($newTitle));
        
        if (!validateEmpty($newTitle))
            $taskToUpdate->setTitle($newTitle);
        
        // Descripción: opcional, si ingresa algo se acepta (sin validación estricta)
        message("Descripción actual: {$taskToUpdate->getDescription()}");
        message("Nueva descripción (vacío para mantener): ");
        $newDescription = trim(fgets(STDIN));
        if (!validateEmpty($newDescription))
            $taskToUpdate->setDescription($newDescription);
        
        // Fecha: si ingresa algo, debe ser válida
        do {
            message("Fecha actual: {$taskToUpdate->getDate()}");
            message("Nueva fecha (YYYY-MM-DD, vacío para mantener): ");
            $newDate = trim(fgets(STDIN));
            
            if (validateEmpty($newDate)) break;
            
            if (!validateDate($newDate))
                message("La fecha no es válida. Por favor, ingrese una fecha en formato YYYY-MM-DD o deje vacío para mantener la actual.");
            else if (!validateDateNotPast($newDate))
                message("La fecha no puede ser anterior a la fecha actual. Ingrese una fecha de hoy o posterior, o deje vacío para mantener la actual.");
            
        } while (!validateEmpty($newDate) && (!validateDate($newDate) || !validateDateNotPast($newDate)));
        
        if (!validateEmpty($newDate)) {
            $taskToUpdate->setDate($newDate);
        }

        // Solo guardar y mostrar éxito si hubo algún cambio real
        $taskchanges =
                $taskToUpdate->getTitle() !== $title ||
                $taskToUpdate->getDescription() !== $description ||
                $taskToUpdate->getDate() !== $date;

        if ($taskchanges) {
            saveJson($path, $tasks);
            message("Tarea actualizada exitosamente.");
        } else {
            message("No se realizaron cambios en la tarea.");
        }
        printPressEnterToContinue();
    }
?>