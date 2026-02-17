<?php
    // Genera un ID único para una nueva tarea basado en el ID máximo existente + 1
    function generateId(array $tasks){
        if(empty($tasks)){
            return 1;
        } else {
            $maxId = max(array_map(fn($t) => $t->getId(), $tasks));
            return $maxId + 1;
        }
    }
    
    // Valida si hay tareas disponibles (retorna false si está vacío, true si tiene elementos)
    function isValidateTask($task){
        if(empty($task)){
            return false;
        }
        return true;
    }

    // Retorna solo las tareas pendientes (status === false)
    function getPendingTasks(array $tasks): array {
        return array_values(array_filter($tasks, fn($t) => $t instanceof Task && $t->getStatus() === false));
    }
    // Convierte el estado de string ('s' o 'n') a booleano (true si es 's', false si es 'n')
    function tryParseStatus($status){
        return $status === 's';
    }
        
    // Valida que el estado ingresado sea 's' (completada) o 'n' (pendiente)
    function validateStatusInput($status){
        return $status === 's' || $status === 'n';
    }
    

    // Valida que el título no esté vacío después de eliminar espacios en blanco
    function validateInput($title){
        return !empty(trim($title));
    }
    // Valida que la fecha tenga el formato YYYY-MM-DD y sea una fecha válida
    function validateDate($date){
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    // Valida que la fecha no sea anterior a la fecha actual (hoy)
    function validateDateNotPast($date){
        if(!validateDate($date)){
            return false;
        }

        $today = new DateTime('today');
        $inputDate = new DateTime($date);

        return $inputDate >= $today;
    }
    // Verifica si un campo de entrada está vacío después de eliminar espacios en blanco
    function validateEmpty($input){
        return empty(trim($input)) ? true : false;
    }

    // Retorna la ruta completa del archivo JSON donde se almacenan las tareas
    function getPathTask(){
        return __DIR__ . "/../Data/task.json";
    }
