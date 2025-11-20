<?php
ob_clean();
require("../inc/db_config.php");

// room
if (isset($_POST['add_room'])) {

    $features = isset($_POST['features']) ? $_POST['features'] : [];
    $facilities = isset($_POST['facilities']) ? $_POST['facilities'] : [];

    $input_data = $_POST;
    // Xóa mảng features khỏi dữ liệu cần lọc
    unset($input_data['features']);
    unset($input_data['facilities']);

    $frm_data = filteration($input_data);

    $flag = 0;

    $q1 = "INSERT INTO `rooms` (`name`, `area`, `price`, `quantity`, `adult`, `children`,`description`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['room_name'],
        $frm_data['room_area'],
        $frm_data['room_price'],
        $frm_data['room_quantity'],
        $frm_data['room_adults'],
        $frm_data['room_children'],
        $frm_data['room_description'],
    ];

    if (insert($q1, $values, 'siiiiis')) {
        $flag = 1;
    }

    $room_id = mysqli_insert_id($con);

    if (!empty($features)) {
        foreach ($features as $f) {
            // Lọc số nguyên
            $f = filter_var($f, FILTER_SANITIZE_NUMBER_INT);
            $q2 = "INSERT INTO `room_features` (`room_id`, `features_id`) VALUES (?,?)";
            insert($q2, [$room_id, $f], 'ii');
        }
    }

    if (!empty($facilities)) {
        foreach ($facilities as $f) {
            $f = filter_var($f, FILTER_SANITIZE_NUMBER_INT);
            $q3 = "INSERT INTO `room_facilities` (`room_id`, `facilities_id`) VALUES (?,?)";
            insert($q3, [$room_id, $f], 'ii');
        }
    }

    if ($flag) {
        echo json_encode([
            "success" => true,
            "message" => "Thêm phòng mới thành công!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Lỗi máy chủ! Không thể thêm phòng."
        ]);
    }
    exit;
}

if (isset($_POST['get_rooms'])) {
    header('Content-Type: application/json; charset=utf-8');
    $query = "SELECT * FROM rooms";
    $res = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}

