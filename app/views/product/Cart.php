<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">

    <h1 class="mb-4" style="color: #e67e22;">Giỏ hàng</h1>

    <?php if (!empty($cart)): ?>
        <ul class="list-group mb-3">
            <?php
            $total = 0;
            foreach ($cart as $id => $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <li class="list-group-item d-flex align-items-center" id="item-<?= $id ?>">
                    <?php if ($item['image']): ?>
                        <img src="/Project1/<?= $item['image'] ?>" alt="Product Image" class="me-3" style="max-width: 100px; border-radius: 8px;">
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <h5 class="mb-1"><?= htmlspecialchars($item['name']) ?></h5>
                        <p class="mb-1">Giá: <?= number_format($item['price']) ?> VND</p>
                        <p class="mb-1">Số lượng:
                            <button class="btn btn-sm btn-outline-danger me-1" onclick="updateQuantity(<?= $id ?>, 'decrease')">-</button>
                            <span id="qty-<?= $id ?>"><?= $item['quantity'] ?></span>
                            <button class="btn btn-sm btn-outline-success ms-1" onclick="updateQuantity(<?= $id ?>, 'increase')">+</button>
                        </p>
                        <p class="mb-0">Tạm tính: <span id="subtotal-<?= $id ?>"><?= number_format($subtotal) ?></span> VND</p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <p>Tổng tiền: <span id="total"><?= number_format($total) ?></span> VND</p>

        <?php 
        $discountPercent = isset($_SESSION['discount']) ? $_SESSION['discount']->discount_percent : 0;
        $discountAmount = $total * ($discountPercent / 100);
        $finalTotal = $total - $discountAmount;
        ?>

        <p id="discount-info" class="text-success fw-semibold">
            <?php if ($discountPercent > 0): ?>
                Đã áp dụng mã giảm giá: <?= htmlspecialchars($_SESSION['discount']->code) ?> - Giảm <?= $discountPercent ?>%
            <?php endif; ?>
        </p>

        <p>Giảm giá: <span id="discount"><?= number_format($discountAmount) ?></span> VND</p>
        <p>Thành tiền: <span id="final-total"><?= number_format($finalTotal) ?></span> VND</p>

        <div class="input-group mb-3" style="max-width: 400px;">
            <input type="text" id="discount_code" class="form-control" placeholder="Nhập mã giảm giá">
            <button class="btn btn-warning" onclick="applyDiscount()">Áp dụng</button>
        </div>

        <a href="/Project1/Product/checkout" class="btn btn-warning">Thanh toán</a>

    <?php else: ?>
        <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
    <?php endif; ?>

</div>

<script>
function updateQuantity(productId, action) {
    fetch('/Project1/Product/updateQuantityAjax', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&action=${action}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.removed) {
                document.getElementById('item-' + productId).remove();
            } else {
                document.getElementById('qty-' + productId).textContent = data.quantity;
                document.getElementById('subtotal-' + productId).textContent = new Intl.NumberFormat().format(data.subtotal);
            }

            document.getElementById('total').textContent = new Intl.NumberFormat().format(data.total);
            document.getElementById('discount').textContent = new Intl.NumberFormat().format(data.discount);
            document.getElementById('final-total').textContent = new Intl.NumberFormat().format(data.final_total);

            if (data.discount_percent > 0) {
                document.getElementById('discount-info').textContent = `Đã áp dụng mã giảm giá: ${data.code} - Giảm ${data.discount_percent}%`;
            } else {
                document.getElementById('discount-info').textContent = '';
            }

            if (document.querySelectorAll('.list-group-item').length === 0) {
                location.reload();
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
    });
}

function applyDiscount() {
    const code = document.getElementById('discount_code').value.trim();
    if (!code) {
        alert('Vui lòng nhập mã giảm giá');
        return;
    }

    fetch('/Project1/Product/applyDiscountAjax', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `discount_code=${encodeURIComponent(code)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Áp dụng mã giảm giá thành công!');
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
    });
}
</script>

<?php include 'app/views/shares/footer.php'; ?>
