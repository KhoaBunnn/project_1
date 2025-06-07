<?php
class DiscountModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM discount_codes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByCode($code) {
        $stmt = $this->conn->prepare("SELECT * FROM discount_codes WHERE code = :code AND expiry_date >= CURDATE()");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function add($code, $discount_percent, $expiry_date) {
        $stmt = $this->conn->prepare("INSERT INTO discount_codes (code, discount_percent, expiry_date) VALUES (?, ?, ?)");
        return $stmt->execute([$code, $discount_percent, $expiry_date]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM discount_codes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM discount_codes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($id, $code, $discount_percent, $expiry_date) {
        $stmt = $this->conn->prepare("UPDATE discount_codes SET code = ?, discount_percent = ?, expiry_date = ? WHERE id = ?");
        return $stmt->execute([$code, $discount_percent, $expiry_date, $id]);
    }
    public function search($code = '', $discount_percent = '', $expiry_date = '') {
        $sql = "SELECT * FROM discount_codes WHERE 1=1";
        $params = [];
    
        if (!empty($code)) {
            $sql .= " AND code LIKE ?";
            $params[] = '%' . $code . '%';
        }
        if ($discount_percent !== '') {
            $sql .= " AND discount_percent = ?";
            $params[] = $discount_percent;
        }
        if (!empty($expiry_date)) {
            $sql .= " AND expiry_date <= ?";
            $params[] = $expiry_date;
        }
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
}
?>
