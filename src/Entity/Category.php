<?php

    namespace App\Entity;

    class Category implements \JsonSerializable{
        private ?int $id;
        private string $name; 
        private string $description;
        private int $course_count;

        public function __construct($name,$description,$id=NULL,$course_count=0)
        {
            $this->id = $id; 
            $this->name = $name; 
            $this->description = $description;
            $this->course_count = $course_count;
        }
        public function __get($attr){
            if(property_exists($this,$attr)){
                return $this->$attr;
            }
        }
        public function __set($attr,$value){
            if(property_exists($this,$attr)){
                $this->$attr = $value;
            }
        }
        public function jsonSerialize(): mixed
        {
            return [
                "id" => $this->id,
                "name" => $this->name,
                "description"=> $this->description,
                "course_count" => $this->course_count
            ]; 
        }
    }
    