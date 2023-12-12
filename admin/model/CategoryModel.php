<?php
require_once '../database/connect.php';
class CategoryModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function create($data) {
        $sql = "INSERT INTO theloai(ten_tloai) VALUES (:ten_tloai)";
        $stmt = $this->conn->prepare($sql);
        $this->binding_data($stmt, $data);
    }

    public function update( $data) {
            $sql = "UPDATE theloai SET  ten_tloai=:ten_tloai WHERE ma_tloai = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id',$data['id']);
            $this->binding_data($stmt, $data);

    }

    public function get($id) {
        $sql = "SELECT * FROM theloai WHERE ma_tloai=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function listCategories() {

        $sql = "SELECT * FROM theloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function deleteCategory($id) {

        // Check if the category is referenced by any articles
        $sqlCheck = "SELECT COUNT(*) FROM theloai JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai WHERE theloai.ma_tloai = $id";
        $stmt = $this->conn->prepare($sqlCheck);
        $stmt->execute();
        $rowCount = $stmt->fetchColumn();

        if ($rowCount > 0) {
            session_start();
            $_SESSION['notify_category_violation'] = "Category has been referenced by some stories, so you cannot delete it.";
            header('Location: ../controllers/CategoryController.php');
            exit();
        }

        $sql = "DELETE from theloai WHERE ma_tloai = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        session_start();
        $_SESSION['notify_category_successfully'] = "Category saved successfully.";
        header("Location: ../controllers/CategoryController.php");
        exit();

    }

    public function binding_data($stmt, $data)
    {
        $stmt->bindValue(':ten_tloai', $data['ten_tloai']);
        $stmt->execute();
    }
}