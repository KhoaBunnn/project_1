 <footer class="text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <!-- Cột thông tin liên hệ -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <h5 class="text-uppercase">Khoa Bun</h5>
                    <p>
                        Hệ thống quản lý món ăn giúp bạn dễ dàng theo dõi và cập nhật thực đơn.
                    </p>
                </div>
                <!-- Cột liên kết nhanh -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase">Liên kết nhanh</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="/Project1/Product/" class="text-decoration-none">Danh sách món ăn</a>
                        </li>
                        <li>
                            <a href="/Project1/Product/add" class="text-decoration-none">Thêm món ăn</a>
                        </li>
                        <li>
                            <a href="/Project1/category/list" class="text-decoration-none">Danh sách danh mục</a>
                        </li>
                    </ul>
                </div>
                <!-- Cột mạng xã hội -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase">Kết nối với chúng tôi</h5>
                    <a href="#" class="me-3">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="me-3">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center">
            © 2025 Quán Ăn Ngon. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function validateForm() {
            let price = document.getElementById('price').value;
            if (price <= 0) {
                alert('Giá phải lớn hơn 0!');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>