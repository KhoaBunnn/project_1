<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">

    <h2 class="mb-4" style="color: #e67e22;">Danh sách mã giảm giá</h2>

    <a href="/Project1/Discount/add" class="btn mb-3" 
       style="background-color: #e67e22; color: white; font-weight: 600; transition: background-color 0.3s;">
        Thêm mã mới
    </a>

    <form method="GET" action="/Project1/Discount/list" class="row g-3 mb-4 align-items-center">
        <div class="col-md-4">
            <input type="text" name="code" class="form-control" placeholder="Tìm theo mã" value="<?= htmlspecialchars($_GET['code'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select name="discount_percent" class="form-select">
                <option value="">-- Lọc theo % Giảm --</option>
                <?php 
                for ($i=0; $i<=100; $i+=5) {
                    $selected = (isset($_GET['discount_percent']) && $_GET['discount_percent'] == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i%</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="expiry_date" class="form-control" value="<?= htmlspecialchars($_GET['expiry_date'] ?? '') ?>">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-warning fw-semibold" style="color:#fff; background-color:#e67e22; border:none; transition: background-color 0.3s;">
                Tìm & Lọc
            </button>
            <a href="/Project1/Discount/list" class="btn btn-outline-secondary">Xóa bộ lọc</a>
        </div>
    </form>

    <div class="table-responsive shadow rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-warning" style="color: #e67e22;">
                <tr>
                    <th>ID</th>
                    <th>Mã</th>
                    <th>Giảm (%)</th>
                    <th>Ngày hết hạn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($discounts as $d): ?>
                <tr>
                    <td><?= $d->id ?></td>
                    <td><?= htmlspecialchars($d->code) ?></td>
                    <td><?= $d->discount_percent ?>%</td>
                    <td><?= date('d/m/Y', strtotime($d->expiry_date)) ?></td>
                    <td>
                        <a href="/Project1/Discount/edit/<?= $d->id ?>" class="btn btn-sm btn-warning me-2" 
                           style="color:#fff; background-color:#e67e22; border:none; transition: background-color 0.3s;">
                           Sửa
                        </a>
                        <a href="/Project1/Discount/delete/<?= $d->id ?>" 
                           onclick="return confirm('Bạn có chắc muốn xóa mã này?')" 
                           class="btn btn-sm btn-danger">
                           Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($discounts)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Không có mã giảm giá nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'app/views/shares/footer.php'; ?>
