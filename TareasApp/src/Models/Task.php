<?php
        class Task{
                
                public $id;
                public $title;
                public $description;
                public $status;
                public $date;
                
                // Constructor de la clase Task que inicializa todas las propiedades
                public function __construct($id, $title, $description, $status, $date){
                        $this->id = $id;
                        $this->title = $title;
                        $this->description = $description;
                        $this->status = $status;
                        $this->date = $date;
                
                }

                // Muestra la información completa de la tarea formateada en la consola
                function toString(){
                        echo "ID: " . ($this->id ?? 'Unknown') . "\n";
                        echo "Title: " . (!empty($this->title) ? $this->title : 'Unknown') . " " . "\n";
                        echo "Description: " . (!empty($this->description) ? $this->description : 'Unknown') . "\n";
                        echo "Status: " . ($this->status === true ? "Completada":
                                        ($this->status === false ? "Pendiente": 'Unknown')) . "\n";
                        echo "Date: " . (!empty($this->date) ? $this->date : 'Unknown') . "\n";
                        echo "-------------------\n";
                }
                
                // Getters y Setters
                public function getId(){
                        return $this->id;
                }

                public function setId($id){
                        $this->id = $id;
                }

                public function getTitle(){
                        return $this->title;
                }

                public function setTitle($title){
                        $this->title = $title;
                }

                public function getDescription(){
                        return $this->description;
                }

                public function setDescription($description){
                        $this->description = $description;
                }

                // Retorna el estado de la tarea (true = completada, false = pendiente)
                public function getStatus(){
                        return $this->status;
                }

                // Establece el estado de la tarea (true = completada, false = pendiente)
                public function setStatus($status){
                        $this->status = $status;
                }

                // Retorna la fecha de la tarea
                public function getDate(){
                        return $this->date;
                }

                public function setDate($date){
                        $this->date = $date;
                }
        }
?>