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
</head>

<body style="background-color: #f5f5f5;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php require("inc/header.php") ?>


    <div class="my-5 px-4">
        <h2 class="h-font fw-bold text-center">Phòng nghỉ của chúng tôi</h2>

        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente harum, atque error
            porro consequuntur saepe
            nostrum optio, explicabo dolorem sunt quam sint pariatur voluptatem eligendi qui tempora eius eum tempore?
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4">
                <!-- <nav class="navbar navbar-expand-lg bg-white bg-body-tertiary">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h5 class="mt-3">Tìm phòng phù hợp</h5>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse  flex-column align-items-stretch " id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-5">Kiểm tra phòng trống</h5>
                                <label class="form-label">Ngày nhận </label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">Ngày trả </label>
                                <input type="date" class="form-control shadow-none mb-3">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-5">Chọn cơ sở</h5>
                                <div class="mb-1">
                                    <input class="form-check-input" type="checkbox" value="" id="f1">
                                    <label class="form-check-label" for="f1">
                                        Cơ sở 1
                                    </label>
                                </div>
                                <div class="mb-1">
                                    <input class="form-check-input" type="checkbox" value="" id="f2">
                                    <label class="form-check-label" for="f2">
                                        Cơ sở 2
                                    </label>
                                </div>
                                <div class="mb-1">
                                    <input class="form-check-input" type="checkbox" value="" id="f3">
                                    <label class="form-check-label" for="f3">
                                        Cơ sở 3
                                    </label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-5">Số lượng khách</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Người lớn </label>
                                        <input type="number" class="form-control shadow-none mb-3">
                                    </div>
                                    <div class="">
                                        <label class="form-label">Trẻ em</label>
                                        <input type="number" class="form-control shadow-none mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav> -->
                <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3 fw-bold">Ưu điểm nổi bật</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Phòng sạch sẽ, tiện nghi đầy đủ</li>
                        <li class="list-group-item">View sông Hương tuyệt đẹp</li>
                        <li class="list-group-item">Nhân viên thân thiện, phục vụ 24/7</li>
                        <li class="list-group-item">Đặt phòng nhanh chóng, dễ dàng</li>
                    </ul>
                </div>

            </div>
            <div class="col-lg-9 col-md-12 px-4">
                <div id="room-list"></div>
                <div class="text-center mt-4">
                    <button id="loadMore" class="btn btn-primary">Xem thêm</button>
                </div>

            </div>

        </div>
    </div>
    <?php require("inc/footer.php")
    ?>
    <?php require("inc/scripts.php"); ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let offset = 0;
            const limit = 3;
            const btn = document.getElementById("loadMore");
            const container = document.getElementById("room-list");

            // Hàm load phòng
            const loadRooms = () => {
                fetch("ajax/load_rooms.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "offset=" + offset
                    })
                    .then(res => res.text())
                    .then(data => {
                        if (!data) return;

                        if (data.includes("__NO_MORE__")) {
                            btn.style.display = "none";
                            data = data.replace("__NO_MORE__", "");
                        }

                        container.insertAdjacentHTML("beforeend", data);
                        offset += limit;
                    });
            };

            // Load 5 phòng đầu tiên khi trang load
            loadRooms();

            // Load thêm khi click nút
            btn.addEventListener("click", loadRooms);
        });
    </script>

</body>

</html>