<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">

    <h2 class="mb-4" style="color: #e67e22;">Lịch sử đơn hàng</h2>

    <?php if (empty($orders)) : ?>
        <div class="alert alert-info">Chưa có đơn hàng nào.</div>
    <?php else : ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5>Đơn hàng #<?= $order->id ?> - <?= htmlspecialchars($order->name) ?> - <?= $order->phone ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order->address) ?></p>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-warning">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetails[$order->id] as $item): ?>
                                    <tr>
                                        <td><img src="/Project1/<?= $item->image ?>" width="60" class="img-thumbnail" /></td>
                                        <td><?= htmlspecialchars($item->name) ?></td>
                                        <td><?= $item->quantity ?></td>
                                        <td><?= number_format($item->price) ?>đ</td>
                                        <td><?= number_format($item->quantity * $item->price) ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
<?php include 'app/views/shares/footer.php'; ?>
