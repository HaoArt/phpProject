<?php
ob_clean();
require("../inc/db_config.php");
// feature
if (isset($_POST['add_feature'])) {
    $frm_data = filteration($_POST);
    $query = "INSERT INTO features (name) VALUES (?)";
    $values = [$frm_data['name_feature']];
    $res = insert($query, $values, 's');
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Thêm thành công" : "Thêm thất bại"
    ]);
    exit;
}

if (isset($_POST['get_features'])) {
    header('Content-Type: application/json; charset=utf-8');
    $query = "SELECT * FROM features";
    $res = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if (isset($_POST['update_feature'])) {
    $frm_data = filteration($_POST);
    header('Content-Type: application/json; charset=utf-8');
    $query = "UPDATE features SET name = ? WHERE cr_no = ?";
    $values = [$frm_data['name'], $frm_data['id']];
    $res = update($query, $values, 'si');
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Cập nhật thành công!" : "Cập nhật thất bại!"
    ]);
    exit;
}

if (isset($_POST['delete_feature'])) {
    $id = intval($_POST['id']);
    header('Content-Type: application/json; charset=utf-8');
    $query = "DELETE FROM features WHERE cr_no = $id";
    $res = mysqli_query($con, $query);
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Đã xóa thành công!" : "Xóa thất bại!"
    ]);
    exit;
}

// facilities
if (isset($_POST['get_facilities'])) {
    header('Content-Type: application/json; charset=utf-8');
    $query = "SELECT * FROM facilities";
    $res = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}
if (isset($_POST['add_facilities'])) {
    $name = trim($_POST['name_facilities']);
    $description = trim($_POST['description_facilities']);
    $icon_path = '';

    if (isset($_FILES['icon_facilities']) && $_FILES['icon_facilities']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['icon_facilities']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['icon_facilities']['name']);

        // thư mục lưu trong DB (tương đối từ admin/)
        $upload_dir = "uploads/facilities/";

        // đường dẫn vật lý thật trên server
        $target_dir = dirname(__DIR__) . "/" . $upload_dir;

        // tạo thư mục nếu chưa tồn tại
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        // đường dẫn file thực tế
        $target_path = $target_dir . $file_name;
        // đường dẫn lưu trong DB (để show ảnh)
        $icon_path = $upload_dir . $file_name;

        if (!move_uploaded_file($file_tmp, $target_path)) {
            echo json_encode(["success" => false, "message" => "Không thể upload ảnh."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Ảnh không hợp lệ."]);
        exit;
    }
    $query = "INSERT INTO `facilities`(`name`,`icon`,`description`) VALUES ('$name','$icon_path','$description')";
    $res = mysqli_query($con, $query);

    echo json_encode([
        "success" => $res,
        "message" => $res ? "Thêm thành công" : "Thêm thất bại"
    ]);
    exit;
}

if (isset($_POST['update_facility'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name_facilities_input']);
    $description = trim($_POST['description_facilities_input']);
    $icon_path = '';
    if (isset($_FILES['icon_facilities_input']) && $_FILES['icon_facilities_input']['error'] === UPLOAD_ERR_OK) {

        // Lấy icon cũ để xóa
        $queryIcon = "SELECT icon FROM facilities WHERE cr_no = $id";
        $resIcon = mysqli_query($con, $queryIcon);
        if ($rowIcon = mysqli_fetch_assoc($resIcon)) {
            $file = "../" . $rowIcon['icon'];
            if (is_file($file)) unlink($file);
        }

        // Upload file mới
        $file_tmp = $_FILES['icon_facilities_input']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['icon_facilities_input']['name']);

        // Thư mục lưu icon
        $upload_dir = "uploads/facilities/";
        $target_dir = dirname(__DIR__) . "/" . $upload_dir; // đường dẫn vật lý
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

        $target_path = $target_dir . $file_name;
        $icon_path = $upload_dir . $file_name; // đường dẫn lưu DB

        if (!move_uploaded_file($file_tmp, $target_path)) {
            echo json_encode(["success" => false, "message" => "Không thể upload ảnh."]);
            exit;
        }
    } else {
        // Giữ icon cũ nếu không upload file mới
        $queryIcon = "SELECT icon FROM facilities WHERE cr_no = $id";
        $resIcon = mysqli_query($con, $queryIcon);
        if ($rowIcon = mysqli_fetch_assoc($resIcon)) {
            $icon_path = $rowIcon['icon'];
        }
    }
    $query = "UPDATE `facilities` SET `name`='$name', `icon`='$icon_path', `description`='$description' WHERE cr_no=$id";
    $res = mysqli_query($con, $query);

    echo json_encode([
        "success" => $res,
        "message" => $res ? "Thêm thành công" : "Thêm thất bại"
    ]);
    exit;
}

if (isset($_POST['delete_facilities'])) {
    $id = intval($_POST['id']);
    header('Content-Type: application/json; charset=utf-8');
    $queryIcon = "SELECT icon FROM facilities WHERE cr_no = $id";
    $resIcon = mysqli_query($con, $queryIcon);
    if ($rowIcon = mysqli_fetch_assoc($resIcon)) {
        $file = "../" . $rowIcon['icon'];
        if (is_file($file)) unlink($file);
    }
    $query = "DELETE FROM facilities WHERE cr_no = $id";
    $res = mysqli_query($con, $query);
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Đã xóa thành công!" : "Xóa thất bại!"
    ]);
    exit;
}
