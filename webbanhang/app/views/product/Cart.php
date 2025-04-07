<?php include 'app/views/shares/header.php'; ?>
<h1 class="text-center my-4">🛒 Giỏ hàng của bạn</h1>

<?php if (!empty($cart)): ?>
<div class="container">
    <div class="row">
        <?php foreach ($cart as $id => $product): ?>
        <div class="col-md-4 mb-3">
            <div class="product-item">
                <?php if (!empty($product['image'])): ?>
                    <img src="/webbanhang/<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" 
                         style="width: 100px; height: auto;">
                <?php else: ?>
                    <p>Không có ảnh</p> <!-- Fallback for missing images -->
                <?php endif; ?>
                <div class="card-body p-2">
                    <h6 class="card-title"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h6>

                    <p><strong>Số bàn:</strong> <?php echo htmlspecialchars($so_ban, ENT_QUOTES, 'UTF-8'); ?></p>
                    <!-- Điều chỉnh số lượng -->
                    <form action="/webbanhang/Product/updateCartQuantity" method="POST" class="d-flex align-items-center justify-content-center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" min="1" class="form-control text-center mx-1" style="width: 50px;">
                        <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    </form>

                    <!-- Nút xóa -->
                    <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-danger btn-sm mt-2">🗑 Xóa</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-4">
        <h4>🧾 Tổng tiền: <span class="text-success"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span></h4>
    </div>
</div>

<?php else: ?>
<p class="text-center mt-4">🛍 Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<div class="text-center mt-2">
    <?php if (isset($_SESSION['so_ban'])): ?>
        <p>Số bàn hiện tại: <?php echo htmlspecialchars($_SESSION['so_ban'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="/webbanhang/Product/showSelectBanFromCart" class="btn btn-secondary btn-sm">Thay đổi số bàn</a>
    <?php else: ?>
        <a href="/webbanhang/Product/showSelectBanFromCart" class="btn btn-primary btn-sm">Chọn số bàn</a>
    <?php endif; ?>
</div>

<div class="text-center mt-4">
    <a href="/webbanhang" class="btn btn-primary">🔄 Tiếp tục mua sắm</a>
    <a href="/webbanhang/Product/checkout" class="btn btn-success">💳 Thanh Toán</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>