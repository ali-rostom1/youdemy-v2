<?php 

namespace App\DAO;

use App\Database\Database;
use App\Entity\Enrollment;
use App\Entity\User;

class StatisticsDAO{

    private \PDO $con;


    public function __construct()
    {
        $this->con = Database::getInstance()->getConnection();
    }
    // teacher Statistics
    public function totalCoursesTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(*) as TOTAL FROM courses WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function totalStudentsTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(DISTINCT student_id) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function totalEnrollmentsTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(*) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function recentEnrollments(User $teacher) : array
    {
        $sql = "SELECT * FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id ORDER BY enrollment_date DESC LIMIT 3";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();

        $enrollments = [];
        $enrollmentDAO = new EnrollmentDAO();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $enrollments[] = $enrollmentDAO->mapRowToEnrollment($row);
        }
        return $enrollments;


    }
    public function totalEnrollmentsByMonthTeacher(User $teacher) : array
    {
        $query = "SELECT DATE_FORMAT(enrollment_date, '%Y-%m') as month, COUNT(*) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id GROUP BY month ORDER BY month";
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':teacher_id',$teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getTop3CoursesByTeacher(User $teacher) : array
    {
        $query = "SELECT title, COUNT(*) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id GROUP BY course_id ORDER BY TOTAL DESC LIMIT 3";
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':teacher_id',$teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Admin Statistics

    public function getTotalCoursesPerTeacher() : array
    {
        $query = "SELECT teacher_name, COUNT(*) as TOTAL FROM coursecategoryuser GROUP BY teacher_id";
        $stmt = $this->con->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getTopCoursesByEnrollments() : array
    {
        $query = "SELECT title, COUNT(*) as TOTAL FROM coursecategoryuserenrollment GROUP BY course_id ORDER BY TOTAL DESC LIMIT 3";
        $stmt = $this->con->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function recentUsers()
    {
        $query = "SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC LIMIT 3";
        $stmt = $this->con->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}