<?php
require_once 'app/config/database.php';

require_once 'app/models/DiscountModel.php';

class DiscountController
{
    private $discountModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->discountModel = new DiscountModel($this->db);
    }

    // Hiển thị danh sách mã giảm giá
    public function list()
    {
        $code = isset($_GET['code']) ? trim($_GET['code']) : '';
        $discount_percent = isset($_GET['discount_percent']) ? trim($_GET['discount_percent']) : '';
        $expiry_date = isset($_GET['expiry_date']) ? trim($_GET['expiry_date']) : '';
    
        if ($code || $discount_percent || $expiry_date) {
            $discounts = $this->discountModel->search($code, $discount_percent, $expiry_date);
        } else {
            $discounts = $this->discountModel->getAll();
        }
        include 'app/views/discount/list.php';
    }

    // Hiển thị form thêm mới
    public function add()
    {
        include 'app/views/discount/add.php';
    }

    // Xử lý lưu mã giảm giá mới
    public function store()
    {
        $code = $_POST['code'];
        $discount_percent = $_POST['discount_percent'];
        $expiry_date = $_POST['expiry_date'];

        $this->discountModel->add($code, $discount_percent, $expiry_date);
        header("Location: /Project1/Discount/list");
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $discount = $this->discountModel->getById($id);
        include 'app/views/discount/edit.php';
    }

    // Xử lý cập nhật mã giảm giá
    public function update($id)
    {
        $code = $_POST['code'];
        $discount_percent = $_POST['discount_percent'];
        $expiry_date = $_POST['expiry_date'];

        $this->discountModel->update($id, $code, $discount_percent, $expiry_date);
        header("Location: /Project1/Discount/list");
    }

    // Xóa mã giảm giá
    public function delete($id)
    {
        $this->discountModel->delete($id);
        header("Location: /Project1/Discount/list");
    }
    
}
?>
