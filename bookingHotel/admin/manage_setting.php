<?php
require("inc/essentials.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CÀI ĐẶT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>
    <!-- general setting -->
    <div class="container-fluid z-0">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card z-0">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title">Cài đặt tổng quang</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Tiêu đề trang</h6>
                        <p class="card-text" id="site_title">content</p>
                        <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Về chúng tôi</h6>
                        <p class="card-text" id="site_about">content</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact setting -->
    <div class="container-fluid z-0">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card z-0">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title">Cài đặt liên hệ</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#contact-s">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Địa chỉ</h6>
                                <p class="card-text" id="address">content</p>
                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Điện thoại</h6>
                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-telephone-fill"></i>
                                    <p class="ms-2" id="phone1">content</p>
                                </div>

                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-telephone-fill"></i>
                                    <p class="ms-2" id="phone2">content</p>
                                </div>
                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">GG map</h6>
                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <p class="ms-2" id="ggmap"> content</p>
                                </div>
                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Email</h6>
                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-envelope-at-fill me-2"></i>
                                    <p class="ms-2" id="email">content</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Mạng xã hội</h6>
                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-facebook  me-2"></i>
                                    <p class="ms-2" id="fb">Hoàng Nhật hào</p>
                                </div>
                                <div class="card-text d-flex overflow-x-hidden">
                                    <i class="bi bi-github  me-2"></i>
                                    <p class="ms-2" id="github">HaoArt</p>
                                </div>

                                <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">iframe</h6>
                                <iframe class="w-100 rounded border" height="200" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade" id="iframe" src=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- manager team -->
    <div class="container-fluid z-0">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card z-0">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title">Thành viên phát triển</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#manager-s">
                                <i class="bi bi-plus-circle"></i> Thêm thành viên
                            </button>
                        </div>
                        <div class="row " id="manager-data">
                            <div class="col-md-2">
                                <div class="card shadow-sm">
                                    <img src="" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <p class="card-text fw-bold mb-2">Hoang Nhat Hao</p>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal">
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
    <!-- modal  general-->
    <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cài đặt tổng quát</h1>
                        <button type="button" class="btn-close" onclick="resetFormGeneral()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">Tiêu đề trang </label>
                            <input type="text" name="name" id="site_title_ipt" required
                                class="form-control shadow-none">
                        </div>
                        <div class="col-md-12 ps-0 mb-3">
                            <label class="form-label">Về chúng tôi</label>
                            <textarea class="form-control " rows="6" aria-label="With textarea" name="address"
                                id="site_about_ipt" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="resetFormGeneral()" class="btn btn-danger"
                            data-bs-dismiss="modal">Hủy</button>
                        <button type="button" onclick="updateGeneral()" class="btn btn-success">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal  contact-->
    <div class="modal fade" id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cài đặt liên hệ</h1>
                        <button type="button" class="btn-close" onclick="resetFormContact()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 ps-0 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control " rows="2" aria-label="With textarea" name="address"
                                id="address_ipt" required></textarea>
                        </div>
                        <div class="col-md-12 ps-0 mb-3">
                            <label class="form-label">Iframe SRC</label>
                            <textarea class="form-control " rows="3" aria-label="With textarea" name="address"
                                id="iframe_ipt" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-md-6 ps-0 mb-3 w-100">
                                    <label class="form-label">Điện thoại 1 </label>
                                    <div class="d-flex">
                                        <i class="bi bi-telephone-fill me-2"></i>
                                        <input type="text" name="name" id="phone1_ipt" required
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3 w-100">
                                    <label class="form-label">Điện thoại 2 </label>
                                    <div class="d-flex">
                                        <i class="bi bi-telephone-fill me-2"></i>
                                        <input type="text" name="name" id="phone2_ipt" required
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3 w-100">
                                    <label class="form-label">Google map</label>
                                    <div class="d-flex">
                                        <i class="bi bi-geo-alt-fill me-2"></i>
                                        <input type="text" name="name" id="ggmap_ipt" required
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-md-6 ps-0 mb-3 w-100">
                                    <label class="form-label">Email </label>
                                    <div class="d-flex">
                                        <i class="bi bi-envelope-at-fill me-2"></i>
                                        <input type="text" name="name" required id="email_ipt"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3  w-100">
                                    <label class="form-label">Facebook</label>
                                    <div class="d-flex">
                                        <i class="bi bi-facebook  me-2"></i>
                                        <input type="text" name="name" required id="fb_ipt"
                                            class="form-control shadow-none">
                                    </div>

                                </div>
                                <div class="col-md-6 ps-0 mb-3 w-100">
                                    <label class="form-label">Github</label>
                                    <div class="d-flex">
                                        <i class="bi bi-github  me-2"></i>
                                        <input type="text" name="name" required id="github_ipt"
                                            class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="resetFormContact()" class="btn btn-danger"
                            data-bs-dismiss="modal">Hủy</button>
                        <button type="button" onclick="updateContact()" class="btn btn-success">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal  manager-->
    <div class="modal fade" id="manager-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm thành viên</h1>
                        <button type="button" class="btn-close" onclick="resetFormManager()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class=" col-md-6 ps-0 mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="name" id="name_manager_ipt" required
                                    class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Ảnh của thành viên</label>
                                <input type="file" name="name" id="img_manager_ipt" required
                                    class="form-control shadow-none" accept=".jpg, .png, .webp, .jpeg">
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormManager()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" onclick="addManager()" class="btn btn-success">Xác nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- modal delete  manager-->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn có chắc muốn xóa người quản lý <span class="fw-semibold" id="name-manager-modal">Hoang Nhat
                        Hao</span> không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteManagerBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <?php require("inc/scripts.php") ?>
    <script src="scripts/settings.js"></script>
</body>

</html>