<?php

    namespace App\Entity;

    class DocumentCourse extends Course{
        public function __construct($id, $title, $description,$content,Category $category,User $teacher,$tags = [])
        {
            parent::__construct($id, $title, $description,"document",$content,$category,$teacher,$tags);
        }
        public function getContent($asURL=false) : string
        {
            return $this->content;
        }

    }