<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once 'app/models/DiscountModel.php';

class ProductController
{
private $productModel;
private $db;
private $discountModel;

public function __construct()
{
$this->db = (new Database())->getConnection();
$this->productModel = new ProductModel($this->db);
$this->discountModel = new DiscountModel($this->db);

}
public function index()
{
$products = $this->productModel->getProducts();
include 'app/views/product/list.php';
}
public function show($id)
{
$product = $this->productModel->getProductById($id);
if ($product) {
include 'app/views/product/show.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function add()
{
$categories = (new CategoryModel($this->db))->getCategories();
include_once 'app/views/product/add.php';
}
public function save()
{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$category_id = $_POST['category_id'] ?? null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = "";
}
$result = $this->productModel->addProduct($name, $description, $price,
$category_id, $image);
if (is_array($result)) {
$errors = $result;
$categories = (new CategoryModel($this->db))->getCategories();
include 'app/views/product/add.php';
} else { 
    header('Location: /Project1/Product');
}
}
}
public function edit($id)
{
$product = $this->productModel->getProductById($id);
$categories = (new CategoryModel($this->db))->getCategories();
if ($product) {
include 'app/views/product/edit.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function update()
{
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = $_POST['existing_image'];
}
$edit = $this->productModel->updateProduct($id, $name, $description,
$price, $category_id, $image);
if ($edit) {
header('Location: /Project1/Product');
} else {
echo "Đã xảy ra lỗi khi lưu sản phẩm.";
}
}
}
public function delete($id)
{
if ($this->productModel->deleteProduct($id)) {
header('Location: /Project1/Product');
} else {
    echo "Đã xảy ra lỗi khi xóa sản phẩm.";
}
}

public function removeFromCart($id)
{
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    // Sau khi xóa, chuyển về trang giỏ hàng
    header('Location: /Project1/Product/cart');
    exit;
}

private function uploadImage($file)
{
$target_dir = "uploads/";
// Kiểm tra và tạo thư mục nếu chưa tồn tại
if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($file["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Kiểm tra xem file có phải là hình ảnh không
$check = getimagesize($file["tmp_name"]);
if ($check === false) {
throw new Exception("File không phải là hình ảnh.");
}
// Kiểm tra kích thước file (10 MB = 10 * 1024 * 1024 bytes)
if ($file["size"] > 10 * 1024 * 1024) {
throw new Exception("Hình ảnh có kích thước quá lớn.");
}
// Chỉ cho phép một số định dạng hình ảnh nhất định
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=
"jpeg" && $imageFileType != "gif") {
throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
}
// Lưu file
if (!move_uploaded_file($file["tmp_name"], $target_file)) {
throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
}
return $target_file;
}
public function addToCart($id)
{
    $product = $this->productModel->getProductById($id);
    if (!$product) {
        echo "Không tìm thấy sản phẩm.";
        return;
    }
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image
        ];
    }
    header('Location: /Project1/Product/cart');
    exit;
}

    public function cart()
    {
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    include 'app/views/product/cart.php';
    }
    
    public function checkout()
    {
        $discountMessage = '';
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
        // Tính tổng tiền ban đầu
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    
        // Kiểm tra nếu có mã giảm giá POST lên
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['discount_code'])) {
                $code = trim($_POST['discount_code']);
                $discount = $this->discountModel->getByCode($code);
    
                if ($discount && strtotime($discount->expiry_date) >= time()) {
                    $_SESSION['discount'] = $discount;
                    $discountMessage = "Đã áp dụng mã giảm giá: " . $discount->code;
                } else {
                    unset($_SESSION['discount']);
                    $discountMessage = "Mã giảm giá không hợp lệ hoặc đã hết hạn.";
                }
            }
    
            if (isset($_POST['place_order'])) {
                // Xử lý đặt hàng...
    
                unset($_SESSION['cart']);
                unset($_SESSION['discount']);
    
                header('Location: /Project1/Product/orderSuccess');
                exit;
            }
        }
    
        // Tính toán giảm giá nếu có
        $discountAmount = 0;
        if (isset($_SESSION['discount'])) {
            $discount = $_SESSION['discount'];
            $discountAmount = $total * ($discount->discount_percent / 100);
        }
    
        $finalTotal = $total - $discountAmount;
    
        include 'app/views/product/checkout.php';
    }
    
    
    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
    
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }
    
            $this->db->beginTransaction();
            try {
                // Thêm đơn hàng
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();
    
                // Thêm chi tiết đơn hàng
                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price)
                              VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }
    
                // Ghi nhận nếu có mã giảm giá (tùy chọn: có thể lưu vào bảng riêng)
                unset($_SESSION['cart']);
                unset($_SESSION['discount']); // Xóa mã sau khi dùng
    
                $this->db->commit();
                header('Location: /Project1/Product/orderConfirmation');
            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    public function orderList()
    {
        $orders = $this->productModel->getAllOrders();
        $orderDetails = [];
    
        foreach ($orders as $order) {
            $orderDetails[$order->id] = $this->productModel->getOrderDetailsByOrderId($order->id);
        }
    
        include 'app/views/product/order_list.php';
    }
    

    public function updateQuantityAjax()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productId = $_POST['product_id'];
        $action = $_POST['action'];

        if (!isset($_SESSION['cart'][$productId])) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng']);
            return;
        }

        // Cập nhật số lượng
        if ($action === 'increase') {
            $_SESSION['cart'][$productId]['quantity']++;
        } elseif ($action === 'decrease') {
            if ($_SESSION['cart'][$productId]['quantity'] > 1) {
                $_SESSION['cart'][$productId]['quantity']--;
            } else {
                unset($_SESSION['cart'][$productId]);
                // Sau khi xóa sản phẩm thì tính lại tổng và giảm giá
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                $discountPercent = isset($_SESSION['discount']) ? $_SESSION['discount']->discount_percent : 0;
                $discountAmount = $total * ($discountPercent / 100);
                $finalTotal = $total - $discountAmount;

                echo json_encode([
                    'success' => true,
                    'removed' => true,
                    'total' => $total,
                    'discount' => $discountAmount,
                    'final_total' => $finalTotal,
                    'discount_percent' => $discountPercent,
                    'code' => isset($_SESSION['discount']) ? $_SESSION['discount']->code : ''
                ]);
                return;
            }
        }

        // Tính toán lại các giá trị
        $quantity = $_SESSION['cart'][$productId]['quantity'];
        $subtotal = $_SESSION['cart'][$productId]['price'] * $quantity;

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $discountPercent = isset($_SESSION['discount']) ? $_SESSION['discount']->discount_percent : 0;
        $discountAmount = $total * ($discountPercent / 100);
        $finalTotal = $total - $discountAmount;

        echo json_encode([
            'success' => true,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'total' => $total,
            'discount' => $discountAmount,
            'final_total' => $finalTotal,
            'discount_percent' => $discountPercent,
            'code' => isset($_SESSION['discount']) ? $_SESSION['discount']->code : ''
        ]);
    }
}

public function applyDiscountAjax()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['discount_code'])) {
        $code = trim($_POST['discount_code']);
        $discount = $this->discountModel->getByCode($code);

        // Tính tổng giỏ hàng
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($discount && strtotime($discount->expiry_date) >= time()) {
            $_SESSION['discount'] = $discount;
            $discountAmount = $total * ($discount->discount_percent / 100);
            $finalTotal = $total - $discountAmount;

            echo json_encode([
                'success' => true,
                'code' => $discount->code,
                'discount_percent' => $discount->discount_percent,
                'discount_amount' => $discountAmount,
                'total' => $total,
                'final_total' => $finalTotal
            ]);
        } else {
            unset($_SESSION['discount']);
            echo json_encode([
                'success' => false,
                'message' => 'Mã không hợp lệ hoặc hết hạn.',
                'total' => $total
            ]);
        }
    }
}

public function orderConfirmation()
{
include 'app/views/product/Confirmation.php';
}


}
?>