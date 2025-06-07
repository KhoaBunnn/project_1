<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center text-primary">Chỉnh sửa tài khoản</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="/Project1/account/update" method="post" class="shadow p-4 rounded bg-light">
        <input type="hidden" name="id" value="<?= $user->id ?>">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user->username) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($user->fullname) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sở thích</label>
            <input type="text" name="hobby" class="form-control" value="<?= htmlspecialchars($user->hobby) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-select">
                <option value="user" <?= $user->role === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="/Project1/account/listUsers" class="btn btn-secondary">Huỷ</a>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
