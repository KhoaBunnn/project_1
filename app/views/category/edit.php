<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <h1>Sửa danh mục</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/Project1/category/edit/<?= htmlspecialchars($category->id) ?>" onsubmit="return validateCategoryForm();">
        <div class="form-group mb-3">
            <label for="name">Tên danh mục:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($category->name) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="/Project1/category/list" class="btn btn-secondary ms-2">Quay lại</a>
    </form>
</div>

<script>
function validateCategoryForm() {
    let name = document.getElementById('name').value.trim();
    if (name.length === 0) {
        alert('Vui lòng nhập tên danh mục');
        return false;
    }
    return true;
}
</script>

<?php include 'app/views/shares/footer.php'; ?>
