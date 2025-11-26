<?php
require_once(__DIR__ . '/../admin/inc/db_config.php');
require("../inc/essentials.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $birthday = trim($_POST['birthday'] ?? '');
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';
    if (!$name || !$email || !$phone || !$password || !$repassword) {
        echo "Vui lòng điền đầy đủ thông tin.";
        exit;
    }

    if ($password !== $repassword) {
        echo "Mật khẩu không khớp.";
        exit;
    }



    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email và phone
    $stmt = $con->prepare("SELECT email, phone FROM user_cred WHERE email=? OR phone=? LIMIT 1");
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $res_check = $stmt->get_result();
    if ($res_check->num_rows > 0) {
        $row = $res_check->fetch_assoc();
        if ($row['email'] === $email) {
            echo "Email đã tồn tại.";
            exit;
        }
        if ($row['phone'] === $phone) {
            echo "Số điện thoại đã tồn tại.";
            exit;
        }
    }
    $stmt->close();

    // Upload ảnh
    $img_path = '';
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {

        $file_tmp  = $_FILES['profile']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['profile']['name']);
        $upload_dir = __DIR__ . "/../uploads/profile/";

        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $target_path = $upload_dir . $file_name;
        $img_path = "uploads/profile/" . $file_name; // lưu relative path

        if (!move_uploaded_file($file_tmp, $target_path)) {
            echo "Không thể upload ảnh profile.";
            exit;
        }
    } else {
        echo "Ảnh profile không hợp lệ.";
        exit;
    }


    // Insert vào DB
    $stmt = $con->prepare("
    INSERT INTO user_cred 
        (name, email, phone, address, birthday, password, profile, status, is_verified) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

    $status = 1;
    $is_verified = 1;
    $stmt->bind_param(
        "sssssssii",
        $name,
        $email,
        $phone,
        $address,
        $birthday,
        $hashed_password,
        $img_path,
        $status,
        $is_verified
    );

    if ($stmt->execute()) {
        $_SESSION['userLogin'] = true;
        $_SESSION['user'] = [
            'name'     => $user['name'],
            'email'    => $user['email'],
            'phone'    => $user['phone'],
            'address'  => $user['address'],
            'birthday' => $user['birthday'],
            'profile'  => $user['profile']
        ];

        echo "Đăng ký thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Phương thức không hợp lệ.";
}