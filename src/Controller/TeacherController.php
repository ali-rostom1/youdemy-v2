<?php

namespace App\Controller;

use App\DAO\CategoryDAO;
use App\DAO\CourseDAO;
use App\DAO\EnrollmentDAO;
use App\DAO\StatisticsDAO;
use App\DAO\TagDAO;
use App\Entity\Enrollment;
use App\Service\Authentification;
use App\Entity\DocumentCourse;
use App\Entity\VideoCourse;

class TeacherController
{
    private CourseDAO $courseDAO;
    private CategoryDAO $categoryDAO;
    private Authentification $auth;
    private TagDAO $tagDAO;
    private EnrollmentDAO $enrollmentDAO;
    private StatisticsDAO $statisticsDAO;

    public function __construct()
    {
        $this->courseDAO = new CourseDAO();
        $this->categoryDAO = new CategoryDAO();
        $this->auth = new Authentification();
        $this->tagDAO = new TagDAO();
        $this->enrollmentDAO = new EnrollmentDAO();
        $this->statisticsDAO = new StatisticsDAO();
    }

    public function dashboard() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }



        $teacher = $this->auth->getCurrentUser();

        $totalCourses = $this->statisticsDAO->totalCoursesTeacher($teacher);
        $totalStudents = $this->statisticsDAO->totalStudentsTeacher($teacher);
        $totalEnrollments = $this->statisticsDAO->totalEnrollmentsTeacher($teacher);
        $recentEnrollments = $this->statisticsDAO->recentEnrollments($teacher);

        $enrollmentsByMonth = $this->statisticsDAO->totalEnrollmentsByMonthTeacher($teacher);
        $top3Courses = $this->statisticsDAO->getTop3CoursesByTeacher($teacher);

        include "../src/Views/teacher/teacherDashboard.php";
    }

    public function createCourse() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }
        $categories = $this->categoryDAO->getAllCategories();
        $tags = $this->tagDAO->getAllTags();

        include "../src/Views/teacher/createCourse.php";
    }

    public function courses() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }

        $teacher = $this->auth->getCurrentUser();
        $courses = $this->courseDAO->getCoursesByTeacher($teacher);
        $courseDataJson = json_encode(array_map(function($course) {
            return $course->jsonSerialize(true);
        }, $courses));
        $categories = $this->categoryDAO->getAllCategories();
        $tags = $this->tagDAO->getAllTags();

        include "../src/Views/teacher/courses.php";
    }
    public function create() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }
        $teacher = $this->auth->getCurrentUser();
        $title = $_POST["title"];
        $description = $_POST["description"];
        $type = $_POST["type"];
        $content = $_POST["content"];
        $category = $this->categoryDAO->getCategoryById($_POST["category"]);

        $tagsIds = $_POST["tags"];
        $tags = [];
        foreach ($tagsIds as $tagId) {
            $tags[] = $this->tagDAO->getTagById($tagId);
        }
         if($type == "video") {
            $course = new VideoCourse(null, $title, $description, $content, $category, $teacher, $tags);
        } else {
            $course = new DocumentCourse(null, $title, $description, $content, $category, $teacher, $tags);
        }
        $result = $this->courseDAO->saveCourse($course);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
    public function update() : void
    {
        if (!$this->auth->getCurrentUser() || (!$this->auth->isTeacher() && !$this->auth->isAdmin())) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }
        $teacher = $this->auth->getCurrentUser();
        $id = $_POST["id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $type = $_POST["type"];
        $content = $_POST["content"];
        $category = $this->categoryDAO->getCategoryById($_POST["category"]);

        $tagsIds = isset($_POST["tags"]) ? $_POST["tags"] : [];
        $tags = [];
        foreach ($tagsIds as $tagId){
            $tags[] = $this->tagDAO->getTagById($tagId);
        }
        if($type == "video") {
            $course = new VideoCourse($id, $title, $description, $content, $category, $teacher, $tags);
        }else {
            $course = new DocumentCourse($id, $title, $description, $content, $category, $teacher, $tags);
        }
        $result = $this->courseDAO->updateCourse($course);
        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
    public function delete() : void
    {
        if (!$this->auth->getCurrentUser() || (!$this->auth->isTeacher() && !$this->auth->isAdmin())) {
            header("location: /authentification");
            exit;
        }else if(!$this->auth->isActive()){
            header("location: /redirection");
            exit;
        }
        if($this->courseDAO->deleteCourse($_GET["id"])){
            echo json_encode(["success"=>true]);
        }else{
            echo json_encode(["success"=>false]);
        }

    }
}