<?php

        // Solicita al usuario los datos de una nueva tarea y retorna un objeto Task
        function createTaskFromInput (){

            message("Crear tarea");

            do { // Title
                message("Ingrese el título de la tarea (Enter para salir al menú): ");
                $title = trim(fgets(STDIN));

                // Si presiona Enter sin ingresar nada, salir al menú
                if(empty($title)){
                    return null;
                }

                if (!validateInput($title))
                    message("El título no puede estar vacío. Por favor, ingrese un título válido.");
            
            } while (!validateInput($title));

            // Description
            message("Ingrese la descripción de la tarea: ");
            $description = trim(fgets(STDIN));

            if(validateEmpty($description))
                $description = "Unknown";

            do{
                message("Ingrese la fecha de vencimiento de la tarea: ");
                $date = trim(fgets(STDIN));

                if(empty($date)){
                    // Asignar la fecha actual si el usuario no ingresa una fecha
                    $date = date("Y-m-d");
                    break;
                }
                
                if (!validateDate($date))
                    message("La fecha no es válida. Por favor, ingrese una fecha en formato YYYY-MM-DD.");
                else if (!validateDateNotPast($date))
                    message("La fecha no puede ser anterior a la fecha actual. Ingrese una fecha de hoy o posterior.");
            
            }while(!validateDate($date) || !validateDateNotPast($date));
            
            // El estado se establece por defecto como pendiente (false)
            $status = false;

            return createTask($title, $description, $date, $status);
        }

        // Crea y retorna una nueva instancia de Task con los parámetros proporcionados
        function createTask($title, $description, $date, $status){
            return new Task(null, $title, $description, $status, $date);
        }
        
        // Controlador principal para crear una nueva tarea: solicita datos, genera ID y guarda en JSON
        function createTaskWrapper(){
            $path = getPathTask();
            $tasks = loadJson($path);
            
            $id = generateId($tasks);
            $task = createTaskFromInput();
            
            // Si el usuario canceló (presionó Enter sin ingresar título), salir
            if($task === null){
                return;
            }
            
            $task->setId($id);
            $tasks[] = $task;
            
            saveJson($path, $tasks);
            message("Tarea creada exitosamente.");
            printPressEnterToContinue();
        }
?>