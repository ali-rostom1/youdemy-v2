<?php
    namespace App\DAO;

    use App\Database\Database;
    use App\Entity\Category;
    use App\Entity\Course;
    use App\Entity\DocumentCourse;
    use App\Entity\Tag;
    use App\Entity\VideoCourse;
    use App\Entity\User;

    class CourseDAO{
        private \PDO $con;
        public static $perPage = 2;

        public function __construct(){
            $this->con = Database::getInstance()->getConnection();
        }
        // helpers
        private function mapRowToCourse(array $row) : Course
        {
            $category = new Category($row["category_name"],$row["category_description"],$row["category_id"]);
            $teacher = new User($row["teacher_id"],$row["teacher_name"],NULL,$row["teacher_email"],"teacher",$row["status"]);
            $tags = $this->getTagsByCourseId($row['course_id']);

            if($row["type"] === "document")
            {
                return new DocumentCourse($row["course_id"],$row["title"],$row["description"],$row["content"],$category,$teacher,$tags);
            }else{
                return new VideoCourse($row["course_id"],$row["title"],$row["description"],$row["content"],$category,$teacher,$tags);
            }

        }
        private function getTagsByCourseID(int $courseId) : array
        {
            $query = "SELECT t.* FROM tags t,course_tags ct WHERE t.tag_id=ct.tag_id AND ct.course_id = :course_id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":course_id",$courseId,\PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $tags = [];
            foreach($rows as $row){
                $tags[] = new Tag($row["tag_id"],$row["name"]);
            }
            return $tags;
        }
        
        //CRUD
        public function getAllCourses() : array
        {
            $query = "SELECT * FROM courseCategoryUser"; //view joining courses/categories/users tables
            $stmt = $this->con->query($query);
            $rows = $stmt->fetchAll();
            
            $courses = [];
            
            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            
            return $courses;
        }
        
        public function getCourseById(int $id) : ?Course
        {
            $query = "SELECT * from courseCategoryUser WHERE course_id = :course_id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":course_id",$id,\PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($row){
                return $this->mapRowToCourse($row);
            }else return NULL;
        }

        public function saveCourse(Course $course) : bool
        {

            try{
                $query = "INSERT INTO Courses(title, description, type, content, category_id, teacher_id) values (:title,:description,:type,:content,:category_id,:teacher_id);";
                $stmt = $this->con->prepare($query);

                $result = $stmt->execute([
                    'title' => $course->title,
                    'description' => $course->description, 
                    'type' => $course->type, 
                    'content' => $course->content, 
                    'category_id' => $course->category->id, 
                    'teacher_id' => $course->teacher->id
                ]);
                if($result)
                {
                    $id = $this->con->lastInsertId();
                    $this->saveTags($id,$course->tags); 
                    return true;
                }
                return false;
            }catch(\PDOException ){
                return false;
            }
        }
        public function saveTags(int $courseId,array $tags) : void
        {
            $stmt = $this->con->prepare("DELETE FROM course_tags WHERE course_id = :course_id");
            $stmt->execute(['course_id' => $courseId]);
            
            $query = "INSERT INTO course_tags(course_id,tag_id) values (:course_id,:tag_id)";
            $stmt = $this->con->prepare($query);
            foreach($tags as $tag){
                $stmt->execute([
                    "course_id" => $courseId,
                    "tag_id" =>  $tag->id
                    ]);
            }
        }
        public function updateCourse(Course $course): bool 
        { 
            $query = "UPDATE Courses SET title = :title, description = :description, type = :type, content = :content, category_id = :category_id, teacher_id = :teacher_id WHERE course_id = :id";
            $stmt = $this->con->prepare($query); 
            $result = $stmt->execute([ 
                'id' => $course->id, 
                'title' => $course->title, 
                'description' => $course->description, 
                'type' => $course->type, 
                'content' => $course->content, 
                'category_id' => $course->category->id, 
                'teacher_id' => $course->teacher->id
            ]); 
            if ($result) { 
                $this->saveTags($course->id,$course->tags); 
                return true; 
            } 
            return false; 
        }
        public function deleteCourse(int $id): bool 
        { 
            $stmt = $this->con->prepare("DELETE FROM Courses WHERE course_id = :id"); 
            return $stmt->execute(['id' => $id]); 
        }
        //other needed function
        public function getAllVideoCourses() : array
        {
            $query = "SELECT * FROM courseCategoryUser where type= 'Video' ";
            $stmt = $this->con->query($query);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $courses = [];

            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            return $courses;
        }
        public function getVideoCoursesCount() : int
        {
            $query = "SELECT count(*) as TOTAL FROM courses where type ='Video'";
            $stmt = $this->con->query($query);
            $count = $stmt->fetch(\PDO::FETCH_ASSOC);
            return isset($count["TOTAL"]) ? $count["TOTAL"] : NULL;
        }
        public function getDocumentCoursesCount() : int
        {
            $query = "SELECT count(*) as TOTAL FROM courses where type ='Document'";
            $stmt = $this->con->query($query);
            $count = $stmt->fetch(\PDO::FETCH_ASSOC);
            return isset($count["TOTAL"]) ? $count["TOTAL"] : NULL;
        }
        public function getCoursesLimit($page) : ?array
        {
            $offset = ($page-1) * self::$perPage;
            $perPage = self::$perPage;
            $query = "SELECT * FROM courseCategoryUser LIMIT :offset,$perPage";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
            var_dump($stmt);

            if($stmt->execute()){
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $courses = [];
                if($rows){
                    foreach($rows as $row){
                        $courses[] = $this->mapRowToCourse($row);
                    }
                    return $courses;
                }
                return NULL;
                
            }else return false;   
        }
        public function getTotalCourses() : int
        {
            $query = "SELECT count(*) AS TOTAL FROM courses";
            $result = $this->con->query($query);
            return $result->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
        }
        public function getAllCoursesPagination($page,$perPage,$category) : array
        {
            $offset = ($page-1) * $perPage;
            
            $query = "SELECT * FROM courseCategoryUser ";
            if($category)
            {
                $query .= "WHERE category_id = :category_id ";
            }
            $query .= "LIMIT :offset,:perPage ";
            $stmt = $this->con->prepare($query);
            if($category)
            {
                $stmt->bindParam(":category_id",$category,\PDO::PARAM_INT);
            }
            $stmt->bindParam(":perPage",$perPage,\PDO::PARAM_INT);
            $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $courses = [];
            
            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            return $courses;
        }
        public function getTotalCoursesCategory($category) : int
        {
            $query = "SELECT COUNT(*) AS TOTAL FROM courseCategoryUser ";
            if($category){
                $query .= "WHERE category_id = :category_id";
            }
            $stmt = $this->con->prepare($query);
            if($category){
                $stmt->bindParam(":category_id",$category,\PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
        }
        public function searchCourses($term) : array
        {
            $term = '%' . $term . '%';
            $query = "SELECT * FROM courseCategoryUser WHERE title like :term";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":term",$term,\PDO::PARAM_STR);
            $stmt->execute();
            
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $courses = [];
            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            return $courses;
        }
        public function getAllCoursesPaginationv2($page,$perPage,$category,$tag,$type) : array
        {
            
            $offset = ($page-1) * $perPage;
            $query = $tag  ? "SELECT * FROM courseCategoryUserTag WHERE 1=1 " : "SELECT * FROM courseCategoryUser WHERE 1=1 ";
            if($category){
                $query .= "AND category_id = :category_id ";
            }
            if($tag){
                $query .= "AND tag_id = :tag_id ";
            }
            if($type){
                $query .="AND type = :type ";
            }
            $query.= "LIMIT :offset,:perPage ";

            
            $stmt = $this->con->prepare($query);
            if($category){
                $stmt->bindParam(":category_id",$category,\PDO::PARAM_INT);
            }
            if($tag){
                $stmt->bindParam(":tag_id",$tag,\PDO::PARAM_INT);
           }
            if($type){
                $stmt->bindParam(":type",$type,\PDO::PARAM_STR);
            }
            
            $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
            $stmt->bindParam(":perPage",$perPage,\PDO::PARAM_INT);
            
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $courses = [];
            foreach($rows as $row)
            {
                $courses[] = $this->mapRowToCourse($row);
            }
            return $courses;
        }
        public function getTotalCoursesFilter($category,$tag,$type) : int
        {
            $query = !$tag ? "SELECT count(*) AS TOTAL FROM courseCategoryUser WHERE 1=1 " : "SELECT COUNT(*) AS TOTAL FROM courseCategoryUserTag WHERE 1=1 ";

            if($category){
                $query .= "AND category_id = :category_id ";
            }
            if($tag){
                $query .= "AND tag_id = :tag_id ";
            }
            if($type){
                $query .="AND type = :type ";
            }

            $stmt = $this->con->prepare($query);


            if($category){
                $stmt->bindParam(":category_id",$category,\PDO::PARAM_INT);
            }
            if($tag){
                $stmt->bindParam(":tag_id",$tag,\PDO::PARAM_INT);
            }
            if($type){
                $stmt->bindParam(":type",$type,\PDO::PARAM_STR);
            }

            $stmt->execute();
            
            return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
        }
        public function getCoursesByStudent(User $student) : array
        {
            try{
                $query = "SELECT * FROM coursecategoryuserenrollment WHERE student_id =:student_id";
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(":student_id",$student->id,\PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                
                $courses = [];

                foreach($rows as $row){
                    $courses[] = $this->mapRowToCourse($row);
                }
                return $courses;

            }catch(\PDOException){
                return false;
            }
            
        }
        public function searchCoursesByStudent(User $student,$term) : array
        {
            try{
                $term = '%'.$term.'%';
                $query = "SELECT * FROM coursecategoryuserenrollment WHERE student_id =:student_id AND title LIKE :term";
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(":student_id",$student->id,\PDO::PARAM_INT);
                $stmt->bindParam(":term",$term,\PDO::PARAM_STR);
                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                
                $courses = [];

                foreach($rows as $row){
                    $courses[] = $this->mapRowToCourse($row);
                }
                return $courses;

            }catch(\PDOException){
                return false;
            }
            
        }
        public function getCoursesByTeacher(User $teacher) : array
        {
            try{
                $query = "SELECT * FROM coursecategoryuser WHERE teacher_id =:teacher_id";
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(":teacher_id",$teacher->id,\PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                
                $courses = [];

                foreach($rows as $row){
                    $courses[] = $this->mapRowToCourse($row);
                }
                return $courses;

            }catch(\PDOException){
                return false;
            }
            
        }
    }