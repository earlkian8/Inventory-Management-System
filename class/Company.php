<?php
    class Company{
        private $conn;
        private $table = "company";

        public function __construct($db){
            $this->conn = $db;
            
        }

        public function addCompany($name){
            $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name]);
        }
    }
?>