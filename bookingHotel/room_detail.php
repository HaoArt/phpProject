<?php
require_once('./admin/inc/db_config.php');


if (!isset($_GET['room_id'])) {
    echo "ID phòng không hợp lệ.";
    exit;
}

$room_id = intval($_GET['room_id']); // Ép kiểu an toàn

// Lấy thông tin phòng
$res = mysqli_query($con, "SELECT * FROM rooms WHERE cr_no=$room_id");
if (!$res || mysqli_num_rows($res) == 0) {
    echo "Không tìm thấy phòng.";
    exit;
}

$room = mysqli_fetch_assoc($res);

// Lấy tất cả ảnh của phòng
$img_res = mysqli_query($con, "SELECT img FROM room_image WHERE room_id=$room_id");
$images = [];
while ($img_row = mysqli_fetch_assoc($img_res)) {
    $images[] = $img_row['img'];
}
if (empty($images)) $images[] = 'images/rooms/default.jpg';

// Đặc trưng và cơ sở vật chất (JSON trong DB hoặc mặc định)
$features = isset($room['features']) ? json_decode($room['features'], true) : ['2 Phòng', '1 Phòng tắm', '1 Ban công'];
$facilities = isset($room['facilities']) ? json_decode($room['facilities'], true) : ['Wifi', 'TV', 'Máy lạnh', 'Bếp từ'];

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($room['name']) ?> - Chi tiết phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php require("inc/links.php") ?>
</head>

<body>
    <?php require_once('inc/header.php'); ?>
    <div class="container my-5 px-3">
        <div class="row g-4">

            <!-- Ảnh phòng -->
            <div class="col-md-6">
                <div style="width:100%; height:450px; overflow:hidden; border-radius:12px;" class="shadow-sm">

                    <?php if (count($images) > 1): ?>
                        <div id="roomCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                            <div class="carousel-inner h-100">
                                <?php foreach ($images as $index => $img): ?>
                                    <div class="carousel-item h-100 <?= $index == 0 ? 'active' : '' ?>">
                                        <img src="./admin/<?= $img ?>" class="d-block w-100 h-100" style="object-fit: cover;"
                                            alt="<?= htmlspecialchars($room['name']) ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark p-3 rounded-circle"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark p-3 rounded-circle"></span>
                            </button>
                        </div>

                    <?php else: ?>
                        <img src="./admin/<?= $images[0] ?>" class="w-100 h-100" style="object-fit: cover;"
                            alt="<?= htmlspecialchars($room['name']) ?>">
                    <?php endif; ?>

                </div>
            </div>


            <!-- Thông tin phòng -->
            <div class="col-md-6">

                <h2 class="fw-bold"><?= htmlspecialchars($room['name']) ?></h2>
                <h4 class="text-success fw-semibold mt-2">
                    <?= number_format($room['price'], 0, ',', '.') ?>K
                    <span class="text-muted" style="font-size:17px;">/ đêm</span>
                </h4>

                <hr class="my-3">

                <!-- Features -->
                <h5 class="fw-semibold mb-2">Đặc trưng phòng</h5>
                <div class="mb-3">
                    <?php foreach ($features as $f): ?>
                        <span class="badge bg-light text-dark border px-3 py-2 me-1 mb-1"><?= htmlspecialchars($f) ?></span>
                    <?php endforeach; ?>
                </div>

                <!-- Facilities -->
                <h5 class="fw-semibold mt-3 mb-2">Tiện nghi</h5>
                <div class="mb-3">
                    <?php foreach ($facilities as $fac): ?>
                        <span
                            class="badge bg-light text-dark border px-3 py-2 me-1 mb-1"><?= htmlspecialchars($fac) ?></span>
                    <?php endforeach; ?>
                </div>

                <!-- Description -->
                <h5 class="fw-semibold mt-3">Mô tả</h5>
                <p class="text-muted" style="line-height:1.7;">
                    <?= nl2br(htmlspecialchars($room['description'])) ?>
                </p>

                <!-- Booking -->
                <a href="booking.php?room_id=<?= $room['cr_no'] ?>"
                    class="btn btn-success btn-lg mt-2 px-4 py-2 shadow-sm rounded-pill">
                    Đặt ngay
                </a>

            </div>
        </div>
    </div>


    <?php require_once('inc/footer.php');
    ?>
    <?php require("inc/scripts.php"); ?>
</body>

</html>