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
    <title>LIÊN HỆ KHÁCH HÀNG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>
</head>

<body class="bg-light">

    <?php require("inc/header.php") ?>

    <div class="container-fluid z-0 py-4">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">

                <!-- Header card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh sách liên hệ</h5>
                        <div>
                            <button onclick="updateSeen('all')" class="btn btn-sm btn-success me-2">
                                Đánh dấu tất cả đã đọc
                            </button>
                            <button onclick="deleteQuery('all')" class="btn btn-sm btn-danger">
                                Xóa tất cả
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body">
                        <div class="table-responsive shadow-sm rounded-3">
                            <table class="table table-hover align-middle mb-0" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width:5%;">
                                    <col style="width:15%;">
                                    <col style="width:15%;">
                                    <col style="width:10%;">
                                    <col style="width:15%;">
                                    <col style="width:25%;">
                                    <col style="width:10%;">
                                    <col style="width:15%;">
                                </colgroup>
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
                                                <td>
                                                    <div
                                                        style="max-height: 80px; overflow-y: auto; padding: 5px; border: 1px solid #ddd; border-radius: 5px;">
                                                        <?= nl2br(htmlspecialchars($row['message'])) ?>
                                                    </div>
                                                </td>

                                                <td><?= $row['date'] ?></td>
                                                <td class="text-center" style="max-width: 120px;">
                                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                                        <?php if ($row['seen'] != 1): ?>
                                                            <button onclick="updateSeen(<?= $row['cr_no'] ?>)"
                                                                class="btn btn-sm btn-primary text-nowrap">
                                                                Đã đọc
                                                            </button>
                                                        <?php endif; ?>
                                                        <button onclick="deleteQuery(<?= $row['cr_no'] ?>)"
                                                            class="btn btn-sm btn-danger text-nowrap">
                                                            Xóa
                                                        </button>
                                                    </div>
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
        </div>

    </div>


    <?php require("inc/scripts.php") ?>
    <script src="scripts/queries.js"></script>
</body>

</html>