<?php
        // Muestra el menú principal de la aplicación limpiando la pantalla primero
        function ShowMenuTask(){
            
        // Limpiar la consola (Windows: cls, Unix-like: clear)
        if (strncasecmp(PHP_OS_FAMILY, 'Windows', 7) === 0) {
            system('cls');
        } else {
            system('clear');
        }
            echo "\n=====================================\n";
            echo "Bienvenido a la lista de tareas: \n";
            echo "
            Menu de Tareas:
            1. Crear Tarea
            2. Mostrar Tareas
            3. Actualizar Tarea
            4. Eliminar Tarea
            5. Marcar Tarea Completada
            0. Salir\n";

            echo "\n=====================================\n";
            echo "\nPor favor, ingrese su elección: ";
        }

        // Muestra un mensaje en la consola agregando un salto de línea al final
        function message($msg){
            echo $msg . "\n";
        }

        // Muestra un mensaje y espera a que el usuario presione Enter para continuar
        function printPressEnterToContinue(){
            echo "Presione Enter para continuar...";
            fgets(STDIN);
        }
        // Muestra una lista resumida de tareas pendientes con ID y título para selección
        function showNameTask(array $tasks){
            $pendingTasks = getPendingTasks($tasks);
            if(!isValidateTask($pendingTasks)){
                message("No hay tareas pendientes");
                printPressEnterToContinue();
                return;
            }
            message("Lista de tareas pendientes:");
            foreach($pendingTasks as $task){
                if($task instanceof Task)
                    echo "ID: " . $task->getId() . " - Título: " . $task->getTitle() . "\n";
            }
            printPressEnterToContinue();
        }
?>