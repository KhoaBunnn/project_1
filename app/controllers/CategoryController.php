<?php
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($db);
    }

    public function list() {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function add() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $errors[] = 'Vui lòng nhập tên danh mục.';
            }

            if (empty($errors)) {
                if ($this->categoryModel->addCategory($name)) {
                    header('Location: /Project1/category/list');
                    exit;
                } else {
                    $errors[] = 'Lỗi khi thêm danh mục.';
                }
            }
        }
        include 'app/views/category/add.php';
    }

    public function edit($id = null) {
        if (!$id) {
            header('Location: /Project1/category/list');
            exit;
        }

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            echo "Danh mục không tồn tại.";
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $errors[] = 'Vui lòng nhập tên danh mục.';
            }

            if (empty($errors)) {
                if ($this->categoryModel->updateCategory($id, $name)) {
                    header('Location: /Project1/category/list');
                    exit;
                } else {
                    $errors[] = 'Lỗi khi cập nhật danh mục.';
                }
            }
        }

        include 'app/views/category/edit.php';
    }

    public function delete($id = null) {
        if (!$id) {
            header('Location: /Project1/category/list');
            exit;
        }

        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /Project1/category/list');
            exit;
        } else {
            echo "Lỗi khi xóa danh mục.";
        }
    }
}
