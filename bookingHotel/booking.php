<?php
session_start();
require_once(__DIR__ . '/admin/inc/db_config.php'); // Kết nối DB

// Kiểm tra người dùng đã đăng nhập
if (!isset($_SESSION['userLogin']) || $_SESSION['userLogin'] !== true) {
    header("Location: index.php");
    exit;
}

// Lấy room_id từ GET hoặc POST
$room_id = $_GET['room_id'] ?? $_POST['room_id'] ?? null;

if (!$room_id) {
    echo "ID phòng không hợp lệ!";
    exit;
}

// Lấy thông tin phòng từ DB
$stmt = $con->prepare("SELECT * FROM rooms WHERE cr_no = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "Phòng không tồn tại!";
    exit;
}

$room = $res->fetch_assoc();
$stmt->close();
$stmt = $con->prepare("SELECT * FROM room_image WHERE room_id = ? LIMIT 1");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$res_room = $stmt->get_result();
$img = $res_room->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt phòng - <?= htmlspecialchars($room['name']) ?></title>
    <?php require("inc/links.php") ?>
</head>

<body class="bg-light">
    <?php require_once('inc/header.php'); ?>
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h3 class="fw-bold mb-4"><?= htmlspecialchars($room['name']); ?></h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <img src="./admin/<?= htmlspecialchars($img['img']); ?>" class="img-fluid rounded-4"
                        alt="<?= htmlspecialchars($room['name']); ?>">
                </div>
                <div class="col-md-6">
                    <h5>Thông tin phòng:</h5>
                    <p><?= htmlspecialchars($room['description'] ?? 'Chưa có mô tả'); ?></p>
                    <p><strong>Giá: </strong><span id="roomPrice"><?= number_format($room['price'] ?? 0); ?></span>
                        VND/đêm</p>

                    <form id="bookingForm">
                        <input type="hidden" name="room_id" value="<?= $room['cr_no']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Ngày nhận phòng</label>
                            <input type="date" name="check_in" id="check_in" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày trả phòng</label>
                            <input type="date" name="check_out" id="check_out" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <p><strong>Tổng giá dự kiến:</strong> <span id="totalPrice">0</span> VND</p>
                        </div>
                        <button type="button" onclick="booking()" class="btn btn-success w-100">Đặt ngay</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const roomPrice = <?= $room['price'] ?? 0; ?>;
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const totalPriceSpan = document.getElementById('totalPrice');

        function updateTotalPrice() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);

            if (checkIn && checkOut && checkOut > checkIn) {
                const diffTime = checkOut - checkIn;
                const nights = diffTime / (1000 * 60 * 60 * 24);
                totalPriceSpan.textContent = (nights * roomPrice).toLocaleString('vi-VN');
            } else {
                totalPriceSpan.textContent = '0';
            }
        }

        checkInInput.addEventListener('change', updateTotalPrice);
        checkOutInput.addEventListener('change', updateTotalPrice);
    </script>


    <?php require("inc/scripts.php");
    require_once('inc/footer.php'); ?>
    <script src="script/booking.js"></script>
</body>

</html>