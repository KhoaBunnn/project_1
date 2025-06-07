<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoa Bun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .navbar {
            background: linear-gradient(135deg, #e67e22 0%, #ff6b6b 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: bold;
            color: #000000 !important;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover {
            color: #f39c12 !important;
        }
        .nav-link {
            color: #000000 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #f39c12 !important;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            animation: fadeIn 0.3s ease-in-out;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .btn-success, .btn-warning, .btn-danger, .btn-outline-secondary {
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #28a745;
            transform: scale(1.05);
        }
        .btn-warning:hover {
            background-color: #ffc107;
            transform: scale(1.05);
        }
        .btn-danger:hover {
            background-color: #dc3545;
            transform: scale(1.05);
        }
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/Project1/Product/">KhoaBunn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/Project1/Product/">Danh sách món ăn</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Project1/account/listusers">Danh sách người dùng</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Project1/category/list">Danh sách danh mục</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Project1/discount/list">Danh sách mã giảm giá</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Project1/Product/orderList">Lịch sử đơn hàng</a></li>

                    <li class="nav-item">
                        <?php
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link'>" . $_SESSION['username'] . "</a>";
                        } else {
                            echo "<a class='nav-link' href='/Project1/account/login'>Login</a>";
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link' href='/Project1/account/logout'>Logout</a>";
                        }
                        ?>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/Project1/Product/Cart"><i class="bi bi-cart fs-3"></i></a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Nội dung chính sẽ hiển thị ở đây -->
        <h2>Chào mừng bạn đến với ĐÓM !!! </h2>
        <p>Quản lý sản phẩm và đơn hàng dễ dàng, nhanh chóng.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
