<?php
require_once '../database/connect.php';
class StoryModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function create($data) {
        $sql = "INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,hinhanh) VALUES (:tieude,:ten_bhat,:ma_tloai,:tomtat,:noidung,:ma_tgia,:hinhanh)";
        $stmt = $this->conn->prepare($sql);
        $this->binding_data($stmt, $data);
    }

    public function update( $data) {
            $sql = "UPDATE baiviet SET  tieude = :tieude, ten_bhat = :ten_bhat,ma_tloai = :ma_tloai,tomtat=:tomtat,noidung=:noidung,ma_tgia=:ma_tgia,hinhanh=:hinhanh WHERE ma_bviet = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id',$data['id']);
            $this->binding_data($stmt, $data);

    }

    public function get($id) {
        $sql = "SELECT * FROM baiviet WHERE ma_bviet=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function listStories() {

        $sql = "SELECT * FROM baiviet";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function deleteStory($id) {
        $sql = "DELETE FROM baiviet WHERE ma_bviet = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

    }

    public function binding_data($stmt, $data)
    {
        $stmt->bindValue(':tieude', $data['tieude']);
        $stmt->bindValue(':ten_bhat', $data['ten_bhat']);
        $stmt->bindValue(':ma_tloai', $data['ma_tloai']);
        $stmt->bindValue(':tomtat', $data['tomtat']);
        $stmt->bindValue(':noidung', $data['noidung']);
        $stmt->bindValue(':ma_tgia', $data['ma_tgia']);
        $stmt->bindValue(':hinhanh', $data['hinhanh']);
        $stmt->execute();
    }
}