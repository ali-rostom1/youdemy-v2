<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\User;
use PDOException;

class UserDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    // Helpers
    private function mapRowToUser(array $row): User 
    {
        return new User(
            $row['user_id'], 
            $row['username'], 
            $row['password'], 
            $row['email'], 
            $row['role'], 
            $row['status'],
            new \DateTime($row['created_at'])
        );
    }

    // CRUD Operations
    public function getAllUsers(): array 
    {
        $query = "SELECT * FROM Users";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
    }

    public function getUserById(int $id): ?User 
    {
        $query = "SELECT * FROM Users WHERE user_id = :user_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':user_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return $this->mapRowToUser($row);
        }
        return null;
    }

    public function saveUser(User $user): bool 
    {
        try{
            $stmt = $this->con->prepare("INSERT INTO Users (username, password, email, role, status) VALUES (:username, :password, :email, :role, :status)");
            return $stmt->execute([
                'username' => $user->username,
                'password' => $user->password,
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status
            ]);
        }catch(PDOException){
            return false;
        }
    }

    public function updateUser(User $user): bool {
        try{
            $stmt = $this->con->prepare("UPDATE Users SET username = :username, password = :password, email = :email, role = :role, status = :status WHERE user_id = :user_id");
            return $stmt->execute([
                'user_id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status
            ]);
        }catch(\PDOException){
            return false;
        }
    }

    public function deleteUser(int $id): bool {
        $stmt = $this->con->prepare("DELETE FROM Users WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $id]);
    }

    public function getUserByEmail(string $email): ?User {
        $query = "SELECT * FROM Users WHERE email = :email";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToUser($row);
        }
        return null;
    }
    public function getAllNotAdminUsers(){
        $query = "SELECT * FROM Users where role !='admin'";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
    }

    public function verifyPassword(string $email, string $password): bool {
        $user = $this->getUserByEmail($email);
        if ($user) {
            return password_verify($password, $user->password);
        }
        return false;
    }
    public function getAllStudentsCount(): int
    { 
        $query = "SELECT count(*) as TOTAL FROM users WHERE role = 'student' and status !='banned'";
        $stmt = $this->con->query($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];

    }
    public function getAllTeachersCount(): int
    { 
        $query = "SELECT count(*) as TOTAL FROM users WHERE role = 'teacher' and status != 'pending' and status != 'banned'";
        $stmt = $this->con->query($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];

    }
    public function getAllUsersPagination($page,$perPage,$role) : array
    {
        $offset = ($page-1) * $perPage;
        
        $query = "SELECT * FROM users WHERE role != 'admin' ";
        if($role)
        {
            $query .= "AND role = :role ";
        }
        $query .= "LIMIT :offset,:perPage ";
        $stmt = $this->con->prepare($query);
        if($role)
        {
            $stmt->bindParam(":role",$role,\PDO::PARAM_STR);
        }
        $stmt->bindParam(":perPage",$perPage,\PDO::PARAM_INT);
        $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        
        foreach($rows as $row){
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
    }
    public function getTotalUsers($role) : int
    {
        $query = "SELECT COUNT(*) AS TOTAL FROM users WHERE role != 'admin' ";
        if($role){
            $query .= "AND role = :role";
        }
        $stmt = $this->con->prepare($query);
        if($role){
            $stmt->bindParam(":role",$role,\PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
    }
    public function searchUsers($term) : array
    {
        $term = '%' . $term . '%';
        $query = "SELECT * FROM users WHERE username like :term";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":term",$term,\PDO::PARAM_STR);
        $stmt->execute();
        
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        foreach($rows as $row){
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
    }
}
