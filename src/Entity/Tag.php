<?php
    namespace App\Entity;

    class Tag implements \JsonSerializable{
        private ?int $id;
        private string $name;

        public function __construct($id,$name){
            $this->id = $id;
            $this->name = $name;
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
        public function jsonSerialize() : array
        {
            return [
                'id' => $this->id,
                'name' => $this->name
            ];
        }
    }