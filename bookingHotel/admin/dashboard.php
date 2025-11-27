<?php
require("inc/essentials.php");
require("inc/db_config.php");
adminLogin();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TỔNG QUAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">

                <!-- 1. Header -->
                <h3 class="mb-4 text-primary fw-bold">Dashboard</h3>

                <!-- 2. Quick Stats Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h6 class="text-secondary">Tổng phòng</h6>
                                <h3 class="fw-bold" id="total-rooms">
                                    <?php
                                    $q = "SELECT SUM(quantity) AS total_rooms FROM rooms";
                                    $r = mysqli_query($con, $q);
                                    if ($r) {
                                        $row = mysqli_fetch_assoc($r);
                                        $totalRooms = $row['total_rooms'];
                                        echo  $totalRooms;
                                    } else {
                                        echo "Lỗi truy vấn: " . mysqli_error($con);
                                    }
                                    ?>

                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h6 class="text-secondary">Booking hôm nay</h6>
                                <h3 class="fw-bold" id="today-bookings">
                                    <?php
                                    $q = "SELECT COUNT(*) AS total_bookings_today FROM bookings WHERE DATE(created_at) = CURDATE();";
                                    $r = mysqli_query($con, $q);
                                    if ($r) {
                                        $row = mysqli_fetch_assoc($r);
                                        $totalBookingsToday = $row['total_bookings_today'];
                                        echo  $totalBookingsToday;
                                    } else {
                                        echo "Lỗi truy vấn: " . mysqli_error($con);
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h6 class="text-secondary">Khách hàng</h6>
                                <h3 class="fw-bold" id="total-users">
                                    <?php
                                    $q = "SELECT COUNT(*) AS total_user FROM user_cred";
                                    $r = mysqli_query($con, $q);
                                    if ($r) {
                                        $row = mysqli_fetch_assoc($r);
                                        $totalUser = $row['total_user'];
                                        echo  $totalUser;
                                    } else {
                                        echo "Lỗi truy vấn: " . mysqli_error($con);
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h6 class="text-secondary">Tin nhắn chưa đọc</h6>
                                <h3 class="fw-bold text-danger" id="unread-messages">
                                    <?php
                                    $q = "SELECT COUNT(*) AS total_query FROM user_query WHERE seen = 0";
                                    $r = mysqli_query($con, $q);
                                    if ($r) {
                                        $row = mysqli_fetch_assoc($r);
                                        $totalUserQuery = $row['total_query'];
                                        echo  $totalUserQuery;
                                    } else {
                                        echo "Lỗi truy vấn: " . mysqli_error($con);
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Charts -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Doanh thu theo tháng</h6>
                                <canvas id="revenueChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Tình trạng phòng</h6>
                                <canvas id="roomStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Booking mới nhất -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Booking mới nhất</h5>
                                    <button class="btn btn-sm btn-primary" onclick="viewAllBookings()">Xem tất
                                        cả</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Người đặt</th>
                                                <th>Phòng</th>
                                                <th>Ngày nhận</th>
                                                <th>Ngày trả</th>
                                                <th>Tổng giá</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody id="latest-bookings">
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Chưa có dữ liệu booking.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Liên hệ mới -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Liên hệ mới</h5>
                                    <button class="btn btn-sm btn-primary" onclick="viewAllContacts()">Xem tất
                                        cả</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Chủ đề</th>
                                            </tr>
                                        </thead>
                                        <tbody id="latest-contacts">
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Chưa có dữ liệu liên hệ.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php require("inc/scripts.php") ?>
    <script>
        const revenueData = {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [1200000, 1500000, 1100000, 2000000, 1800000, 2200000],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const roomStatusData = {
            labels: ['Trống', 'Đã đặt', 'Đang dọn', 'Bảo trì'],
            datasets: [{
                label: 'Số lượng phòng',
                data: [12, 5, 2, 1],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)', // xanh lá
                    'rgba(255, 193, 7, 0.7)', // vàng
                    'rgba(23, 162, 184, 0.7)', // xanh nước biển
                    'rgba(220, 53, 69, 0.7)' // đỏ
                ]
            }]
        };
        // Doanh thu theo tháng (bar chart)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: revenueData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Tình trạng phòng (pie chart)
        const ctxRoomStatus = document.getElementById('roomStatusChart').getContext('2d');
        const roomStatusChart = new Chart(ctxRoomStatus, {
            type: 'pie',
            data: roomStatusData,
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>