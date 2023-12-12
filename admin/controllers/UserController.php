<?php
            session_start();


require_once '../model/UserModel.php';

//
//require_once 'controllers/UserController.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'list_user';

// Tạo instance của UserController
$userController = new UserController();

// Điều hướng yêu cầu từ người dùng đến các phương thức tương ứng trong UserController
switch ($action) {
    case 'home':
        header('Location: index.php');
        exit();

    case 'update':
    case 'create':
        $userController->save();
        break;
    case 'pre_update':
        $userController->get();
        break;
    case 'list_user':
        $userController->listUsers();
        break;
    case 'delete':
        $userController->delete();
        break;
    // Các case khác cho các hành động khác như read, update, delete...
    default:
        // Xử lý khi yêu cầu không hợp lệ
        break;
}
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
    public function get() {
        $id = $_GET['id'];
        $user = $this->userModel->getUser($id);
        $_GET['action'] = 'update';
        include '../views/user_form.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ biểu mẫu tạo người dùng
            $userData = [
                'username' => $_POST['txtUName'],
                'password' => $_POST['txtUPass'],
                'fullname' => $_POST['txtFullName'],
                'birth' => $_POST['txtBirth'],
                'phone' => $_POST['txtPhone'],
                'address' => $_POST['txtAddress'],
                'email' => $_POST['txtEmail']
            ];
            if(isset($_POST['txtUserId'])) {
                $userData['id'] = $_POST['txtUserId'];
                $this->userModel->updateUser($userData);

            }else {
            $this->userModel->createUser($userData);

            }
            $_SESSION['notify_user_successfully'] = "User saved successfully.";
            // Chuyển hướng người dùng đến trang hiển thị danh sách người dùng
            header('Location: ?action=list_user');
            exit();
        } else {
            // Hiển thị biểu mẫu tạo người dùng
            include '../views/user_form.php';
        }
    }

    public function listUsers() {
        // Lấy danh sách người dùng từ UserModel
        $users = $this->userModel->listUsers();

        // Hiển thị danh sách người dùng
        include '../views/list_user.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->userModel->deleteUser($id);


            $_SESSION['notify_user_deleted'] = "User has been deleted successfully!";
        header('Location: ?action=list_user');
        exit();
    }
}