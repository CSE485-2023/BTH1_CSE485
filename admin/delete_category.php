<?php require_once "../common/connect.php";
$conn = connectDB();
    if(isset($_GET['id'])) {
        $catId = $_GET['id'];
        // Check if the category is referenced by any articles
        $sqlCheck = "SELECT COUNT(*) FROM theloai JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai WHERE theloai.ma_tloai = $catId";
        $stmt = $conn->prepare($sqlCheck);
        $stmt->execute();
        $rowCount = $stmt->fetchColumn();

        if ($rowCount > 0) {
            session_start();
            $_SESSION['notify_category_violation'] = "Category has been referenced by some stories, so you cannot delete it.";
            header('Location: category.php');
            exit();
        }

        $sql = "DELETE from theloai WHERE ma_tloai = $catId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        session_start();
        $_SESSION['notify_category_successfully'] = "Category saved successfully.";
        header("Location: category.php");
        exit();

    }

?>
