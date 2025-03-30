<?php
    class Accounts{
        private $conn;
        private $table = "accounts";

        public function __construct($db){
            $this->conn = $db;

        }

        public function getAllAccounts(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAccountById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getAccountCountByAdmin(){
            $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE account_type = 'admin'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addAccount($first_name, $middle_name, $last_name, $email, $address, $username, $password, $gender, $account_type, $date_of_birth){
            $query = "INSERT INTO " . $this->table . " (first_name, middle_name, last_name, email, address, username, password, gender, account_type, date_of_birth) VALUES (:first_name, :middle_name, :last_name, :email, :address, :username, :password, :gender, :account_type, :date_of_birth)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":first_name" => $first_name, ":middle_name" => $middle_name, ":last_name" => $last_name, ":email" => $email, ":address" => $address, ":username" => $username, ":password" => $password, ":gender" => $gender, ":account_type" => $account_type, "date_of_birth" => $date_of_birth]);
        }

        public function updateAccount($id, $first_name, $middle_name, $last_name, $email, $address, $username, $password, $gender, $account_type, $date_of_birth){
            $query = "UPDATE " . $this->table . " SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, email = :email, address = :address, username = :username, password = :password, gender = :gender, account_type = :account_type, date_of_birth = :date_of_birth WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":first_name" => $first_name, ":middle_name" => $middle_name, ":last_name" => $last_name, ":email" => $email, ":address" => $address, ":username" => $username, ":password" => $password, ":gender" => $gender, ":account_type" => $account_type, "date_of_birth" => $date_of_birth, ":id" => $id]);
        }

        public function deleteAccount($id){
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }

        public function login($username, $password){
            $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":username" => $username]);
            if($stmt->rowCount() == 1){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if($password == $user["password"]){
                    return $user;
                }
            }
            return false;
        }

    }
?>