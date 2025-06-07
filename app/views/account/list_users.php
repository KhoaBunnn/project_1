<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <h1 class="mb-4 text-center text-uppercase text-warning">Danh sách tài khoản</h1>
    <a href="/Project1/account/register" class="btn btn-success mb-3">Thêm tài khoản mới</a>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped table-hover shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 15%;">Username</th>
                <th>Họ tên</th>
                <th style="width: 10%;">Vai trò</th>
                <th>Sở thích</th>
                <th style="width: 20%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= htmlspecialchars($user->username) ?></td>
                        <td><?= htmlspecialchars($user->fullname) ?></td>
                        <td><?= htmlspecialchars($user->role) ?></td>
                        <td><?= htmlspecialchars($user->hobby) ?></td>
                        <td>
                            <a href="/Project1/account/edit?id=<?= $user->id ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/Project1/account/delete?id=<?= $user->id ?>"
                               onclick="return confirm('Xác nhận xóa tài khoản này?');"
                               class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Không có tài khoản nào.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>

    <a href="/Project1/product" class="btn btn-secondary">Quay lại trang sản phẩm</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>
