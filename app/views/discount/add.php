<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="card shadow-sm rounded p-4" style="border-color: #e67e22;">
        <h2 class="mb-4" style="color: #e67e22;">Thêm mã giảm giá</h2>
        <form method="POST" action="/Project1/Discount/store" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="code" class="form-label fw-semibold" style="color: #e67e22;">Mã giảm giá:</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="Nhập mã giảm giá" required>
                <div class="invalid-feedback">Vui lòng nhập mã giảm giá.</div>
            </div>

            <div class="mb-3">
                <label for="discount_percent" class="form-label fw-semibold" style="color: #e67e22;">Giảm giá (%)</label>
                <input type="number" id="discount_percent" name="discount_percent" min="0" max="100" value="10" class="form-control" required>
                <div class="invalid-feedback">Giá trị giảm giá phải từ 0 đến 100.</div>
            </div>

            <div class="mb-4">
                <label for="expiry_date" class="form-label fw-semibold" style="color: #e67e22;">Ngày hết hạn</label>
                <input type="date" id="expiry_date" name="expiry_date" class="form-control" required>
                <div class="invalid-feedback">Vui lòng chọn ngày hết hạn.</div>
            </div>

            <button type="submit" class="btn" style="background-color: #e67e22; color: white; transition: background-color 0.3s;">
                Lưu mã giảm giá
            </button>
            <a href="/Project1/Discount/list" class="btn btn-outline-secondary ms-3">Quay lại danh sách</a>
        </form>
    </div>
</div>

<script>
// Bootstrap 5 form validation example
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

<?php include 'app/views/shares/footer.php'; ?>
