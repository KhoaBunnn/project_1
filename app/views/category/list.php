<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <h1>Danh sách danh mục</h1>
    <a href="/Project1/category/add" class="btn btn-success mb-3">Thêm danh mục mới</a>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-warning">
            <tr>
                <th style="width: 10%;">ID</th>
                <th>Tên danh mục</th>
                <th style="width: 20%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= htmlspecialchars($category->id) ?></td>
                <td><?= htmlspecialchars($category->name) ?></td>
                <td>
                    <a href="/Project1/category/edit/<?= htmlspecialchars($category->id) ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/Project1/category/delete/<?= htmlspecialchars($category->id) ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'app/views/shares/footer.php'; ?>
