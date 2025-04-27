<?php
class Invoice {
    private $conn;
    private $table = 'invoice';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllInvoice(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllInvoiceItems(){
        $query = "SELECT * FROM invoice_items";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addInvoice($subTotal, $taxAmount, $totalAmount, $cashReceived, $changeAmount) {
        $this->conn->beginTransaction();
        
        try {
            $query = "INSERT INTO " . $this->table . " (subtotal, tax_amount, total_amount, cash_received, change_amount) VALUES (:subtotal, :taxAmount, :totalAmount, :cashReceived, :changeAmount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':subtotal' => $subTotal, 
                ':taxAmount' => $taxAmount, 
                ':totalAmount' => $totalAmount, 
                ':cashReceived' => $cashReceived, 
                ':changeAmount' => $changeAmount
            ]);

            $invoiceId = $this->conn->lastInsertId();

            $this->conn->commit();
            
            error_log("addInvoice succeeded: invoiceId = $invoiceId");
            return $invoiceId;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("addInvoice failed: " . $e->getMessage());
            return false;
        }
    }

    public function addInvoiceItems($invoiceId, $items) {
        $this->conn->beginTransaction();
        
        try {

            error_log("addInvoiceItems called with invoiceId: $invoiceId, items: " . json_encode($items));
            
            if (empty($items)) {
                throw new Exception("No items provided for invoice $invoiceId");
            }

            foreach ($items as $item) {

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

                $query = "INSERT INTO invoice_items (invoice_id, item_id, quantity, unit_price, discount_percent, total_price, item_name) 
                          VALUES (:invoice_id, :item_id, :quantity, :unit_price, :discount_percent, :total_price, :item_name)";
                $stmt = $this->conn->prepare($query);
                $success = $stmt->execute([
                    ':invoice_id' => $invoiceId,
                    ':item_id' => $item['item_id'],
                    ':quantity' => $item['quantity'],
                    ':unit_price' => $item['unit_price'],
                    ':discount_percent' => $item['discount_percent'],
                    ':total_price' => $item['total_price'],
                    ':item_name' => $itemName
                ]);

                if (!$success) {
                    throw new Exception("Failed to insert item {$item['item_id']} into invoice_items");
                }

                $updateQuery = "UPDATE items SET quantity = quantity - :quantity WHERE item_id = :item_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->execute([
                    ':quantity' => $item['quantity'],
                    ':item_id' => $item['item_id']
                ]);
            }

            $this->conn->commit();
            error_log("addInvoiceItems completed successfully for invoice $invoiceId");
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("addInvoiceItems failed: " . $e->getMessage());
            return false;
        }
    }
}
?>