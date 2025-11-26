<?php
require_once(__DIR__ . '/../admin/inc/db_config.php');
$settings_q = "SELECT * FROM settings WHERE 1";
$settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));
?>

<!-- Footer -->
<footer class="container-fluid bg-dark text-white pt-5">
    <div class="container">
        <div class="row">

            <!-- Logo & Giới thiệu -->
            <div class="col-md-4 mb-4">
                <a class="navbar-brand fs-2 fw-bold text-white" href="index.php">
                    <?= htmlspecialchars($settings_r['site_title']); ?>
                </a>
                <p class="mt-3"><?= htmlspecialchars($settings_r['site_about']); ?></p>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold text-uppercase">Liên kết nhanh</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white text-decoration-none d-block py-1">Trang chủ</a></li>
                    <li><a href="about_us.php" class="text-white text-decoration-none d-block py-1">Về chúng tôi</a>
                    </li>
                    <li><a href="facilities.php" class="text-white text-decoration-none d-block py-1">Cơ sở vậ chất</a>
                    </li>
                    <li><a href="rooms.php" class="text-white text-decoration-none d-block py-1">Phòng</a></li>
                    <li><a href="contact_us.php" class="text-white text-decoration-none d-block py-1">Liên hệ</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h6 class="fw-bold text-uppercase">Công ty</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Khách hàng</a></li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Đội ngũ</a></li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Tuyển dụng</a></li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Đánh giá</a></li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Tin tức</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h6 class="fw-bold text-uppercase">Chính sách</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Chính sách bảo mật</a></li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Điều khoản &amp; Điều kiện</a>
                    </li>
                    <li><a href="#" class="text-white text-decoration-none d-block py-1">Đối tác</a></li>
                </ul>
            </div>

            <!-- Mạng xã hội & Liên hệ -->
            <div class="col-md-2 mb-4 text-center text-md-start">
                <h6 class="fw-bold text-uppercase">Kết nối</h6>
                <div class="mb-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i
                            class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i
                            class="bi bi-github"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i
                            class="bi bi-envelope-at-fill"></i></a>
                </div>
                <a href="contact_us.php" class="btn btn-light btn-sm fw-bold">Liên hệ ngay</a>
            </div>

        </div>

        <!-- Bản quyền -->
        <div class="row mt-4 pt-4 border-top border-secondary">
            <div class="col-12 text-center">
                <p class="mb-0 small">&copy; 2025 <?= htmlspecialchars($settings_r['site_title']); ?>. Tất cả các quyền
                    được bảo lưu.</p>
            </div>
        </div>
    </div>
</footer>


<script>
    function showToast(type, message) {
        const toast = document.createElement("div");
        toast.className = `toast align-items-center text-white bg-${type} border-0 show position-fixed end-0 m-3`;
        toast.style.top = "20%";
        toast.style.zIndex = "9999";
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>