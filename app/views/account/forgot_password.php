<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);">
        <div class="card-body text-white">
            <h2 class="text-center mb-4 fw-bold"> Quên Mật Khẩu</h2>
            <p class="text-center mb-4 text-white-75">Nhập tên đăng nhập để khôi phục mật khẩu của bạn</p>

            <form action="forgotpassword" method="post" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Nhập username</label>
                    <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder=" Nhập tên đăng nhập của bạn" required autofocus>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Tiếp tục
                    </button>
                <div class="back-link">
                  <a href="/Project1/account/login">
                <i class="fas fa-arrow-left me-1"></i>Quay lại đăng nhập
            </a>    
                </div>
            </form>
        </div>
    </div>
</div>
</div>      


<?php include 'app/views/shares/footer.php'; ?>
