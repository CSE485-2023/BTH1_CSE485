<?php
            session_start();
require_once '../model/StoryModel.php';
require_once '../model/AuthorModel.php';
require_once '../model/CategoryModel.php';


$action = isset($_GET['action']) ? $_GET['action'] : 'list_story';

$controller = new StoryController();

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
    case 'list_story':
        $controller->listStories();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        break;
}
class StoryController {
    private $storyModel;
    private $authorModel;
    private $categoryModel;

    public function __construct() {
        $this->storyModel = new StoryModel();
        $this->authorModel = new AuthorModel();
        $this->categoryModel = new CategoryModel();
    }
    public function get() {
        $id = $_GET['id'];
            $story= $this->storyModel->get($id);
            $authors = $this->authorModel->listAuthors();
            $categories = $this->categoryModel->listCategories();
        $_GET['action'] = 'update';
        include '../views/story_form.php';
    }

    public function save() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tieude' => $_POST['txtTitle'],
                'ten_bhat' => $_POST['txtSongName'],
                'ma_tloai' => $_POST['category'],
                'tomtat' => $_POST['txtRecap'],
                'noidung' => $_POST['txtContent'],
                'ma_tgia' => $_POST['author'],
                'hinhanh' => $_POST['txtImage'],
            ];
            if(isset($_POST['txtStoryId'])) {
                $data['id'] = $_POST['txtStoryId'];
                $this->storyModel->update($data);

            }else {
            $this->storyModel->create($data);

            }
            $_SESSION['notify_story_successfully'] = "Story saved successfully.";
            header('Location: ?action=list_story');
            exit();
        } else {
            $authors = $this->authorModel->listAuthors();
            $categories = $this->categoryModel->listCategories();
            include '../views/story_form.php';
        }
    }

    public function listStories() {
        $stories = $this->storyModel->listStories();

        // Hiển thị danh sách người dùng
        include '../views/list_story.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->storyModel->deleteStory($id);


            $_SESSION['notify_story_deleted'] = "Story has been deleted successfully!";
        header('Location: ?action=list_story');
        exit();
    }
}