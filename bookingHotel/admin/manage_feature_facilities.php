<?php
require("inc/essentials.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ĐĂC TRƯNG VÀ TIỆN NGHI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>


    <div class="container-fluid z-0">
        <!-- features-->
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
                        <div class="row ">
                            <div class="table-responsive shadow-sm rounded-3">
                                <table class="table table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="features-data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- facilities-->
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card z-0">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title">Tiện nghi</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#facilities-s">
                                <i class="bi bi-plus-circle"></i> Thêm tiện nghi
                            </button>
                        </div>
                        <div class="row ">
                            <div class="table-responsive shadow-sm rounded-3">
                                <table class="table table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            <th>Icon</th>
                                            <th>Mô tả</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="facilities-data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal  features-->
    <div class="modal fade" id="features-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm đặc trưng</h1>
                        <button type="button" class="btn-close" onclick="resetFormFeature()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Đặc trưng</label>
                                <input type="text" name="name_feature_ipt" id="name_feature_ipt" required
                                    class="form-control shadow-none">
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormFeature()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" onclick="addFeature()" class="btn btn-success">Xác nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- modal  facilities-->
    <div class="modal fade" id="facilities-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm tiện nghi</h1>
                        <button type="button" class="btn-close" onclick="resetFormFacilities()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name_facilities" id="name_facilities" required
                                    class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Icon</label>
                                <input type="file" name="icon_facilities" id="icon_facilities" required
                                    class="form-control shadow-none" accept=".svg">
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control " rows="2" aria-label="With textarea"
                                    name="description_facilities" id="description_facilities" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormFacilities()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" onclick="addFacilities()" class="btn btn-success">Xác
                                    nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- modal  update features-->
    <div class="modal fade" id="confirmUpdateFeature" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm đặc trưng</h1>
                        <button type="button" class="btn-close" onclick="resetFormFeature()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Đặc trưng</label>
                                <input type="text" name="name_feature_update_ipt" id="name_feature_update_ipt" required
                                    class="form-control shadow-none">
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormFeature()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" id="confirmUpdateFeatureBtn" class="btn btn-success">Xác
                                    nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- modal delete feature-->
    <div class="modal fade" id="confirmDeleteFeature" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn có chắc muốn xóa đặc trưng này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteFeatureBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal  update facilities-->
    <div class="modal fade" id="confirmUpdateFacilities" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm đặc trưng</h1>
                        <button type="button" class="btn-close" onclick="resetFormFacilities()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" onsubmit="event.preventDefault()">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name_facilities_update" id="name_facilities_update" required
                                    class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Icon</label>
                                <img id="current_icon_facilities" src="" alt="Icon hiện tại"
                                    style="width:40px;height:40px;object-fit:contain;">
                                <input type="file" id="icon_facilities_update" accept=".svg">

                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control " rows="2" aria-label="With textarea"
                                    name="description_facilities_update" id="description_facilities_update"
                                    required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="resetFormFacilities()" class="btn btn-danger"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="button" id="confirmUpdateFacilitiesBtn" class="btn btn-success">Xác
                                    nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- modal delete facilities-->
    <div class="modal fade" id="confirmDeleteFacilities" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn có chắc muốn xóa tiện nghi này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteFacilitiesBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <?php require("inc/scripts.php") ?>
    <!-- <script src="scripts/settings.js"></script> -->
    <script src="scripts/features_facilities.js"></script>
</body>

</html>