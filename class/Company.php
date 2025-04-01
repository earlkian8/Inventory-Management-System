<?php
    class Company{
        private $conn;
        private $table = "company";

        public function __construct($db){
            $this->conn = $db;
            
        }
        
        public function getAllCompany(){
            $query = "SELECT * FROM " . $this->table . " LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getCompanyById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addCompany($name){
            $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name]);
        }
    }
?>