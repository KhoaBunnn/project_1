<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4" style="color: #e67e22;">Thêm Món Ăn Mới</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm p-4">
        <form method="POST" action="/Project1/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Tên món ăn:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên món ăn" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Mô tả món ăn" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label fw-bold">Giá (VND):</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" placeholder="Nhập giá món ăn" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label fw-bold">Danh mục:</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>">
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Hình ảnh món ăn:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success me-md-2">Thêm món ăn</button>
                <a href="/Project1/Product/list" class="btn btn-outline-secondary">Quay lại danh sách</a>
            </div>
        </form>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>