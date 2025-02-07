<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\Category;


class CategoryDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    private function mapRowToCategory(array $row): Category {
        return new Category($row['name'], $row['description'],$row['category_id'],$row["course_count"]);
    }
    
    public function getAllCategories(): array {
        $query = "SELECT * FROM categoryCount";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = $this->mapRowToCategory($row);
        }
        return $categories;
    }

    public function getCategoryById(int $id): ?Category {
        $query = "SELECT * FROM categoryCount WHERE category_id = :category_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':category_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToCategory($row);
        }
        return null;
    }

    public function saveCategory(Category $category): bool {
        try{
            $stmt = $this->con->prepare("INSERT INTO Categories (name, description) VALUES (:name, :description)");
            return $stmt->execute([
                'name' => $category->name,
                'description' => $category->description
            ]);
        }catch(\PDOException){
            return false;
        }
    }

    public function updateCategory(Category $category): bool {
        $stmt = $this->con->prepare("UPDATE Categories SET name = :name, description = :description WHERE category_id = :category_id");
        return $stmt->execute([
            'category_id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ]);
    }

    public function deleteCategory(int $id): bool {
        try{
            $stmt = $this->con->prepare("DELETE FROM Categories WHERE category_id = :category_id");
            return $stmt->execute(['category_id' => $id]);
        }catch(\PDOException){
            return false;
        }
        
    }
    public function getAllCategoryPagination($page,$perPage) : array
    {
        $offset = ($page-1) * $perPage;
        
        $query = "SELECT * FROM categoryCount LIMIT :offset,:perPage ";
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":perPage",$perPage,\PDO::PARAM_INT);
        $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $categories = [];
        
        foreach($rows as $row){
            $categories[] = $this->mapRowToCategory($row);
        }
        return $categories;
    }
    public function getTotalCategory() : int
    {
        $query = "SELECT COUNT(*) AS TOTAL FROM categoryCount";
        $stmt = $this->con->query($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
    }
    public function searchCategory($term) : array
    {
        $term = '%' . $term . '%';
        $query = "SELECT * FROM categoryCount WHERE name like :term";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":term",$term,\PDO::PARAM_STR);
        $stmt->execute();
        
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $categories = [];
        foreach($rows as $row){
            $categories[] = $this->mapRowToCategory($row);
        }
        return $categories;
    }
}
