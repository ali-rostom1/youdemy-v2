<?php

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;
    use App\DAO\EnrollmentDAO;
    use App\DAO\TagDAO;
    use App\Entity\Enrollment;
    use App\Service\Authentification;
    

    class DefaultController{

        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;
        private Authentification $auth;
        private TagDAO $tagDAO;
        private EnrollmentDAO $enrollmentDAO;

        public function __construct()
        {
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->auth = new Authentification();
            $this->tagDAO = new TagDAO();
            $this->enrollmentDAO = new EnrollmentDAO();
        }
        public function index() : void
        {
            if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                exit;
            }else if($this->auth->isTeacher() && $this->auth->isActive()){
                header("location: /teacher/dashboard");
                exit;
            }else if($this->auth->isAuthenticated() && !$this->auth->isActive()){
                header("location: /redirection");
                exit;
            }
            $categories = array_slice($this->categoryDAO->getAllCategories(), 0, 3); 
            $courses = array_slice($this->courseDAO->getAllCourses(), 0, 3);
            $isLogged = $this->auth->isAuthenticated();
            $user = $this->auth->getCurrentUser();
            include "../src/Views/home.php";
        }
        public function catalogue() : void
        {
            if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                exit;
            }else if($this->auth->isTeacher() && $this->auth->isActive()){
                header("location: /teacher/dashboard");
                exit;
            }else if($this->auth->isAuthenticated() && !$this->auth->isActive()){
                header("location: /redirection");
                exit;
            }

            //GET QUERIES
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $category = isset($_GET["category"]) ? $_GET["category"] : "";
            $tag = isset($_GET["tag"]) ? $_GET["tag"] : "";
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $type = isset($_GET["type"]) ? $_GET["type"] : "";

            //PAGINATION
            $perPage = 4;
            $courses = !$term ?  $this->courseDAO->getAllCoursesPaginationv2($page,$perPage,$category,$tag,$type) : $this->courseDAO->searchCourses($term);
            $totalCourses = $this->courseDAO->getTotalCoursesFilter($category,$tag,$type);
            $categories = $this->categoryDAO->getAllCategories();
            $tags = $this->tagDAO->getAllTags();
            $totalPages = ceil($totalCourses/$perPage);

            //FILTERS
            $documentCoursesCount = $this->courseDAO->getDocumentCoursesCount();
            $videoCoursesCount = $this->courseDAO->getVideoCoursesCount();

            $courseDataJson = json_encode($courses);

            $isLogged = $this->auth->isAuthenticated();
            $user = $this->auth->getCurrentUser();
            include "../src/Views/catalogue.php";
        }
        public function courseSignUp() : void
        {
            if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                exit;
            }else if($this->auth->isTeacher() && $this->auth->isActive()){
                header("location: /teacher/dashboard");
                exit;
            }else if($this->auth->isAuthenticated() && !$this->auth->isActive()){
                header("location: /redirection");
                exit;
            }

            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $course = $this->courseDAO->getCourseById($id);
            $user = $this->auth->getCurrentUser();
            $enrollment = new Enrollment(NULL,$course,$user,new \DateTime());
            if($this->enrollmentDAO->saveEnrollment($enrollment)){
                header("location: /catalogue?success");
                exit;
            }else{
                header("location: /catalogue?error");
                exit;
            }

        }
        public function myCourses() : void
        {
            if($this->auth->getCurrentUser() && !$this->auth->isStudent()){
                header("location: /");
                exit;
            }else if(!$this->auth->isActive()){
                header("location: /redirection");
                exit;
            }

            $term = isset($_GET["term"]) ?  $_GET["term"] : "";


            $student = $this->auth->getCurrentUser();
            $courses = !$term ? $this->courseDAO->getCoursesByStudent($student) : $this->courseDAO->searchCoursesByStudent($student,$term);
            $courseDataJson = json_encode($courses);

            $isLogged = $this->auth->isAuthenticated();
            $user = $this->auth->getCurrentUser();
            include "../src/Views/myCourses.php";
        }
    }