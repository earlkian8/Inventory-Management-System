<?php
    class Items{
        private $conn;
        private $table = "items";

        public function __construct($db){
            $this->conn = $db;

        }

        public function getAllItems(){
            $query = "SELECT items.item_id, items.name, items.costPrice, items.quantity, items.unitPrice, items.sku, items.reorderLevel, items.status, items.supplier_id, items.category_id, suppliers.name as supplierName, categories.name as categoryName FROM " . $this->table . " JOIN suppliers
            ON items.supplier_id = suppliers.supplier_id JOIN categories ON items.category_id = categories.category_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getItemById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE item_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addItem($name, $costPrice, $quantity, $unitPrice, $sku, $reorderLevel, $status, $supplier_id, $category_id){
            $query = "INSERT INTO " . $this->table . " (name, costPrice, quantity, unitPrice, sku, reorderLevel, status, supplier_id, category_id) VALUES (:name, :costPrice, :quantity, :unitPrice, :sku, :reorderLevel, :status, :supplier_id, :category_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":costPrice" => $costPrice, ":quantity" => $quantity, ":unitPrice" => $unitPrice, ":sku" => $sku, ":reorderLevel" => $reorderLevel, ":status" => $status, ":supplier_id" => $supplier_id, ":category_id" => $category_id]);
        }

        public function updateItem($id, $name, $costPrice, $quantity, $unitPrice, $sku, $reorderLevel, $status, $supplier_id, $category_id){
            $query = "UPDATE " . $this->table . " SET name = :name, costPrice = :costPrice, quantity = :quantity, unitPrice = :unitPrice, sku = :sku, reorderLevel = :reorderLevel, status = :status, supplier_id = :supplier_id, category_id = :category_id WHERE item_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":costPrice" => $costPrice, ":quantity" => $quantity, ":unitPrice" => $unitPrice, ":sku" => $sku, ":reorderLevel" => $reorderLevel, ":status" => $status, ":supplier_id" => $supplier_id, ":category_id" => $category_id, ":id"=> $id]);
        }
        
        public function deleteItem($id){
            $query = "DELETE FROM " . $this->table . " WHERE item_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
        public function getItemCount(){
            $query = "SELECT COUNT(*) AS count FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public function getItemCountByLowStock(){
            $query = "SELECT COUNT(*) AS count FROM " . $this->table . " WHERE quantity < reorderLevel AND quantity != 0";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getItemCountByOutStock(){
            $query = "SELECT COUNT(*) AS count FROM " . $this->table . " WHERE quantity = 0";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>