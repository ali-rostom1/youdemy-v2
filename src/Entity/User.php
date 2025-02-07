<?php

    namespace App\Entity;

    class User{

        private ?int $id; 
        private string $username; 
        private ?string $password; 
        private string $email; 
        private string $role; 
        private string $status;
        private ?\DateTime $createdAt;

        public function __construct($id,$username,$password,$email,$role,$status,\DateTime $createdAt=NULL)
        {
            $this->id = $id; 
            $this->username = $username; 
            $this->password = $password;
            $this->email = $email; 
            $this->role = $role; 
            $this->status = $status;
            $this->createdAt = $createdAt;
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
        public function getLogoName() : string
        {
            return  strtoupper(implode("",array_map(function($word){
                return $word[0];
            },explode(" ",$this->username))));
           
        }
    }
