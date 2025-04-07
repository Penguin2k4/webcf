<?php include 'app/views/shares/header.php'; ?>
<h1 class="text-center my-4">📊 Doanh thu theo tháng</h1>

<div class="container">
    <!-- Form for selecting month and year -->
    <form method="GET" action="/webbanhang/Product/viewMonthlyRevenue" class="mb-4">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label for="month" class="sr-only">Tháng</label>
                <select name="month" id="month" class="form-control">
                    <option value="">Chọn tháng</option>
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?php echo $m; ?>" <?php echo (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : ''; ?>>
                            <?php echo $m; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="year" class="sr-only">Năm</label>
                <select name="year" id="year" class="form-control">
                    <option value="">Chọn năm</option>
                    <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                        <option value="<?php echo $y; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : ''; ?>>
                            <?php echo $y; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tháng</th>
                <th>Doanh thu (VND)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monthlyRevenue as $revenue): ?>
                <tr>
                    <td><?php echo htmlspecialchars($revenue->month, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($revenue->total_revenue, 0, ',', '.'); ?> VND</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-4">Chi tiết giao dịch</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã giao dịch</th>
                <th>Tên sản phẩm</th>
                <th>Giá (VND)</th>
                <th>Số lượng</th>
                <th>Thành tiền (VND)</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalRevenue = 0; ?>
            <?php foreach ($transactionDetails as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction->order_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($transaction->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($transaction->price, 0, ',', '.'); ?> VND</td>
                    <td><?php echo htmlspecialchars($transaction->quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($transaction->total_price, 0, ',', '.'); ?> VND</td>
                </tr>
                <?php $totalRevenue += $transaction->total_price; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Tổng doanh thu:</strong></td>
                <td><strong><?php echo number_format($totalRevenue, 0, ',', '.'); ?> VND</strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<a href="/webbanhang" class="btn btn-primary mt-3">Quay lại</a>
<?php include 'app/views/shares/footer.php'; ?>
