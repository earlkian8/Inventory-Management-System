<?php
    class Categories{
        private $conn;
        private $table = "categories";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllCategories(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategoryById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE category_id = :category_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":category_id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addCategory($name, $description){
            $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":description" => $description]);
        }

        public function updateCategory($id, $name, $description){
            $query = "UPDATE " . $this->table . " SET name = :name, description = :description WHERE category_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":description" => $description, ":id" => $id]);
        }

        public function deleteCategory($id){
            $query = "DELETE FROM " . $this->table . " WHERE category_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>