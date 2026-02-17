<?php

    class App {

        // Método principal que ejecuta el bucle del menú y maneja las opciones del usuario
        public function runApp(){

            while(true){
                ShowMenuTask();
                
                $option = trim(fgets(STDIN));
                switch($option){
                    case 1:
                        createTaskWrapper();
                        break;
                    case 2:
                        showTasksWrapper();
                        break;
                    case 3:
                        updateTaskWrapper();
                        break;
                    case 4:
                        deleteTaskWrapper();
                        break;
                    case 5:
                        checkTaskWrapper();
                        break;
                    case 0:
                        message("Gracias por usar la aplicación. ¡Hasta luego!");
                        message("Cerrando la aplicación...");
                        exit(0);
                    default:
                        message("Opción no válida. Por favor, ingrese un número del 0 al 5: ");
                        printPressEnterToContinue();
                        break;
                }
            }
        }
    }


?>