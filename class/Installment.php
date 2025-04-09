<?php
    class Installment {
        private $conn;
        private $table = "installment";
    
        public function __construct($db){
            $this->conn = $db;
        }
    
        public function addInstallment($subTotal, $taxAmount, $totalAmount, $downpayment, $monthlyPayment, $interest, $monthlyAmount){
            $this->conn->beginTransaction(); // Start transaction
            
            try {
                $query = "INSERT INTO " . $this->table . " (subtotal, tax_amount, total_amount, downpayment, monthly_payment, interest, monthly_amount) VALUES (:subtotal, :tax_amount, :total_amount, :downpayment, :monthly_payment, :interest, :monthly_amount)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([
                    ":subtotal" => $subTotal, 
                    ":tax_amount" => $taxAmount, 
                    ":total_amount" => $totalAmount, 
                    ":downpayment" => $downpayment, 
                    ":monthly_payment" => $monthlyPayment, 
                    ":interest" => $interest, 
                    ":monthly_amount" => $monthlyAmount
                ]);
    
                $installmentId = $this->conn->lastInsertId();
                $this->conn->commit();
                
                return $installmentId;
            } catch (Exception $e) {
                $this->conn->rollBack();
                return false;
            }
        }
    
        public function addInstallmentItems($installmentId, $items) {
            $this->conn->beginTransaction();
            
            try {
                foreach ($items as $item) {
                    $query = "INSERT INTO installment_items 
                             (installment_id, item_id, quantity, unit_price, discount_percent, total_price) 
                              VALUES (:installment_id, :item_id, :quantity, :unit_price, :discount_percent, :total_price)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->execute([
                        ":installment_id" => $installmentId,
                        ":item_id" => $item['item_id'],
                        ":quantity" => $item['quantity'],
                        ":unit_price" => $item['unit_price'],
                        ":discount_percent" => $item['discount_percent'],
                        ":total_price" => $item['total_price']
                    ]);
    
                    $updateQuery = "UPDATE items SET quantity = quantity - :quantity WHERE item_id = :item_id";
                    $updateStmt = $this->conn->prepare($updateQuery);
                    $updateStmt->execute([
                        ":quantity" => $item['quantity'],
                        ":item_id" => $item['item_id']
                    ]);
                }
        
                $this->conn->commit();
                return true;
            } catch (Exception $e) {
                $this->conn->rollBack();
                return false;
            }
        }
    }
?>