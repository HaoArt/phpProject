<?php
ob_clean();
require_once(__DIR__ . '/../admin/inc/db_config.php');

$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
$limit = 4;

// Lấy phòng
$rooms_res = mysqli_query($con, "SELECT * FROM rooms WHERE status=1 ORDER BY cr_no DESC LIMIT $offset, $limit");

if (mysqli_num_rows($rooms_res) == 0 && $offset == 0) {
    echo "<p>Hiện tại chưa có phòng nào.</p>";
}

while ($room = mysqli_fetch_assoc($rooms_res)) {

    // Ảnh đại diện
    $img_res = mysqli_query($con, "SELECT img FROM room_image WHERE room_id=" . $room['cr_no'] . " LIMIT 1");
    $img = ($img_res && mysqli_num_rows($img_res) > 0)
        ? mysqli_fetch_assoc($img_res)['img']
        : 'images/rooms/default.jpg';

    // Lấy facilities chi tiết
    $facilities_res = mysqli_query(
        $con,
        "
    SELECT fc.name 
    FROM room_facilities rfc 
    JOIN facilities fc ON rfc.facilities_id = fc.cr_no 
    WHERE rfc.room_id = " . $room['cr_no']
    );
    $facilities = [];
    if ($facilities_res && mysqli_num_rows($facilities_res) > 0) {
        while ($fac = mysqli_fetch_assoc($facilities_res)) {
            $facilities[] = $fac['name'];
        }
    }

    // Lấy features chi tiết
    $features_res = mysqli_query(
        $con,
        "
    SELECT f.name 
    FROM room_features rf 
    JOIN features f ON rf.features_id = f.cr_no 
    WHERE rf.room_id = " . $room['cr_no']
    );
    $features = [];
    if ($features_res && mysqli_num_rows($features_res) > 0) {
        while ($f = mysqli_fetch_assoc($features_res)) {
            $features[] = $f['name'];
        }
    }

?>

<div class="card mb-3 shadow" id="room-<?= $room['cr_no'] ?>">
    <div class="row g-0 p-3 align-items-center">
        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
            <img src="./admin/<?= $img ?>" class="img-fluid rounded-start"
                style="width: 100%; height: 200px; object-fit: cover;">
        </div>

        <div class="col-md-5 px-lg-3 px-md-3 px-0">
            <h5><?= htmlspecialchars($room['name']) ?></h5>

            <div class="features mb-4">
                <h6 class="mb-2">Đặc trưng</h6>
                <?php foreach ($features as $f): ?>
                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">
                    <?= htmlspecialchars($f) ?>
                </span>
                <?php endforeach; ?>
            </div>

            <div class="facilities mb-3">
                <h6 class="mb-2">Cơ sở vật chất</h6>
                <?php foreach ($facilities as $fac): ?>
                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">
                    <?= htmlspecialchars($fac) ?>
                </span>
                <?php endforeach; ?>
            </div>

        </div>

        <div class="col-md-2 text-center">
            <div class="card-body">
                <h5 class="card-title"><?= number_format($room['price'], 0, ',', '.') ?>K/đêm</h5>
                <form action="booking.php" method="POST">
                    <input type="hidden" name="room_id" value="<?= $room['cr_no'] ?>">
                    <button type="submit" class="btn btn-success w-100 mb-2">Đặt ngay</button>
                </form>
                <a href="room_detail.php?room_id=<?= $room['cr_no'] ?>" class="btn btn-info w-100">Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>

<?php
}

if (mysqli_num_rows($rooms_res) < $limit) {
    echo "__NO_MORE__";
}
?>