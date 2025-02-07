<?php

    namespace App\Entity;

    abstract class Course implements \JsonSerializable
    {
        protected ?int $id;
        protected string $title;
        protected string $description;
        protected string $type;
        protected string $content;
        protected Category $category; 
        protected User $teacher; 
        protected array $tags = [];


        public function __construct($id, $title, $description,$type,$content,Category $category,User $teacher,$tags = []){
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->type = $type;
            $this->content = $content;
            $this->category = $category;
            $this->teacher = $teacher;
            $this->tags = $tags;
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
        abstract public function getContent($asURL=false) : string;

        public function jsonSerialize($asURL=false) : array
        {
            return [
                 'id' => $this->id, 
                 'title' => $this->title, 
                 'description' => $this->description, 
                 'type' => $this->type, 
                 'content' => htmlspecialchars($this->getContent($asURL),ENT_QUOTES, 'UTF-8'), 
                 'category' => $this->category->name,
                 'category-id' => $this->category->id,
                 'teacher' => $this->teacher->username, 
                 'tags' => $this->tags
                ];
        }
    }


?>