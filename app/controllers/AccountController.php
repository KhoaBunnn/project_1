<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    function register(){
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    function save(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $hobby = $_POST['hobby'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];

            // Validate dữ liệu
            if(empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if(empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if(empty($hobby)) $errors['hobby'] = "Vui lòng nhập sở thích!";
            if(empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận mật khẩu không khớp!";

            // Kiểm tra username đã tồn tại chưa
            $account = $this->accountModel->getAccountByUsername($username);
            if($account){
                $errors['account'] = "Tài khoản đã tồn tại!";
            }

            if(count($errors) > 0){
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password, $hobby);
                if($result){
                    header('Location: /Project1/account/login');
                    exit();
                }
            }
        }
    }

    function forgotPassword(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'] ?? '';

            if(empty($username)){
                $error = "Vui lòng nhập username!";
                include 'app/views/account/forgot_password.php';
                return;
            }

            $account = $this->accountModel->getAccountByUsername($username);
            if(!$account){
                $error = "Không tìm thấy tài khoản!";
                include 'app/views/account/forgot_password.php';
                return;
            }

            // Kiểm tra session đã bắt đầu chưa rồi mới start
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['reset_username'] = $username;

            // Chuyển sang form nhập hobby
            include 'app/views/account/enter_hobby.php';
        } else {
            include 'app/views/account/forgot_password.php';
        }
    }

    function checkHobby(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['reset_username'])){
            header('Location: /Project1/account/forgotpassword');
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $hobbyInput = $_POST['hobby'] ?? '';
            $username = $_SESSION['reset_username'];

            $account = $this->accountModel->getAccountByUsername($username);

            if(strtolower(trim($account->hobby)) === strtolower(trim($hobbyInput))){
                // Sở thích đúng, cho phép đổi mật khẩu
                include 'app/views/account/reset_password.php';
            } else {
                $error = "Sở thích không đúng!";
                include 'app/views/account/enter_hobby.php';
            }
        }
    }

    function resetPassword(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['reset_username'])){
            header('Location: /Project1/account/forgotpassword');
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';

            if(empty($password) || empty($confirmPassword)){
                $error = "Vui lòng nhập đầy đủ mật khẩu.";
                include 'app/views/account/reset_password.php';
                return;
            }

            if($password !== $confirmPassword){
                $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
                include 'app/views/account/reset_password.php';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $username = $_SESSION['reset_username'];

            $result = $this->accountModel->updatePassword($username, $hashedPassword);

            if($result){
                unset($_SESSION['reset_username']);
                header('Location: /Project1/account/login');
                exit();
            } else {
                $error = "Có lỗi xảy ra khi cập nhật mật khẩu.";
                include 'app/views/account/reset_password.php';
            }
        }
    }

    function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /Project1/product');
    }
    public function listUsers() {
        $users = $this->accountModel->getAllUsers();
        include 'app/views/account/list_users.php';
    }
    
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->accountModel->deleteUserById($id);
        }
        header('Location: /Project1/account/listUsers');
        exit();
    }
    
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /Project1/account/listUsers');
            exit();
        }
    
        $user = $this->accountModel->getUserById($id);
        if (!$user) {
            $message = "Không tìm thấy người dùng.";
            include 'app/views/account/list_users.php';
            return;
        }
    
        include 'app/views/account/edit.php';
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $fullname = $_POST['fullname'] ?? '';
            $hobby = $_POST['hobby'] ?? '';
            $role = $_POST['role'] ?? '';
    
            if (!$id || empty($fullname) || empty($hobby) || empty($role)) {
                $error = "Vui lòng nhập đầy đủ thông tin.";
                $user = $this->accountModel->getUserById($id);
                include 'app/views/account/edit.php';
                return;
            }
    
            $this->accountModel->updateUser($id, $fullname, $hobby, $role);
            $message = "Cập nhật tài khoản thành công!";
            $users = $this->accountModel->getAllUsers();
            include 'app/views/account/list_users.php';
        }
    }
    
    public function checkLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->accountModel->getAccountByUserName($username);

            if ($account) {
                $pwd_hashed = $account->password;

                // Kiểm tra mật khẩu
                if (password_verify($password, $pwd_hashed)) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    // $_SESSION['user_id'] = $account->id;
                    // $_SESSION['user_role'] = $account->role;
                    $_SESSION['username'] = $account->username;

                    header('Location: /Project1/product');
                    exit;
                } else {
                    echo "Password incorrect.";
                }
            } else {
                echo "Bao loi khong tim thay tai khoan";
            }
        }
    }
}