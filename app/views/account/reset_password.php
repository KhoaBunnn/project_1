<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);">
        <div class="card-body text-white">
            <h2 class="text-center mb-4 fw-bold"> Mật Khẩu mới</h2>
            <p class="text-center mb-4 text-white-75">Nhập mật khẩu mới lạ</p>

            <form action="resetpassword" method="post" novalidate>
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Nhập mật khẩu mới:</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label fw-semibold">Xác nhận mật khẩu mới:</label>
                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control form-control-lg" required autofocus>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Đổi mật khẩu
                    </button>

            </form>
        </div>
    </div>
</div>
</div>   

<?php include 'app/views/shares/footer.php'; ?>
