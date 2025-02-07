<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\Tag;


class TagDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    private function mapRowToTag(array $row): Tag 
    {
        return new Tag($row['tag_id'], $row['name']);
    }

    // CRUD Operations
    public function getAllTags(): array 
    {
        $query = "SELECT * FROM Tags";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tags[] = $this->mapRowToTag($row);
        }
        return $tags;
    }

    public function getTagById(int $id): ?Tag 
    {
        $query = "SELECT * FROM Tags WHERE tag_id = :tag_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':tag_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToTag($row);
        }
        return null;
    }

    public function saveTag(Tag $tag): bool 
    {
        $stmt = $this->con->prepare("INSERT INTO Tags (name) VALUES (:name)");
        return $stmt->execute(['name' => $tag->name]);
    }

    public function updateTag(Tag $tag): bool 
    {
        $stmt = $this->con->prepare("UPDATE Tags SET name = :name WHERE tag_id = :tag_id");
        return $stmt->execute([
            'tag_id' => $tag->id,
            'name' => $tag->name
        ]);
    }

    public function deleteTag(int $id): bool 
    {
        $stmt = $this->con->prepare("DELETE FROM Tags WHERE tag_id = :tag_id");
        return $stmt->execute(['tag_id' => $id]);
    }
    public function getAlltagsPagination($page,$perPage) : array
    {
        $offset = ($page-1) * $perPage;
        
        $query = "SELECT * FROM tags LIMIT :offset,:perPage ";
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":perPage",$perPage,\PDO::PARAM_INT);
        $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tags = [];
        
        foreach($rows as $row){
            $tags[] = $this->mapRowToTag($row);
        }
        return $tags;
    }
    public function getTotalTags() : int
    {
        $query = "SELECT COUNT(*) AS TOTAL FROM tags";
        $stmt = $this->con->query($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)["TOTAL"];
    }
    public function searchTag($term) : array
    {
        $term = '%' . $term . '%';
        $query = "SELECT * FROM categoryCount WHERE name like :term";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":term",$term,\PDO::PARAM_STR);
        $stmt->execute();
        
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tags = [];
        foreach($rows as $row){
            $tags[] = $this->mapRowToTag($row);
        }
        return $tags;
    }
}
