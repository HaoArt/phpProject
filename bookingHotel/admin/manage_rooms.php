<?php
require("inc/essentials.php");
require("inc/db_config.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHÒNG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>


    <div class="container-fluid z-0">
        <!-- rooms-->
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <div class="card shadow-sm border-0">

                    <!-- Header card -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Phòng</h5>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                            data-bs-target="#rooms-s">
                            <i class="bi bi-plus-circle"></i> Thêm Phòng
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <div class="table-responsive shadow-sm rounded-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Diện tích</th>
                                        <th>Số khách</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="rooms-data">
                                    <!-- Dữ liệu sẽ load từ JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- modal  rooms-->
    <div class="modal fade" id="rooms-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" onsubmit="event.preventDefault()">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm Phòng</h1>
                        <button type="button" class="btn-close btn-close-red" onclick="resetFormRoom()"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên phòng</label>
                                <input type="text" id="room_name" name="room_name" class="form-control shadow-none"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diện tích (m²)</label>
                                <input type="number" id="room_area" name="room_area" class="form-control shadow-none"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="room_price" name="room_price" class="form-control shadow-none"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="number" id="room_quantity" name="room_quantity"
                                    class="form-control shadow-none" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Người lớn (tối đa)</label>
                                <input type="number" id="room_adult" name="room_adults" class="form-control shadow-none"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trẻ em (tối đa)</label>
                                <input type="number" id="room_children" name="room_children"
                                    class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Đặc trưng</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    if ($res) {
                                        while ($opt = mysqli_fetch_assoc($res)) {
                                            $id = htmlspecialchars($opt['cr_no']);
                                            $name = htmlspecialchars($opt['name']);
                                    ?>
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input shadow-none" type="checkbox"
                                                        name="features[]" id="feature-<?php echo $id; ?>"
                                                        value="<?php echo $id; ?>">
                                                    <label class="form-check-label" for="feature-<?php echo $id; ?>">
                                                        <?php echo $name; ?>
                                                    </label>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<div class='text-danger'>Không có đặc trưng nào</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tiện nghi</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    if ($res) {
                                        while ($opt = mysqli_fetch_assoc($res)) {
                                            $id = htmlspecialchars($opt['cr_no']);
                                            $name = htmlspecialchars($opt['name']);
                                    ?>
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input shadow-none" type="checkbox"
                                                        name="facilities[]" id="facilities-<?php echo $id; ?>"
                                                        value="<?php echo $id; ?>">
                                                    <label class="form-check-label" for="facilities-<?php echo $id; ?>">
                                                        <?php echo $name; ?>
                                                    </label>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<div class='text-danger'>Không có tiện nghi nào</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control " rows="2" aria-label="With textarea"
                                    name="room_description" id="room_description" required></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="resetFormRoom()" class="btn btn-danger" data-bs-dismiss="modal">
                            Hủy
                        </button>
                        <button type="button" onclick="addRoom()" class="btn btn-success">
                            Xác nhận
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- modal update room -->
    <div class="modal fade" id="editRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editRoomForm" onsubmit="event.preventDefault()">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="modal-title" id="editRoomModalLabel">Chỉnh sửa phòng</h5>
                        <button type="button" class="btn-close btn-close-red" data-bs-dismiss="modal"
                            onclick="resetFormRoom()"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Hidden ID -->
                        <input type="hidden" id="room_id_ipt">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tên phòng</label>
                                <input type="text" id="room_name_ipt" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Diện tích (m²)</label>
                                <input type="number" id="room_area_ipt" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="room_price_ipt" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Số lượng</label>
                                <input type="number" id="room_quantity_ipt" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Người lớn</label>
                                <input type="number" id="room_adult_ipt" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Trẻ em</label>
                                <input type="number" id="room_children_ipt" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Mô tả</label>
                                <textarea id="room_description_ipt" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <select id="room_status_ipt" class="form-select">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Tạm ngưng</option>
                                </select>
                            </div>

                            <!-- Features -->
                            <div class="col-12 mt-3">
                                <label class="form-label">Đặc trưng</label>
                                <div class="row" id="features_box_ipt"></div>
                            </div>

                            <!-- Facilities -->
                            <div class="col-12 mt-3">
                                <label class="form-label">Tiện nghi</label>
                                <div class="row" id="facilities_box_ipt"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="resetFormRoom()">Hủy</button>
                        <button type="button" class="btn btn-success" onclick="saveRoomChanges()">
                            Lưu thay đổi
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal Thêm Ảnh -->
    <div class="modal fade" id="addImagesModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="addImagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="addImagesForm" onsubmit="event.preventDefault()" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="modal-title" id="addImagesModalLabel">Thêm ảnh phòng</h5>
                        <button type="button" class="btn-close btn-close-red" data-bs-dismiss="modal"
                            onclick="resetAddImagesForm()"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="img_room_id" name="room_id">
                        <div class="mb-3">
                            <label class="form-label">Chọn ảnh</label>
                            <input type="file" name="images[]" id="room_images" class="form-control" multiple required>
                        </div>
                        <div id="preview_images" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="resetAddImagesForm()">Hủy</button>
                        <button type="button" class="btn btn-success" onclick="addRoomImage()">Upload ảnh</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php require("inc/scripts.php") ?>
    <!-- <script src="scripts/settings.js"></script> -->
    <script src="scripts/rooms.js"></script>
</body>

</html>