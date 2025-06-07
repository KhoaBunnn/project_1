<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);">
        <div class="card-body text-white">
            <h2 class="text-center mb-4 fw-bold">Sở Thích Của Bạn</h2>
            <p class="text-center mb-4 text-white-75">Hãy chia sẻ với chúng tôi điều bạn yêu thích</p>

            <form action="/Project1/account/checkhobby" method="post" novalidate>
                <div class="mb-3">
                    <label for="hobby" class="form-label fw-semibold">Nhập sở thích</label>
                    <input type="text" name="hobby" id="hobby" class="form-control form-control-lg" placeholder=" VD: Đọc sách, du lịch, âm nhạc, nấu ăn..." required autofocus>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Xác nhận
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>
