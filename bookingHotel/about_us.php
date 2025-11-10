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
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente harum, atque error
            porro consequuntur saepe
            nostrum optio, explicabo dolorem sunt quam sint pariatur voluptatem eligendi qui tempora eius eum tempore?
        </p>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center    ">
            <div class="col-lg-6 col-md-5 mb-4 px-4 order-lg-1 order-md-2 order-2">
                <div class="">
                    <h3 class="mb-3 text-center">Lorem ipsum dolor sit .</h3>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque amet
                        nostrum aliquid
                        cupiditate, fugit, voluptates suscipit, velit nihil officia magni consequatur autem
                        necessitatibus adipisci. Omnis eum ratione assumenda non voluptatem?</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 px-4 order-lg-2 order-md-1 order-1">
                <img src="images/about/about.jpg" alt="" class="w-100">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" alt="" class="w-25">
                    <p class="fw-bolder fs-5 mt-3">100+ Phòng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" alt="" class="w-25">
                    <p class="fw-bolder fs-5 mt-3">1K+ Khách hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" alt="" class="w-25">
                    <p class="fw-bolder fs-5 mt-3">300+ Đánh giá tốt</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" alt="" class="w-25">
                    <p class="fw-bolder fs-5 mt-3">100+ Nhân viên</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4">
        <h2 class="h-font fw-bold text-center">Đội ngũ phát triển</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                // Chạy truy vấn 1 lần duy nhất
                $manager_q = "SELECT * FROM manager_team";
                $manager_r = mysqli_query($con, $manager_q);

                // Nếu có dữ liệu
                if (mysqli_num_rows($manager_r) > 0) {
                    while ($row = mysqli_fetch_assoc($manager_r)) {
                        $name = htmlspecialchars($row['name_manager']);
                        $img = htmlspecialchars($row['img_manager']);
                        if ($img == '') {
                            $img = "default.jpg"; // nhớ có ảnh này trong thư mục
                        }
                ?>
                        <div class="swiper-slide bg-white text-center overflow-hidden rounded d-flex flex-column">
                            <img src="./admin/<?php echo "$img"; ?>" alt="$name" class="img-fluid w-100"
                                style="height:250px; object-fit:cover;">
                            <h3 class="mt-2"><?php echo "$name"; ?></h3>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="text-center text-muted w-100">Chưa có thành viên nào trong đội ngũ quản lý.</p>';
                }
                ?>
            </div>

            <div class="swiper-pagination "></div>
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