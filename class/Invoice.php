<?php
    class Invoice{
        private $conn;
        private $table = "invoice";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addInvoice($subTotal, $taxAmount, $totalAmount, $cashReceived, $changeAmount){
            $this->conn->beginTransaction();
            
            try {
                $query = "INSERT INTO " . $this->table . " (subtotal, tax_amount, total_amount, cash_received, change_amount) VALUES (:subtotal, :taxAmount, :totalAmount, :cashReceived, :changeAmount)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([
                    ":subtotal" => $subTotal, 
                    ":taxAmount" => $taxAmount, 
                    ":totalAmount" => $totalAmount, 
                    ":cashReceived" => $cashReceived, 
                    ":changeAmount" => $changeAmount
                ]);

                $invoiceId = $this->conn->lastInsertId();

                $this->conn->commit();
                
                return $invoiceId;
            } catch (Exception $e) {
                $this->conn->rollBack();
                return false;
            }
        }
        
        public function addInvoiceItems($invoiceId, $items) {
            $this->conn->beginTransaction();
            
            try {
                foreach ($items as $item) {
                    $query = "INSERT INTO invoice_items (invoice_id, item_id, quantity, unit_price, discount_percent, total_price) 
                              VALUES (:invoice_id, :item_id, :quantity, :unit_price, :discount_percent, :total_price)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->execute([
                        ":invoice_id" => $invoiceId,
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