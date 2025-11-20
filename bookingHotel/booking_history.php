<?php
// Chỉ start session nếu chưa start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('./admin/inc/db_config.php');

// Kiểm tra user đã login chưa
if (!isset($_SESSION['userLogin']) || $_SESSION['userLogin'] !== true) {
    header("Location: index.php");
    exit;
}

$user_email = $_SESSION['user']['email'];

// Truy vấn lịch sử booking chỉ từ bảng bookings
$query = "SELECT * FROM bookings WHERE user_email = ? ORDER BY created_at DESC";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$res = $stmt->get_result();
$bookings = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Mảng trạng thái
$status_text = [
    0 => "Đang chờ",
    1 => "Xác nhận",
    2 => "Đã hủy"
];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lịch sử đặt phòng</title>
    <?php require("inc/links.php") ?>
</head>

<body class="bg-light">
    <?php
    // Tránh session_start() trùng trong header
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once('inc/header.php');
    ?>

    <div class="container py-5">
        <h3 class="mb-5 text-center fw-bold">Lịch sử đặt phòng của bạn</h3>

        <?php if (empty($bookings)): ?>
        <p class="text-center text-muted fs-5">Bạn chưa có đặt phòng nào.</p>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($bookings as $b): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 booking-card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary fw-bold mb-3">Phòng ID:
                            <?= htmlspecialchars($b['room_id']) ?></h5>
                        <p class="card-text mb-2"><strong>Ngày nhận:</strong>
                            <?= date("d/m/Y", strtotime($b['check_in'])) ?></p>
                        <p class="card-text mb-2"><strong>Ngày trả:</strong>
                            <?= date("d/m/Y", strtotime($b['check_out'])) ?></p>
                        <p class="card-text mb-2"><strong>Tổng giá:</strong>
                            <?= number_format($b['total_price'], 0, ',', '.') ?> VND</p>
                        <p class="card-text mt-auto">
                            <strong>Trạng thái:</strong>
                            <?php
                                    $status_class = '';
                                    switch ($b['status']) {
                                        case 0:
                                            $status_class = 'badge bg-warning text-dark';
                                            break;
                                        case 1:
                                            $status_class = 'badge bg-success';
                                            break;
                                        case 2:
                                            $status_class = 'badge bg-danger';
                                            break;
                                        default:
                                            $status_class = 'badge bg-secondary';
                                            break;
                                    }
                                    ?>
                            <span class="<?= $status_class ?>">
                                <?= $status_text[$b['status']] ?? 'Không xác định' ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>


    <?php require_once('inc/footer.php'); ?>
    <?php require("inc/scripts.php"); ?>
</body>

</html>