<?php
ob_clean();
require("../inc/db_config.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_bookings') {
    $query = "SELECT b.cr_no, b.room_id, b.user_email, b.check_in, b.check_out, b.total_price, b.status,
              u.name AS user_name, r.name AS room_name
              FROM bookings b
              JOIN user_cred u ON u.email = b.user_email
              JOIN rooms r ON r.cr_no = b.room_id
              ORDER BY b.created_at DESC";

    $res = $con->query($query);
    $bookings = [];
    while ($row = $res->fetch_assoc()) {
        $bookings[] = $row;
    }

    echo json_encode($bookings);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $id = intval($_POST['id'] ?? 0);
    $status = intval($_POST['status'] ?? -1);

    if (!$id || !in_array($status, [0, 1, 2])) {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
        exit;
    }

    $stmt = $con->prepare("UPDATE bookings SET status=? WHERE cr_no=?");
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        // Trả JSON luôn, bao gồm badge HTML
        $badge = $status == 0 ? "<span class='badge bg-warning'>Đang chờ</span>" : ($status == 1 ? "<span class='badge bg-success'>Xác nhận</span>" :
            "<span class='badge bg-danger'>Đã hủy</span>");
        echo json_encode(['success' => true, 'badge' => $badge]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $con->close();
    exit;
}
