<?php

    namespace App\Entity;

    class Enrollment{

        private ?int $id;
        private Course $course;
        private User $user;
        private \DateTime $enrollmentDate;

        public function __construct($id,Course $course,User $user,\DateTime $enrollmentDate)
        {
            $this->id = $id;
            $this->course = $course;
            $this->user = $user;
            $this->enrollmentDate = $enrollmentDate;
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


    }