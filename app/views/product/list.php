<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4" style="color: #e67e22;">Danh Sách Món Ăn</h1>
    <div class="text-end mb-3">
        <a href="/Project1/Product/add" class="btn btn-success">Thêm món ăn mới</a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if ($product->image): ?>
                        <img src="/Project1/<?php echo $product->image; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Chưa có hình ảnh</span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/Project1/Product/show/<?php echo $product->id; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text fw-bold">Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
                        <p class="card-text">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex justify-content-between">
                            <a href="/Project1/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
                            <a href="/Project1/Product/show/<?php echo $product->id; ?>" class="btn btn-info">Chi tiết</a>
                            <a href="/Project1/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này?');">Xóa</a>
                            <a href="/Project1/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success bi bi-cart "></a> 

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>