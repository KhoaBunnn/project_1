<?php
class AccountModel
{
private $conn;
private $table_name = "account";
public function __construct($db)
{
$this->conn = $db;
}
public function getAccountByUsername($username)
{
$query = "SELECT * FROM account WHERE username = :username";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_OBJ);
return $result;
}
function save($username, $name, $password, $hobby, $role="user"){
    $query = "INSERT INTO " . $this->table_name . " (username, fullname, password, role, hobby)
              VALUES (:username, :fullname, :password, :role, :hobby)";
    $stmt = $this->conn->prepare($query);

    // Làm sạch dữ liệu
    $name = htmlspecialchars(strip_tags($name));
    $username = htmlspecialchars(strip_tags($username));
    $hobby = htmlspecialchars(strip_tags($hobby));

    // Bind dữ liệu
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':fullname', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':hobby', $hobby);

    return $stmt->execute();
}
function updatePassword($username, $hashedPassword){
    $query = "UPDATE " . $this->table_name . " SET password = :password WHERE username = :username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':username', $username);
    return $stmt->execute();
}
public function getIdByUsername($username){
    $query = "SELECT id FROM account WHERE username = :username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result ? $result->id : null;
}
public function getAllUsers() {
    $query = "SELECT id, username, fullname, role, hobby FROM " . $this->table_name . " ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public function deleteUserById($id){
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

public function getUserById($id) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}

public function updateUser($id, $fullname, $hobby, $role) {
    $query = "UPDATE " . $this->table_name . " 
              SET fullname = :fullname, hobby = :hobby, role = :role 
              WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':hobby', $hobby);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

}