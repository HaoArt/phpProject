<?php
require("inc/essentials.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>

    <!-- manager team -->
    <div class="container-fluid z-0">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card z-0">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title">Đặc trưng</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#features-s">
                                <i class="bi bi-plus-circle"></i> Thêm đặc trưng
                            </button>
                        </div>
                        <div class="row " id="banner-data">
                            <div class="col-md-2">
                                <div class="card shadow-sm">
                                    <img src="" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteBanner">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal  manager-->
    <div class="modal fade" id="features-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm đặc trưng</h1>
                        <button type="button" class="btn-close" onclick="resetFormBanner()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Ảnh bìa</label>
                                <input type="file" name="name" id="img_banner_ipt" required
                                    class="form-control shadow-none" accept=".jpg, .png, .webp, .jpeg">
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormManager()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" onclick="addBanner()" class="btn btn-success">Xác nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- modal delete  manager-->
    <div class="modal fade" id="confirmDeleteBanner" tabindex="-1" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn có chắc muốn xóa ảnh bìa này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBannerBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <?php require("inc/scripts.php") ?>
    <!-- <script src="scripts/settings.js"></script> -->
    <script src="scripts/carousel.js"></script>
</body>

</html>