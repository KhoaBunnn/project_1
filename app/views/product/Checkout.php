<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">

    <h1 class="mb-4" style="color: #e67e22;">Thanh toán</h1>

    <?php if (!empty($cart)): ?>
        <form method="POST" action="/Project1/Product/processCheckout" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Họ tên:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Địa chỉ:</label>
                <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
            </div>

            <?php
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $discountAmount = 0;
            if (isset($_SESSION['discount'])) {
                $discount = $_SESSION['discount'];
                $discountAmount = $total * ($discount->discount_percent / 100);
                echo "<p>Mã giảm giá: <strong>{$discount->code}</strong> - Giảm {$discount->discount_percent}%</p>";
            }
            ?>
            <p><strong>Tổng tiền:</strong> <?php echo number_format($total); ?> VND</p>
            <p><strong>Giảm giá:</strong> <?php echo number_format($discountAmount); ?> VND</p>
            <p><strong>Thành tiền:</strong> <?php echo number_format($total - $discountAmount); ?> VND</p>

            <button type="submit" class="btn btn-warning mt-3">Thanh toán</button>
        </form>

        <a href="/Project1/Product/cart" class="btn btn-outline-secondary mt-3">Quay lại giỏ hàng</a>
    <?php else: ?>
        <div class="alert alert-info">Giỏ hàng trống.</div>
    <?php endif; ?>

</div>
<?php include 'app/views/shares/footer.php'; ?>