if (isset($_POST['toggle_status'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $q = "UPDATE `rooms` SET `status`=$status WHERE `cr_no`=$id";

    if (mysqli_query($con, $q)) {
        echo json_encode([
            "success" => true,
            "message" => "thay đổi trạng thái phòng thành công!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Lỗi máy chủ! Không thể thay đổi trạng thái phòng."
        ]);
    }
    exit;
}

if (isset($_POST['get_room_by_id'])) {

    header('Content-Type: application/json; charset=utf-8');

    $room_id = $_POST['room_id'];

    // LẤY THÔNG TIN ROOM
    $room_q = mysqli_query($con, "SELECT * FROM rooms WHERE cr_no = '$room_id'");
    $room = mysqli_fetch_assoc($room_q);

    // LẤY FEATURES
    $features = [];
    $res = mysqli_query($con, "SELECT cr_no AS id, name FROM features");
    while ($row = mysqli_fetch_assoc($res)) {
        $features[] = $row;
    }

    // LẤY FACILITIES
    $facilities = [];
    $res = mysqli_query($con, "SELECT cr_no AS id, name FROM facilities");
    while ($row = mysqli_fetch_assoc($res)) {
        $facilities[] = $row;
    }

    // LẤY FEATURES CỦA ROOM
    $room_features = [];
    $res = mysqli_query($con, "SELECT features_id FROM room_features WHERE room_id = '$room_id'");
    while ($row = mysqli_fetch_assoc($res)) {
        $room_features[] = strval($row['features_id']); // ép string
    }

    // LẤY FACILITIES CỦA ROOM
    $room_facilities = [];
    $res = mysqli_query($con, "SELECT facilities_id FROM room_facilities WHERE room_id = '$room_id'");
    while ($row = mysqli_fetch_assoc($res)) {
        $room_facilities[] = strval($row['facilities_id']);
    }

    echo json_encode([
        "room" => $room,
        "features" => $features,
        "facilities" => $facilities,
        "room_features" => $room_features,
        "room_facilities" => $room_facilities
    ]);

    exit;
}

if (isset($_POST['update_room'])) {
    $room_id = (int)$_POST['room_id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $area = (int)$_POST['area'];
    $price = (int)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $adults = (int)$_POST['adults'];
    $children = (int)$_POST['children'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = (int)$_POST['status'];


    $sql = "UPDATE rooms SET 
                name='$name',
                area=$area,
                price=$price,
                quantity=$quantity,
                adult=$adults,
                children=$children,
                description='$description',
                status=$status
            WHERE cr_no=$room_id";

    if (!mysqli_query($con, $sql)) {
        echo "Lỗi cập nhật phòng: " . mysqli_error($con);
        exit;
    }

    // Xóa các features & facilities cũ
    mysqli_query($con, "DELETE FROM room_features WHERE room_id=$room_id");
    mysqli_query($con, "DELETE FROM room_facilities WHERE room_id=$room_id");

    if (!empty($_POST['features'])) {
        foreach ($_POST['features'] as $f_id) {
            $f_id = (int)$f_id;
            mysqli_query($con, "INSERT INTO room_features(room_id, features_id) VALUES($room_id, $f_id)");
        }
    }

    if (!empty($_POST['facilities'])) {
        foreach ($_POST['facilities'] as $fac_id) {
            $fac_id = (int)$fac_id;
            mysqli_query($con, "INSERT INTO room_facilities(room_id, facilities_id) VALUES($room_id, $fac_id)");
        }
    }

    echo "Cập nhật phòng thành công!";
    exit;
}

if (isset($_POST['add_image'])) {
    $room_id = intval($_POST['room_id']); // Ép kiểu an toàn

    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['img_file']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['img_file']['name']); // theo cách bạn dùng
        $upload_dir = "uploads/rooms/";
        $target_dir = dirname(__DIR__) . "/" . $upload_dir;

        if (!file_exists($target_dir)) mkdir($target_dir, 0755, true);

        $target_path = $target_dir . $file_name;
        $img_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_path)) {
            // Kiểm tra xem phòng đã có ảnh chưa
            $res_check = mysqli_query($con, "SELECT img FROM room_image WHERE room_id=$room_id");
            if (mysqli_num_rows($res_check) > 0) {
                // Xóa ảnh cũ
                $row = mysqli_fetch_assoc($res_check);
                $old_img = dirname(__DIR__) . "/" . $row['img'];
                if (file_exists($old_img)) unlink($old_img);

                // Cập nhật ảnh mới
                mysqli_query($con, "UPDATE room_image SET img='$img_path' WHERE room_id=$room_id");
                echo json_encode(["success" => true, "message" => "Cập nhật ảnh thành công!"]);
            } else {
                // Thêm ảnh mới
                mysqli_query($con, "INSERT INTO room_image(room_id,img) VALUES($room_id,'$img_path')");
                echo json_encode(["success" => true, "message" => "Upload ảnh thành công!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Không thể upload ảnh."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Ảnh không hợp lệ."]);
    }
    exit;
}

if (isset($_POST['delete_room'])) {
    $room_id = intval($_POST['room_id']); // ép kiểu an toàn

    $res = mysqli_query($con, "SELECT img FROM room_image WHERE room_id=$room_id");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $img_path = dirname(__DIR__) . "/" . $row['img'];
        if (file_exists($img_path)) unlink($img_path);
        mysqli_query($con, "DELETE FROM room_image WHERE room_id=$room_id");
    }
    mysqli_query($con, "DELETE FROM room_features WHERE room_id=$room_id");
    mysqli_query($con, "DELETE FROM room_facilities WHERE room_id=$room_id");
    if (mysqli_query($con, "DELETE FROM rooms WHERE cr_no=$room_id")) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể xóa phòng']);
    }
    exit;
}
