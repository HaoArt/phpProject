<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Huế Hotel - Cơ sở vật chất</title>
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


    <div class="my-5 px-4">
        <h2 class="h-font fw-bold text-center">Về chúng tôi</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Huế Hotel tự hào mang đến cho khách hàng những trải nghiệm nghỉ dưỡng tuyệt vời ngay
            tại trung tâm thành phố.
            Với đội ngũ nhân viên thân thiện, phòng ốc sạch sẽ và tiện nghi hiện đại, chúng tôi luôn nỗ lực để mỗi
            khoảnh khắc của bạn tại khách sạn đều trở nên đáng nhớ. Từ dịch vụ đặt phòng nhanh chóng, tiện lợi cho đến
            các tiện ích bổ sung như nhà hàng, hồ bơi và phòng gym, Huế Hotel cam kết mang lại sự thoải mái và hài lòng
            tối đa cho mọi du khách. Hãy đến và trải nghiệm sự khác biệt của chúng tôi!
        </p>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 px-4 order-lg-1 order-md-2 order-2">
                <div>
                    <h3 class="mb-3 text-center">Người sáng lập Huế Hotel</h3>
                    <p class="text-center">
                        Khách sạn Huế được thành lập bởi một người đam mê du lịch và dịch vụ, luôn mong muốn mang đến
                        cho du khách những trải nghiệm nghỉ dưỡng đáng nhớ tại thành phố Huế. Với tâm huyết và kinh
                        nghiệm trong ngành khách sạn, người sáng lập đã đặt nền móng cho một môi trường phục vụ tận
                        tình,
                        thân thiện và chuyên nghiệp. Tầm nhìn của ông là biến Huế Hotel trở thành điểm đến lý tưởng cho
                        mọi khách hàng, nơi mà mỗi kỳ nghỉ đều là một kỷ niệm khó quên.
                    </p>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 px-4 order-lg-2 order-md-1 order-1">
                <img src="images/about/about.jpg" alt="Người sáng lập" class="w-100 rounded shadow">
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6">
                <div
                    class="bg-white rounded shadow-sm p-4 border-top border-4 border-primary h-100 d-flex flex-column align-items-center justify-content-center stats-box">
                    <img src="images/about/hotel.svg" alt="Phòng" class="w-25 mb-3">
                    <p class="fw-bolder fs-5 mb-0">100+ Phòng</p>
                    <small class="text-muted">Đầy đủ tiện nghi, đa dạng loại phòng</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                    class="bg-white rounded shadow-sm p-4 border-top border-4 border-success h-100 d-flex flex-column align-items-center justify-content-center stats-box">
                    <img src="images/about/customers.svg" alt="Khách hàng" class="w-25 mb-3">
                    <p class="fw-bolder fs-5 mb-0">1K+ Khách hàng</p>
                    <small class="text-muted">Hài lòng và quay lại nhiều lần</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                    class="bg-white rounded shadow-sm p-4 border-top border-4 border-warning h-100 d-flex flex-column align-items-center justify-content-center stats-box">
                    <img src="images/about/rating.svg" alt="Đánh giá" class="w-25 mb-3">
                    <p class="fw-bolder fs-5 mb-0">300+ Đánh giá tốt</p>
                    <small class="text-muted">Khách hàng đánh giá cao dịch vụ</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                    class="bg-white rounded shadow-sm p-4 border-top border-4 border-danger h-100 d-flex flex-column align-items-center justify-content-center stats-box">
                    <img src="images/about/staff.svg" alt="Nhân viên" class="w-25 mb-3">
                    <p class="fw-bolder fs-5 mb-0">100+ Nhân viên</p>
                    <small class="text-muted">Đội ngũ chuyên nghiệp, thân thiện</small>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 my-5">
        <h2 class="h-font fw-bold text-center">Đội ngũ phát triển</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                $manager_q = "SELECT * FROM manager_team";
                $manager_r = mysqli_query($con, $manager_q);

                if (mysqli_num_rows($manager_r) > 0) {
                    while ($row = mysqli_fetch_assoc($manager_r)) {
                        $name = htmlspecialchars($row['name_manager']);
                        $position = htmlspecialchars($row['position'] ?? 'Nhân viên'); // nếu có cột position
                        $img = htmlspecialchars($row['img_manager']);
                        if ($img == '') $img = "default.jpg";
                ?>
                <div
                    class="swiper-slide bg-white text-center overflow-hidden rounded d-flex flex-column align-items-center justify-content-start p-3 team-slide">
                    <div class="team-img-wrapper mb-2">
                        <img src="./admin/<?php echo $img; ?>" alt="<?php echo $name; ?>"
                            class="img-fluid w-100 rounded" style="height:250px; object-fit:cover;">
                    </div>
                    <h5 class="fw-bold mt-2"><?php echo $name; ?></h5>
                    <small class="text-muted"><?php echo $position; ?></small>
                </div>
                <?php
                    }
                } else {
                    echo '<p class="text-center text-muted w-100">Chưa có thành viên nào trong đội ngũ quản lý.</p>';
                }
                ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php require("inc/footer.php");
    require("inc/scripts.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 40,
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