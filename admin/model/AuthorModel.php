<?php
require_once '../database/connect.php';
class AuthorModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function create($data) {
        $sql = "INSERT INTO tacgia(ten_tgia,hinh_tgia) VALUES (:ten_tgia,:hinh_tgia)";
        $stmt = $this->conn->prepare($sql);
        $this->binding_data($stmt, $data);
    }

    public function update( $data) {
            $sql = "UPDATE tacgia SET  ten_tgia = :ten_tgia, hinh_tgia = :hinh_tgia WHERE ma_tgia = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id',$data['id']);
            $this->binding_data($stmt, $data);

    }

    public function get($id) {
        $sql = "SELECT * FROM tacgia WHERE ma_tgia=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function listAuthors() {

        $sql = "SELECT * FROM tacgia";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function deleteAuthor($id) {
        $sql = "DELETE FROM tacgia WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

    }

    public function binding_data($stmt, $data)
    {
        $stmt->bindValue(':ten_tgia', $data['ten_tgia']);
        $stmt->bindValue(':hinh_tgia', $data['hinh_tgia']);
        $stmt->execute();
    }
}