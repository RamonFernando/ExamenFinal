<?php
    // Controlador principal para mostrar solo las tareas pendientes
    function showTasksWrapper(){
        $tasks = loadJson(getPathTask());
        $pendingTasks = getPendingTasks($tasks);
        if(!isValidateTask($pendingTasks)){
            message("No hay tareas pendientes");
            printPressEnterToContinue();
            return;
        }
        message("Lista de tareas pendientes:");
        showTasks($pendingTasks);
        printPressEnterToContinue();
    }

    // Recorre el array de tareas y muestra la información de cada una usando toString()
    function showTasks(array $tasks){
        foreach($tasks as $task)
            if($task instanceof Task)
                $task->toString();
    }
    
?>