<?php
            session_start();


require_once '../model/AuthorModel.php';


$action = isset($_GET['action']) ? $_GET['action'] : 'list_author';

$controller = new AuthorController();

switch ($action) {
    case 'home':
        header('Location: index.php');
        exit();

    case 'update':
    case 'create':
    $controller->save();
        break;
    case 'pre_update':
        $controller->get();
        break;
    case 'list_author':
        $controller->listAuthors();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        break;
}
class AuthorController {
    private $authorModel;

    public function __construct() {
        $this->authorModel = new AuthorModel();
    }
    public function get() {
        $id = $_GET['id'];
        $author = $this->authorModel->get($id);
        $_GET['action'] = 'update';
        include '../views/author_form.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ biểu mẫu tạo người dùng
            $data = [
                'ten_tgia' => $_POST['txtTenTacgia'],
                'hinh_tgia' => $_POST['txtHinhTacgia'],
            ];
            if(isset($_POST['txtAuthorId'])) {
                $data['id'] = $_POST['txtAuthorId'];
                $this->authorModel->update($data);

            }else {
            $this->authorModel->create($data);

            }
            $_SESSION['notify_author_successfully'] = "Author saved successfully.";
            // Chuyển hướng người dùng đến trang hiển thị danh sách người dùng
            header('Location: ?action=list_author');
            exit();
        } else {
            include '../views/author_form.php';
        }
    }

    public function listAuthors() {
        $authors = $this->authorModel->listAuthors();

        // Hiển thị danh sách người dùng
        include '../views/list_author.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->authorModel->deleteAuthor($id);


            $_SESSION['notify_author_deleted'] = "Author has been deleted successfully!";
        header('Location: ?action=list_author');
        exit();
    }
}