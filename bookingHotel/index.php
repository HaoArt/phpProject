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
    <div class="container-fluid">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                // Chạy truy vấn 1 lần duy nhất
                $banner_q = "SELECT * FROM banner_carousel";
                $banner_r = mysqli_query($con, $banner_q);

                // Nếu có dữ liệu
                if (mysqli_num_rows($banner_r) > 0) {
                    while ($row = mysqli_fetch_assoc($banner_r)) {
                        $img = htmlspecialchars($row['img_banner']);
                        if ($img == '') {
                            $img = "default.jpg";
                        }
                ?>
                <div class="swiper-slide">
                    <img src="./admin/<?php echo "$img"; ?>" alt="" class="w-100 d-block"
                        style="height:460px; object-fit:cover;">
                </div>
                <?php
                    }
                } else {
                    echo '<p class="text-center text-muted w-100">Chưa có ảnh bìa nào.</p>';
                }
                ?>

            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div> -->
        </div>
    </div>
    <!-- Form booking -->
    <div class="container mt-lg-3  ">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded g-1">
                <h5>Đặt phòng bất cứ đâu</h5>
                <form>
                    <div class="row g-3">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-bold">Ngày nhận phòng</label>
                            <input type="date" class="form-control" id="checkin" name="checkin"
                                min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-bold">Ngày trả phòng</label>
                            <input type="date" class="form-control" id="checkout" name="checkout"
                                min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label fw-bold">Người lớn</label>
                            <select class="form-select" name="adults">
                                <option value="" selected disabled>Chọn số người</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label fw-bold">Trẻ em</label>
                            <select class="form-select" name="children">
                                <option value="" selected disabled>Chọn số người</option>
                                <?php for ($i = 0; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-lg-2 d-grid mb-lg-3">
                            <a href="rooms.php" class="btn button_bg_custom w-100 py-3">Đăng ký</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Our rooms -->
    <div class="container-fluid">
        <h1 class="text-center mt-5 pt-4 mb-5 h-font">Phòng</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 my-3">
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
                                <!-- <i class="bi bi-star-half rating"></i> -->
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
                </div>
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
            <div class="row justify-content-evenly px-lg-0 px-md-0 ">
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
                    <img src="images/features/6.svg" alt="" width="80px">
                    <h5>Lò sửi</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
                    <img src="images/features/2.svg" alt="" width="80px">
                    <h5>TV</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
                    <img src="images/features/3.svg" alt="" width="80px">
                    <h5>Wifi</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
                    <img src="images/features/4.svg" alt="" width="80px">
                    <h5>Massage</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
                    <img src="images/features/5.svg" alt="" width="80px">
                    <h5>Điều hòa</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- ReComment -->
    <div class="container">
        <h1 class="text-center mt-5 mb-5 pt-4 h-font">Phản hồi của khách hàng</h1>
        <div class="swiper mySwiperCoverFlow">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-white flex-column p-4">
                    <div class="profile text-center d-flex align-items-center p-4 ">
                        <img src="images/about/rating.svg" alt="" style="display: block;width:30px">
                        <h6 class="m-0 ms-2">User random1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas perferendis minus consectetur
                        facere dolores sunt temporibus aspernatur dignissimos ipsa porro eos, magni molestiae quo
                        reiciendis ea quia quis dicta rerum.
                    </p>
                    <div class=" mb-3">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <!-- <i class="bi bi-star-half rating"></i> -->
                        <!-- <i class="bi bi-star"></i> -->
                    </div>
                </div>
                <div class="swiper-slide bg-white flex-column p-4">
                    <div class="profile text-center d-flex align-items-center p-4 ">
                        <img src="images/about/rating.svg" alt="" style="display: block;width:30px">
                        <h6 class="m-0 ms-2">User random1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas perferendis minus consectetur
                        facere dolores sunt temporibus aspernatur dignissimos ipsa porro eos, magni molestiae quo
                        reiciendis ea quia quis dicta rerum.
                    </p>
                    <div class=" mb-3">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <!-- <i class="bi bi-star-half rating"></i> -->
                        <!-- <i class="bi bi-star"></i> -->
                    </div>
                </div>
                <div class="swiper-slide bg-white flex-column p-4">
                    <div class="profile text-center d-flex align-items-center p-4 ">
                        <img src="images/about/rating.svg" alt="" style="display: block;width:30px">
                        <h6 class="m-0 ms-2">User random1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas perferendis minus consectetur
                        facere dolores sunt temporibus aspernatur dignissimos ipsa porro eos, magni molestiae quo
                        reiciendis ea quia quis dicta rerum.
                    </p>
                    <div class=" mb-3">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <!-- <i class="bi bi-star-half rating"></i> -->
                        <!-- <i class="bi bi-star"></i> -->
                    </div>
                </div>
                <div class="swiper-slide bg-white flex-column p-4">
                    <div class="profile text-center d-flex align-items-center p-4 ">
                        <img src="images/about/rating.svg" alt="" style="display: block;width:30px">
                        <h6 class="m-0 ms-2">User random1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas perferendis minus consectetur
                        facere dolores sunt temporibus aspernatur dignissimos ipsa porro eos, magni molestiae quo
                        reiciendis ea quia quis dicta rerum.
                    </p>
                    <div class=" mb-3">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <!-- <i class="bi bi-star-half rating"></i> -->
                        <!-- <i class="bi bi-star"></i> -->
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- Contact us -->
    <div class="container-fluid">
        <h1 class="text-center mt-5 pt-4 mb-5 h-font">Liên hệ với chúng tôi</h1>
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white  rounded">
                    <iframe class="w-100 rounded"
                        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d102927.80889707133!2d107.56442275362377!3d16.522180408741516!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1759967677617!5m2!1sen!2s"
                        height="350" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="bg-white p-4 rounded mb-4">
                        <h2>Liên hệ ngay</h2>
                        <a href="#tel: 1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i>1234567890
                        </a>
                        <br>
                        <a href="#tel: 1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i>0123456789
                        </a>
                    </div>
                    <div class="bg-white p-4 rounded mb-4">
                        <h2>Liên hệ ngay</h2>
                        <a href="#tel: 1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-facebook"></i>Hoàng Nhật hào
                        </a>
                        <br>
                        <a href="#tel: 1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-envelope-at-fill"></i>nhathaohoang171@gmail.com
                        </a>
                        <br>
                        <a href="#tel: 1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-github"></i>HaoArt
                        </a>
                    </div>
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