<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);">
        <div class="card-body text-white">
            <h2 class="text-center mb-4 fw-bold">Đăng nhập</h2>
            <p class="text-center mb-4 text-white-75">Vui lòng nhập tên đăng nhập và mật khẩu của bạn</p>

            <form action="/Project1/account/checklogin" method="post" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Nhập tên đăng nhập" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Đăng nhập
                    </button>
                </div>

                <div class="text-center mb-3">
                <a href="/Project1/account/forgotpassword" class="text-white-75 small text-decoration-none">Quên mật khẩu?</a>
                </div>

                <p class="text-center mb-0 text-white-75">
                    Chưa có tài khoản? 
                    <a href="/Project1/account/register" class="text-white fw-semibold text-decoration-underline">Đăng ký ngay</a>
                </p>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
