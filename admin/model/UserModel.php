<?php
require_once '../database/connect.php';
class UserModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function createUser($userData) {
        $sql = "INSERT INTO users(username, password, full_name, birth, phone, address, email) VALUES (:username, :password, :fullname, :birth, :phone, :address, :email)";
        $stmt = $this->conn->prepare($sql);
        $this->binding_user_data($stmt, $userData);
    }

    public function updateUser( $userData) {
            $sql = "UPDATE users SET username = :username, password = :password, full_name = :fullname, birth = :birth, phone = :phone, address = :address, email = :email WHERE id = :userId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':userId',$userData['id']);
            $this->binding_user_data($stmt, $userData);

    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function listUsers() {

        $sql = "SELECT * FROM Users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function deleteUser($userId) {
        $sql = "DELETE FROM Users WHERE id = $userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

    }

    /**
     * @param $sql
     * @param $userData
     * @return void
     */
    public function binding_user_data($stmt, $userData)
    {

        $password = $userData['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':username', $userData['username']);

        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':fullname', $userData['fullname']);
        $stmt->bindValue(':birth', $userData['birth']);
        $stmt->bindValue(':phone', $userData['phone']);
        $stmt->bindValue(':address', $userData['address']);
        $stmt->bindValue(':email', $userData['email']);
        $stmt->execute();
    }
}