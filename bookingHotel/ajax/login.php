<?php
require_once(__DIR__ . '/../admin/inc/db_config.php');
require("../inc/essentials.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $frm = filteration($_POST);
    $email = $frm['email_l'];
    $password = $frm['password_l'];

    // 1. Tìm user theo email
    $stmt = $con->prepare("SELECT * FROM user_cred WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        echo "Email không tồn tại.";
        exit;
    }

    $user = $res->fetch_assoc();

    // 2. Check password
    if (!password_verify($password, $user['password'])) {
        echo "Mật khẩu không đúng.";
        exit;
    }

    // 3. Lưu session
    $_SESSION['userLogin'] = true;
    $_SESSION['user'] = [
        'name'     => $user['name'],
        'email'    => $user['email'],
        'phone'    => $user['phone'],
        'address'  => $user['address'],
        'birthday' => $user['birthday'],
        'profile'  => $user['profile']
    ];



    echo "Đăng nhập thành công!";
    exit;
}
