<?php
class Installment {
    private $conn;
    private $table = "installment";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllInstallment(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllInstallmentItems(){
        $query = "SELECT * FROM installment_items";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addInstallment($subTotal, $taxAmount, $totalAmount, $downpayment, $months, $interest, $monthlyAmount) {
        $this->conn->beginTransaction();
    
        try {
            $query = "INSERT INTO " . $this->table . " (subtotal, tax_amount, total_amount, downpayment, monthly_payment, interest, monthly_amount) VALUES (:subtotal, :tax_amount, :total_amount, :downpayment, :monthly_payment, :interest, :monthly_amount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ":subtotal" => $subTotal,
                ":tax_amount" => $taxAmount,
                ":total_amount" => $totalAmount,
                ":downpayment" => $downpayment,
                ":monthly_payment" => (string)$months,
                ":interest" => $interest,
                ":monthly_amount" => $monthlyAmount
            ]);
    
            $installmentId = $this->conn->lastInsertId();
            $this->conn->commit();
    
            error_log("addInstallment succeeded: installmentId=$installmentId");
            return $installmentId;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("addInstallment failed: " . $e->getMessage());
            throw $e;
        }
    }

    public function addInstallmentItems($installmentId, $items) {
        $this->conn->beginTransaction();
    
        try {
            error_log("addInstallmentItems called with installmentId: $installmentId, items: " . json_encode($items));
    
            if (empty($items)) {
                throw new Exception("No items provided for installment $installmentId");
            }
    
            foreach ($items as $item) {
                error_log("Processing item: " . json_encode($item));
                if (!isset($item['item_id'], $item['quantity'], $item['unit_price'], $item['discount_percent'], $item['total_price'])) {
                    throw new Exception("Invalid item data: " . json_encode($item));
                }
    
                $itemQuery = "SELECT name FROM items WHERE item_id = :item_id";
                $itemStmt = $this->conn->prepare($itemQuery);
                $itemStmt->execute([':item_id' => $item['item_id']]);
                $itemData = $itemStmt->fetch(PDO::FETCH_ASSOC);
    
                if (!$itemData) {
                    throw new Exception("Item with ID {$item['item_id']} not found.");
                }
    
                $itemName = $itemData['name'];
    
                $query = "INSERT INTO installment_items (installment_id, item_id, quantity, unit_price, discount_percent, total_price, item_name) 
                          VALUES (:installment_id, :item_id, :quantity, :unit_price, :discount_percent, :total_price, :item_name)";
                $stmt = $this->conn->prepare($query);
                $success = $stmt->execute([
                    ":installment_id" => $installmentId,
                    ":item_id" => $item['item_id'],
                    ":quantity" => $item['quantity'],
                    ":unit_price" => $item['unit_price'],
                    ":discount_percent" => $item['discount_percent'],
                    ":total_price" => $item['total_price'],
                    ":item_name" => $itemName
                ]);
    
                if (!$success) {
                    throw new Exception("Failed to insert item {$item['item_id']} into installment_items");
                }
    
                $updateQuery = "UPDATE items SET quantity = quantity - :quantity WHERE item_id = :item_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->execute([
                    ":quantity" => $item['quantity'],
                    ":item_id" => $item['item_id']
                ]);
            }
    
            $this->conn->commit();
            error_log("addInstallmentItems completed successfully for installment $installmentId");
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("addInstallmentItems failed: " . $e->getMessage());
            return false;
        }
    }
}
?>