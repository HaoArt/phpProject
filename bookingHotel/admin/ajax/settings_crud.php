<?php
require("../inc/db_config.php");
// require("../inc/essentials.php");
// adminLogin();
if (isset($_POST['get_general'])) {
    $query = "SELECT site_title, site_about FROM settings WHERE cr_no=1";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);
    echo json_encode($data);
    exit;
}
if (isset($_POST['update_general'])) {
    $title = $_POST['site_title'];
    $about = $_POST['site_about'];
    $query = "UPDATE settings SET site_title='$title', site_about='$about' WHERE cr_no=1";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);
    echo json_encode(["success" => $res]);
    exit;
}


if (isset($_POST['get_contact'])) {
    $query = "SELECT * FROM contact_detail WHERE cr_no= 1";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);
    echo json_encode($data);
    exit;
}

if (isset($_POST['update_contact'])) {
    $address = $_POST['address'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $ggmap = $_POST['ggmap'];
    $email = $_POST['email'];
    $fb = $_POST['fb'];
    $github = $_POST['github'];
    $iframe = $_POST['iframe'];
    $query = "UPDATE contact_detail SET `address`='$address',phone1='$phone1',
    phone2='$phone2',ggmap='$ggmap',email='$email',fb='$fb',github='$github',iframe='$iframe' WHERE 1";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);
    echo json_encode(["success" => $res]);
    exit;
}

// manager
if (isset($_POST['add_manager'])) {
    $name_manager = trim($_POST['name_manager']);
    $img_path = '';

    if (isset($_FILES['img_manager']) && $_FILES['img_manager']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['img_manager']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['img_manager']['name']);

        // thư mục lưu trong DB (tương đối từ admin/)
        $upload_dir = "uploads/managers/";

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
    $query = "INSERT INTO manager_team (name_manager, img_manager) VALUES ('$name_manager', '$img_path')";
    $res = mysqli_query($con, $query);

    echo json_encode([
        "success" => $res,
        "message" => $res ? "Thêm thành công" : "Thêm thất bại"
    ]);
    exit;
}

if (isset($_POST['get_manager'])) {
    header('Content-Type: application/json; charset=utf-8');
    $query = "SELECT * FROM manager_team";
    $res = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if (isset($_POST['delete_manager'])) {
    $id = intval($_POST['id']);
    header('Content-Type: application/json; charset=utf-8');
    // Lấy ảnh để xóa file vật lý
    $queryImg = "SELECT img_manager FROM manager_team WHERE cr_no = $id";
    $resImg = mysqli_query($con, $queryImg);
    if ($rowImg = mysqli_fetch_assoc($resImg)) {
        $file = "../" . $rowImg['img_manager'];
        if (file_exists($file)) unlink($file);
    }
    $query = "DELETE FROM manager_team WHERE cr_no = $id";
    $res = mysqli_query($con, $query);
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Đã xóa thành công!" : "Xóa thất bại!"
    ]);
    exit;
}


// user query
if (isset($_POST['update_seen'])) {
    $id = $_POST['id'];

    if ($id === 'all') {
        $q = "UPDATE user_query SET seen = 1";
        $res = mysqli_query($con, $q);
    } else {
        $q = "UPDATE user_query SET seen = 1 WHERE cr_no = ?";
        $values = [$id];
        $res = update($q, $values, 'i');
    }

    echo $res ? "success" : "error";
}

if (isset($_POST['delete_query'])) {
    $id = $_POST['id'];

    if ($id === 'all') {
        $q = "DELETE FROM user_query";
        $res = mysqli_query($con, $q);
    } else {
        $q = "DELETE FROM user_query WHERE cr_no = ?";
        $values = [$id];
        $res = update($q, $values, 'i');
    }

    echo $res ? "success" : "error";
}
