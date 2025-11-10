<?php
require("inc/essentials.php");
require("inc/db_config.php");
adminLogin();

if (!$con) {
    die("Kết nối CSDL thất bại: " . mysqli_connect_error());
}

$query = "SELECT * FROM `user_query` ORDER BY `cr_no` DESC";
$data = mysqli_query($con, $query);

if (!$data) {
    die("Lỗi truy vấn dữ liệu: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Liên hệ của khách hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>
</head>

<body class="bg-light">

    <?php require("inc/header.php") ?>

    <div class="container-fluid z-0 py-4">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold text-primary">Danh sách liên hệ</h4>
                    <div>
                        <button onclick="updateSeen('all')" class="btn btn-sm btn-success me-2">
                            Đánh dấu tất cả đã đọc
                        </button>
                        <button onclick="deleteQuery('all')" class="btn btn-sm btn-danger">
                            Xóa tất cả
                        </button>
                    </div>
                </div>

                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Chủ đề</th>
                                <th>Tin nhắn</th>
                                <th>Thời gian gửi</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (mysqli_num_rows($data) > 0):
                                while ($row = mysqli_fetch_assoc($data)):
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><?= htmlspecialchars($row['phone']) ?></td>
                                        <td><?= htmlspecialchars($row['subject']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                        <td><?= $row['date'] ?></td>
                                        <td class="text-center">
                                            <?php if ($row['seen'] != 1): ?>
                                                <button onclick="updateSeen(<?= $row['cr_no'] ?>)"
                                                    class="btn btn-sm btn-primary me-1">Đã đọc</button>
                                            <?php endif; ?>
                                            <button onclick="deleteQuery(<?= $row['cr_no'] ?>)"
                                                class="btn btn-sm btn-danger">Xóa</button>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Chưa có dữ liệu liên hệ nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require("inc/scripts.php") ?>
    <script src="scripts/queries.js"></script>
</body>

</html>