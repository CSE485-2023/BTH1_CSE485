<?php
            session_start();


require_once '../model/CategoryModel.php';


$action = isset($_GET['action']) ? $_GET['action'] : 'list_category';

$controller = new CategoryController();

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
    case 'list_category':
        $controller->listCategories();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        break;
}
class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new categoryModel();
    }
    public function get() {
        $id = $_GET['id'];
        $category = $this->categoryModel->get($id);
        $_GET['action'] = 'update';
        include '../views/category_form.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ biểu mẫu tạo người dùng
            $data = [
                'ten_tloai' => $_POST['txtCategoryName'],
            ];
            if(isset($_POST['txtCategoryId'])) {
                $data['id'] = $_POST['txtCategoryId'];
                $this->categoryModel->update($data);

            }else {
            $this->categoryModel->create($data);

            }
            $_SESSION['notify_category_successfully'] = "Category saved successfully.";
            header('Location: ?action=list_category');
            exit();
        } else {
            include '../views/category_form.php';
        }
    }

    public function listCategories() {
        $categories = $this->categoryModel->listCategories();

        include '../views/list_category.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->categoryModel->deleteCategory($id);


            $_SESSION['notify_category_deleted'] = "Category has been deleted successfully!";
        header('Location: ?action=list_category');
        exit();
    }
}