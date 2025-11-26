<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Huế Hotel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require("inc/links.php") ?>
</head>

<body style="background-color: #f5f5f5;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php require("inc/header.php") ?>
    <!-- Swiper carousel -->
    <!-- Banner -->
    <div class="container-fluid p-0">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                $banner_q = "SELECT * FROM banner_carousel";
                $banner_r = mysqli_query($con, $banner_q);

                if (mysqli_num_rows($banner_r) > 0) {
                    while ($row = mysqli_fetch_assoc($banner_r)) {
                        $img = htmlspecialchars($row['img_banner']);
                        if ($img == '') $img = "default.jpg";
                ?>
                        <div class="swiper-slide">
                            <img src="./admin/<?php echo "$img"; ?>" class="w-100 d-block rounded"
                                style="height:500px; object-fit:cover;">
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Form booking -->
    <div class="container mt-4">
        <div class="p-4 bg-white rounded shadow-sm">
            <h4 class="fw-bold mb-3 text-primary">Tìm phòng theo nhu cầu của bạn</h4>
            <form>
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">Ngày nhận phòng</label>
                        <input type="date" class="form-control shadow-sm" name="checkin" min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">Ngày trả phòng</label>
                        <input type="date" class="form-control shadow-sm" name="checkout" min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <label class="form-label fw-semibold">Người lớn</label>
                        <select name="adults" class="form-select shadow-sm">
                            <option selected disabled>Chọn</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <label class="form-label fw-semibold">Trẻ em</label>
                        <select name="children" class="form-select shadow-sm">
                            <option selected disabled>Chọn</option>
                            <?php for ($i = 0; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <a href="rooms.php" class="btn btn-primary py-3 fw-semibold shadow-sm mt-4">
                            Tìm phòng
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Our rooms -->
    <div class="container-fluid">
        <h1 class="text-center mt-5 pt-4 mb-5 h-font">Phòng</h1>
        <div class="container">
            <div class="row">

                <?php
                // Lấy tối đa 3 phòng đang hoạt động, mới nhất
                $rooms_res = mysqli_query($con, "SELECT * FROM rooms WHERE status=1 ORDER BY cr_no DESC LIMIT 3");

                if (mysqli_num_rows($rooms_res) == 0) {
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

                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow h-100">
                            <img src="./admin/<?= $img ?>" class="card-img-top img-fluid"
                                alt="<?= htmlspecialchars($room['name']) ?>" style="height:200px; object-fit:cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                                <h6 class="card-title"><?= number_format($room['price']) ?>K/đêm</h6>

                                <div class="features mb-3">
                                    <h6>Đặc trưng</h6>
                                    <?php foreach ($features as $feature): ?>
                                        <span
                                            class="badge rounded-pill bg-light text-dark text-wrap p-1"><?= htmlspecialchars($feature) ?></span>
                                    <?php endforeach; ?>
                                </div>

                                <div class="facilities mb-3">
                                    <h6>Cơ sở vật chất</h6>
                                    <?php foreach ($facilities as $facility): ?>
                                        <span
                                            class="badge rounded-pill bg-light text-dark text-wrap p-1"><?= htmlspecialchars($facility) ?></span>
                                    <?php endforeach; ?>
                                </div>

                                <div class="mt-auto d-flex gap-2">
                                    <!-- Nút Đặt ngay -->
                                    <a href="booking.php?room_id=<?= $room['cr_no'] ?>" class="btn btn-primary flex-fill">
                                        Đặt ngay
                                    </a>

                                    <!-- Nút Xem chi tiết -->
                                    <a href="room_detail.php?room_id=<?= $room['cr_no'] ?>"
                                        class="btn btn-outline-secondary flex-fill">
                                        Xem chi tiết
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>


                <?php
                } // end while
                ?>
                <!-- <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
                        <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Phòng cổ điển</h5>
                            <h6 class="card-title">200K/đêm</h6>
                            <div class="features mb-4">
                                <h6 class="mb-6">Đặc trưng</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">2Phòng</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Phòng tắm</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Ban công</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">3 Ghế sofa</span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-6">Cơ sở vật chất</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Wifi</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">TV</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Máy lạnh</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Bếp từ</span>
                            </div>
                            <div class=" mb-3">
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>

                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary ">Đặt phòng ngay</button>
                                <button type="submit" class="btn btn-outline-secondary ">Xem thêm</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
                        <img src="images/rooms/2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Phòng cổ điển</h5>
                            <h6 class="card-title">200K/đêm</h6>
                            <div class="features mb-4">
                                <h6 class="mb-6">Đặc trưng</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">2Phòng</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Phòng tắm</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Ban công</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">3 Ghế sofa</span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-6">Cơ sở vật chất</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Wifi</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">TV</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Máy lạnh</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Bếp từ</span>
                            </div>
                            <div class=" mb-3">
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-half rating"></i>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary ">Đặt phòng ngay</button>
                                <button type="submit" class="btn btn-outline-secondary ">Xem thêm</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
                        <img src="images/rooms/3.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Phòng cổ điển</h5>
                            <h6 class="card-title">200K/đêm</h6>
                            <div class="features mb-4">
                                <h6 class="mb-6">Đặc trưng</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">2Phòng</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Phòng tắm</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">1 Ban công</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">3 Ghế sofa</span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-6">Cơ sở vật chất</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Wifi</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">TV</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Máy lạnh</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap p-1">Bếp từ</span>
                            </div>
                            <div class=" mb-3">
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-fill rating"></i>
                                <i class="bi bi-star-half rating"></i>
                                <i class="bi bi-star rating"></i>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary ">Đặt phòng ngay</button>
                                <button type="submit" class="btn btn-outline-secondary ">Xem thêm</button>
                            </div>
                        </div>

                    </div>
                </div> -->
                <div class="col-lg-12 text-center mt-5">
                    <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"> Xem thêm
                        >></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Facilities  -->
    <div class="container-fluid">
        <h1 class="text-center mt-5 pt-4 mb-5 h-font">Cơ sở vật chất</h1>

        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center">

                <?php
                $q = "SELECT * FROM facilities ORDER BY cr_no DESC";
                $r = mysqli_query($con, $q);

                if (mysqli_num_rows($r) > 0) {
                    while ($row = mysqli_fetch_assoc($r)) {

                        $name = htmlspecialchars($row['name']);
                        $icon = htmlspecialchars($row['icon']);
                ?>
                        <div class="col">
                            <div class="card text-center shadow-sm rounded p-3 h-100">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle mx-auto mb-2"
                                    style="width:50px; height:50px;">
                                    <img src="./admin/<?= $icon ?>" class="img-fluid" alt="<?= $name ?>"
                                        style="max-width:30px; max-height:30px;">
                                </div>
                                <div class="card-body p-1">
                                    <h6 class="card-title text-truncate mb-0"><?= $name ?></h6>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-muted'>Chưa có dữ liệu cơ sở vật chất.</p>";
                }
                ?>

            </div>
        </div>
    </div>

    <!-- ReComment -->

    <div class="container my-5">
        <h1 class="text-center mb-4 pt-4 fw-bold">Phản hồi của khách hàng</h1>

        <div class="swiper mySwiperCoverFlow">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1719858611039-66c134efa74d?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Nguyễn Văn A"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Nguyễn Văn A</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1">“Phòng sạch sẽ, view đẹp, nhân viên thân thiện. Chắc chắn sẽ
                            quay lại!”</p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://images.unsplash.com/vector-1740737650825-1ce4f5377085?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Trần Thị B"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Trần Thị B</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-muted"></i>
                                    <i class="bi bi-star text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Dịch vụ tốt, giá hợp lý. Tôi rất hài lòng với trải nghiệm ở
                            đây.”</p>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1719858610375-3b4f4cfa75a4?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Lê Văn C"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Lê Văn C</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Tuyệt vời! Phòng tiện nghi đầy đủ, view sông Hương rất đẹp.”
                        </p>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1714618927767-b7606cc6c88c?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Phạm Thị D"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Phạm Thị D</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-muted"></i>
                                    <i class="bi bi-star text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Nhân viên thân thiện, ăn sáng ngon, phòng sạch sẽ và thoải
                            mái.”</p>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1728560971527-140ca22e3d81?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Ngô Văn E"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Ngô Văn E</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Rất đẹp, đáng giá tiền. Tôi sẽ giới thiệu bạn bè đến đây.”
                        </p>
                    </div>
                </div>

                <!-- Slide 6 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1721131162476-9dcc47328755?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Lý Thị F"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Lý Thị F</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-muted"></i>
                                    <i class="bi bi-star text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Không gian yên tĩnh, tiện nghi đầy đủ, tôi rất hài lòng với
                            khách sạn.”</p>
                    </div>
                </div>

                <!-- Slide 7 -->
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://plus.unsplash.com/premium_vector-1731922571927-ac1d331d87e3?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="rounded-circle me-3" alt="Đặng Văn G"
                                style="width:50px; height:50px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Đặng Văn G</h6>
                                <div>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <p class="flex-grow-1 ">“Phòng rộng rãi, view đẹp, tôi sẽ quay lại lần nữa.”</p>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination mt-3"></div>
        </div>
    </div>


    <!-- Contact us -->
    <?php
    $contact_q = "SELECT `cr_no`, `address`, `phone1`, `phone2`, `ggmap`, `email`, `fb`, `github`, `iframe` FROM `contact_detail` WHERE 1";
    $contact_r = mysqli_fetch_assoc(mysqli_query($con, $contact_q));
    ?>

    <div class="container-fluid">
        <h1 class="text-center mt-5 pt-4 mb-5 h-font">Liên hệ với chúng tôi</h1>
        <div class="container">
            <div class="row">
                <!-- Bản đồ -->
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                    <iframe class="w-100 rounded" <?= $contact_r['iframe']; ?> height="350" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Thông tin liên hệ -->
                <div class="col-lg-4 col-md-4">
                    <?php if (!empty($contact_r['phone1']) || !empty($contact_r['phone2']) || !empty($contact_r['address'])): ?>
                        <div class="bg-white p-4 rounded mb-4">
                            <h2>Liên hệ trực tiếp</h2>
                            <?php if (!empty($contact_r['phone1'])): ?>
                                <a href="tel:<?= htmlspecialchars($contact_r['phone1']); ?>"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-telephone-fill me-2"></i><?= htmlspecialchars($contact_r['phone1']); ?>
                                </a><br>
                            <?php endif; ?>
                            <?php if (!empty($contact_r['phone2'])): ?>
                                <a href="tel:<?= htmlspecialchars($contact_r['phone2']); ?>"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-telephone-fill me-2"></i><?= htmlspecialchars($contact_r['phone2']); ?>
                                </a><br>
                            <?php endif; ?>
                            <?php if (!empty($contact_r['address'])): ?>
                                <a href="<?= htmlspecialchars($contact_r['ggmap']); ?>" target="_blank"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-geo-alt-fill me-2"></i><?= htmlspecialchars($contact_r['address']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($contact_r['email']) || !empty($contact_r['fb']) || !empty($contact_r['github'])): ?>
                        <div class="bg-white p-4 rounded mb-4">
                            <h2>Mạng xã hội & Email</h2>
                            <?php if (!empty($contact_r['fb'])): ?>
                                <a href="<?= htmlspecialchars($contact_r['fb']); ?>" target="_blank"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-facebook me-2"></i>Facebook
                                </a><br>
                            <?php endif; ?>
                            <?php if (!empty($contact_r['email'])): ?>
                                <a href="mailto:<?= htmlspecialchars($contact_r['email']); ?>"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-envelope-at-fill me-2"></i><?= htmlspecialchars($contact_r['email']); ?>
                                </a><br>
                            <?php endif; ?>
                            <?php if (!empty($contact_r['github'])): ?>
                                <a href="<?= htmlspecialchars($contact_r['github']); ?>" target="_blank"
                                    class="d-inline-block mb-2 text-decoration-none text-dark">
                                    <i class="bi bi-github me-2"></i>Github
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require("inc/footer.php");
    require("inc/scripts.php");
    ?>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,

            }
        });
        var swiper = new Swiper(".mySwiperCoverFlow", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 3,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
            }
        });
    </script>
</body>

</html>