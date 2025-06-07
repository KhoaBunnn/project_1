<?php
class CategoryModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getCategories() {
        $stmt = $this->db->query("SELECT * FROM category ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addCategory($name) {
        $stmt = $this->db->prepare("INSERT INTO category (name) VALUES (:name)");
        return $stmt->execute(['name' => $name]);
    }

    public function updateCategory($id, $name) {
        $stmt = $this->db->prepare("UPDATE category SET name = :name WHERE id = :id");
        return $stmt->execute(['name' => $name, 'id' => $id]);
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM category WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
