<?php
ob_clean();
require("../inc/db_config.php");
// banner 
if (isset($_POST['add_banner'])) {
    $img_path = '';

    if (isset($_FILES['img_banner']) && $_FILES['img_banner']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['img_banner']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['img_banner']['name']);

        // thư mục lưu trong DB (tương đối từ admin/)
        $upload_dir = "uploads/banner/";

        // đường dẫn vật lý thật trên server
        $target_dir = dirname(__DIR__) . "/" . $upload_dir;
        // => bookingHotel/admin/uploads/managers/

        // tạo thư mục nếu chưa tồn tại
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // đường dẫn file thực tế
        $target_path = $target_dir . $file_name;
        // đường dẫn lưu trong DB (để show ảnh)
        $img_path = $upload_dir . $file_name;

        if (!move_uploaded_file($file_tmp, $target_path)) {
            echo json_encode(["success" => false, "message" => "Không thể upload ảnh."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Ảnh không hợp lệ."]);
        exit;
    }
    // Lưu vào DB
    $query = "INSERT INTO banner_carousel ( img_banner) VALUES ( '$img_path')";
    $res = mysqli_query($con, $query);

    echo json_encode([
        "success" => $res,
        "message" => $res ? "Thêm thành công" : "Thêm thất bại"
    ]);
    exit;
}

if (isset($_POST['get_banner'])) {
    header('Content-Type: application/json; charset=utf-8');
    $query = "SELECT * FROM banner_carousel";
    $res = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if (isset($_POST['delete_banner'])) {
    $id = intval($_POST['id']);
    header('Content-Type: application/json; charset=utf-8');
    // Lấy ảnh để xóa file vật lý
    $queryImg = "SELECT img_banner FROM banner_carousel WHERE cr_no = $id";
    $resImg = mysqli_query($con, $queryImg);
    if ($rowImg = mysqli_fetch_assoc($resImg)) {
        $file = "../" . $rowImg['img_banner'];
        if (file_exists($file)) unlink($file);
    }
    $query = "DELETE FROM banner_carousel WHERE cr_no = $id";
    $res = mysqli_query($con, $query);
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Đã xóa thành công!" : "Xóa thất bại!"
    ]);
    exit;
}
