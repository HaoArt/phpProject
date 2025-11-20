<?php
session_start();
require_once(__DIR__ . '/../admin/inc/db_config.php');

if (!isset($_SESSION['userLogin']) || $_SESSION['userLogin'] !== true) {
    echo json_encode(["success" => false, "message" => "Vui lòng đăng nhập trước."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'] ?? null;
    $check_in = $_POST['check_in'] ?? null;
    $check_out = $_POST['check_out'] ?? null;
    $user_email = $_SESSION['user']['email'];

    if (!$room_id || !$check_in || !$check_out) {
        echo json_encode(["success" => false, "message" => "Nhập ngày checkin và ngày check out"]);
        exit;
    }

    if ($check_in_ts >= $check_out_ts) {
        echo json_encode([
            "success" => false,
            "message" => "Ngày nhận phòng phải nhỏ hơn ngày trả phòng."
        ]);
        exit;
    }
    // Lấy giá phòng
    $stmt = $con->prepare("SELECT price FROM rooms WHERE cr_no=? LIMIT 1");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Phòng không tồn tại."]);
        exit;
    }
    $room = $res->fetch_assoc();
    $stmt->close();

    $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    $total_price = $room['price'] * max(1, $nights);

    $status = 0;
    $stmt = $con->prepare("INSERT INTO bookings (room_id, user_email, check_in, check_out, total_price, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isssdi", $room_id, $user_email, $check_in, $check_out, $total_price, $status);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Đặt phòng thành công!"]);
    } else {
        echo json_encode(["success" => false, "message" => $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["success" => false, "message" => "Phương thức không hợp lệ."]);
}
