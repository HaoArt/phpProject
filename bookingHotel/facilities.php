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
    <?php require("inc/links.php") ?>
    <!-- Swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="background-color: #f5f5f5;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php require("inc/header.php") ?>


    <div class="my-5 px-4">
        <h2 class="h-font fw-bold text-center">Về cơ sở vật chất</h2>
        <div class="h-line bg-dark mx-auto mb-3" style="width:60px; height:4px;"></div>
        <p class="text-center text-muted fs-6 mb-5">
            Chúng tôi cung cấp những tiện nghi hiện đại, phục vụ tốt nhất cho kỳ nghỉ của bạn tại khách sạn Huế.
        </p>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2  mb-5 row-cols-lg-3 g-4">
            <?php
            $q = "SELECT * FROM facilities ORDER BY cr_no DESC";
            $r = mysqli_query($con, $q);
            if (mysqli_num_rows($r) > 0) {
                while ($row = mysqli_fetch_assoc($r)) {
                    $name = htmlspecialchars($row['name']);
                    $icon = htmlspecialchars($row['icon']);
                    $des = htmlspecialchars($row['description']);
            ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm p-3 pop bg-white rounded-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:60px; height:60px;">
                            <img src="./admin/<?php echo $icon ?>" alt="<?php echo $name ?>" class="img-fluid"
                                style="width:30px; height:30px;">
                        </div>
                        <h5 class="card-title mb-0"><?php echo $name ?></h5>
                    </div>
                    <p class="card-text text-muted"><?php echo $des ?></p>
                </div>
            </div>
            <?php }
            } ?>
        </div>
        <div class="row">
            <div id="facilityCarousel" class="carousel slide my-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1613192195514-6ae0febccc29?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="d-block w-100 rounded" alt="Hồ bơi" style="height:400px; object-fit:cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1670004810567-f4328dcc983e?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="d-block w-100 rounded" alt="Phòng gym" style="height:400px; object-fit:cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1636829501397-2df309005dce?q=80&w=1175&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="d-block w-100 rounded" alt="Nhà hàng" style="height:400px; object-fit:cover;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#facilityCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#facilityCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>


        </div>
        <div class="row">
            <div class="container my-5">
                <div class="row text-center g-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm p-3 h-100">
                            <i class="bi bi-stars fs-1 text-warning"></i>
                            <h6 class="mt-2 fw-bold">Phòng sạch sẽ</h6>
                            <p class="text-muted">Tiện nghi hiện đại, sạch sẽ từng góc nhỏ.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm p-3 h-100">
                            <i class="bi bi-geo-alt fs-1 text-primary"></i>
                            <h6 class="mt-2 fw-bold">View sông Hương</h6>
                            <p class="text-muted">Khung cảnh thơ mộng, thư giãn tuyệt đối.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm p-3 h-100">
                            <i class="bi bi-people fs-1 text-success"></i>
                            <h6 class="mt-2 fw-bold">Nhân viên thân thiện</h6>
                            <p class="text-muted">Phục vụ tận tình 24/7.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm p-3 h-100">
                            <i class="bi bi-phone fs-1 text-danger"></i>
                            <h6 class="mt-2 fw-bold">Đặt phòng dễ dàng</h6>
                            <p class="text-muted">Giao diện trực quan, đặt phòng chỉ vài bước.</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <?php require("inc/footer.php");
    require("inc/scripts.php");
    ?>

</body>

</html>