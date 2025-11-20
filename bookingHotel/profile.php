<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thông Tin Cá Nhân</title>
    <?php require("inc/links.php") ?>
</head>

<body class="bg-light">
    <?php
    session_start();
    if (!isset($_SESSION['userLogin']) || $_SESSION['userLogin'] !== true) {
        header("Location: index.php");
        exit;
    }
    ?>
    <?php require_once('inc/header.php'); ?>
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="row g-4">

                <!-- Avatar -->
                <div class="col-md-4 text-center">
                    <img src="<?= $_SESSION['user']['profile'] ?? 'assets/img/default_user.png'; ?>"
                        class="rounded-circle shadow" width="180" height="180" style="object-fit: cover;" />
                    <h4 class="mt-3 fw-bold"><?= $_SESSION['user']["name"]; ?></h4>
                    <p class="text-muted">Khách hàng</p>
                </div>

                <!-- Profile Info -->
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">Thông tin tài khoản</h3>
                    <hr />

                    <div class="mb-3">
                        <label class="fw-bold">Email:</label>
                        <div class="form-control bg-white"><?= $_SESSION['user']['email']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Số điện thoại:</label>
                        <div class="form-control bg-white"><?= $_SESSION['user']['phone'] ?? 'Chưa cập nhật'; ?></div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Địa chỉ:</label>
                        <div class="form-control bg-white"><?= $_SESSION['user']['address'] ?? 'Chưa cập nhật'; ?></div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Ngày sinh:</label>
                        <div class="form-control bg-white"><?= $_SESSION['user']['birthday'] ?? 'Chưa cập nhật'; ?>
                        </div>
                    </div>

                    <!-- Nút chỉnh sửa và quay về -->
                    <div class="d-flex gap-2 mt-3">
                        <a href="index.php" class="btn btn-secondary px-4">Quay về trang chủ</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php');
    ?>
    <?php require("inc/scripts.php"); ?>
</body>

</html>