<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm rounded-4 p-4">
        <h2 class="text-center mb-4 fw-bold" style="color: #e67e22;">Đăng ký tài khoản</h2>

        <?php if (isset($errors) && count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/Project1/account/save" method="post" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label fw-semibold">Họ và tên</label>
                <input type="text" class="form-control form-control-lg" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <div class="mb-4">
                <label for="confirmpassword" class="form-label fw-semibold">Xác nhận mật khẩu</label>
                <input type="password" class="form-control form-control-lg" id="confirmpassword" name="confirmpassword" placeholder="Nhập lại mật khẩu" required>
            </div>

            <div class="mb-4">
                <label for="confirmpassword" class="form-label fw-semibold">Sở thích cá nhân</label>
                <input type="text" name="hobby" class="form-control form-control-user" placeholder="Nhập sở thích của bạn" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg fw-bold">
                    <i class="bi bi-person-plus-fill me-2"></i> Đăng ký
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
