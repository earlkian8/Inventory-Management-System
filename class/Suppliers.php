<?php
    class Suppliers{
        private $conn;
        private $table = "suppliers";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllSuppliers(){
            $query = "SELECT * FROM " . $this->table . " ORDER BY supplier_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getSupplierById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE supplier_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addSupplier($name, $email, $contact_person, $address, $payment_terms){
            $query = "INSERT INTO " . $this->table . " (name, email, contact_person, address, payment_terms) VALUES (:name, :email, :contact_person, :address, :payment_terms)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":email" => $email, ":contact_person" => $contact_person, ":address" => $address, ":payment_terms" => $payment_terms]); 
        }

        public function updateSupplier($id, $name, $email, $contact_person, $address, $payment_terms){
            $query = "UPDATE " . $this->table . " SET name = :name, email = :email, contact_person = :contact_person, address = :address, payment_terms = :payment_terms WHERE supplier_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":email" => $email, ":contact_person" => $contact_person, ":address" => $address, ":payment_terms" => $payment_terms, ":id" => $id]);
        }

        public function deleteSupplier($id){
            $query = "DELETE FROM " . $this->table . " WHERE supplier_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
        public function getSupplierCount(){
            $query = "SELECT COUNT(*) AS count FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>