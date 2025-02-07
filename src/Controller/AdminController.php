<?php 

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;
    use App\DAO\EnrollmentDAO;
    use App\DAO\TagDAO;
    use App\DAO\UserDAO;
    use App\Service\Authentification;
    use App\Entity\Category;
    use App\Entity\Tag;
    use App\DAO\StatisticsDAO;

    class AdminController{
        private Authentification $auth;
        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;
        private TagDAO $tagDAO;
        private UserDAO $userDAO;
        private EnrollmentDAO $enrollmentDAO;
        private StatisticsDAO $statisticsDAO;

        public function __construct()
        {
            $this->auth = new Authentification();
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->tagDAO = new TagDAO();
            $this->userDAO = new UserDAO();
            $this->enrollmentDAO = new EnrollmentDAO();
            $this->statisticsDAO = new StatisticsDAO();
        }
        public function index() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $totalStudents = $this->userDAO->getAllStudentsCount();
            $totalTeachers = $this->userDAO->getAllTeachersCount();
            $totalCourses  = $this->courseDAO->getTotalCourses();
            $totalEnrollments = $this->enrollmentDAO->getTotalEnrollments();
            include "../src/Views/admin/dashboard.php";
        }
        public function users() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $role = isset($_GET["role"]) ? $_GET["role"] : "";
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 4;
            $users = !$term ?  $this->userDAO->getAllUsersPagination($page,$perPage,$role) : $this->userDAO->searchUsers($term);
            $totalUsers = $this->userDAO->getTotalUsers($role); 
            $totalPages = ceil($totalUsers/$perPage);
            include "../src/Views/admin/users.php";
        }
        public function courses() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $category = isset($_GET["category"]) ? $_GET["category"] : "";
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 4;
            $courses = !$term ?  $this->courseDAO->getAllCoursesPagination($page,$perPage,$category) : $this->courseDAO->searchCourses($term);
            $categories = $this->categoryDAO->getAllCategories();
            $totalCourses = $this->courseDAO->getTotalCoursesCategory($category);
            $totalPages = ceil($totalCourses/$perPage);

            $courseDataJson = json_encode(array_map(function($course) {
                return $course->jsonSerialize(true);
            }, $courses));

            $tags = $this->tagDAO->getAllTags();

            include "../src/Views/admin/courses.php";
        }
        public function category() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 2;
            $categories = !$term ?  $this->categoryDAO->getAllCategoryPagination($page,$perPage) : $this->categoryDAO->searchCategory($term);
            $totalCategories = $this->categoryDAO->getTotalCategory();
            $totalPages = ceil($totalCategories/$perPage);
            $categoriesDataJson = json_encode($categories);
            include "../src/Views/admin/category.php";
        }
        public function tag() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 2;
            $totalTags = $this->tagDAO->getTotalTags();
            $totalPages = ceil($totalTags/$perPage);
            $tags = !$term ?  $this->tagDAO->getAlltagsPagination($page,$perPage) : $this->tagDAO->searchTag($term);
            $tagsDataJson = json_encode($tags);

            include "../src/Views/admin/tag.php";
        }
        public function ban() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $user = $this->userDAO->getUserById($id);
            $user->status = "banned";
            if($this->userDAO->updateUser($user)){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }
        }
        public function suspend() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $user = $this->userDAO->getUserById($id);
            $user->status = "suspended";
            if($this->userDAO->updateUser($user)){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }
        }
        public function approve() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $user = $this->userDAO->getUserById($id);
            $user->status = "active";
            if($this->userDAO->updateUser($user)){
                echo json_encode(["success"=>true]);
            }else{
                echo json_encode(["success"=>false]);
            }
        }
        public function updateCategory() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            if($_POST["id"]){
                $category = $this->categoryDAO->getCategoryById($_POST["id"]);
                $category->name = $_POST["name"];
                $category->description = $_POST["description"];
                if($this->categoryDAO->updateCategory($category)){
                    echo json_encode(["success" => true]);
                }else{
                    echo json_encode(["success" => false]);
                }
            }else{
                $category = new Category($_POST["name"],$_POST["description"]);
                if($this->categoryDAO->saveCategory($category)){
                    echo json_encode(["success" => true]);
                }else{
                    echo json_encode(["success" => false]);
                }
            } 
        }
        public function deleteCategory() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            if($this->categoryDAO->deleteCategory($_GET["id"])){
                echo json_encode(["success" => true]);
            }else{
                echo json_encode(["success" => false]);
            }
        }
        public function updateTag() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            
            if (isset($_POST["id"]) && $_POST["id"]) {
                $tag = $this->tagDAO->getTagById($_POST["id"]);
                $tag->name = $_POST["name"];
                if ($this->tagDAO->updateTag($tag)) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false]);
                }
            } else {
                $names = $_POST["names"];
                $success = true;

                foreach ($names as $name) {
                    $tag = new Tag(NULL, $name);
                    if (!$this->tagDAO->saveTag($tag)) {
                        $success = false;
                        break;
                    }
                }

                if ($success) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false]);
                }
            }
        }
        public function deleteTag() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            if($this->tagDAO->deleteTag($_GET["id"])){
                echo json_encode(["success" => true]);
            }else{
                echo json_encode(["success" => false]);
            }
        }
        public function getCoursesPerTeacher() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            echo json_encode($this->statisticsDAO->getTotalCoursesPerTeacher());
        }
        public function getTopCoursesByEnrollments() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            echo json_encode($this->statisticsDAO->getTopCoursesByEnrollments());
        }
    }