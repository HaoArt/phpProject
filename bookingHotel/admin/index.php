<?php
require("inc/db_config.php");
require("inc/essentials.php");
session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect("dashboard.php");
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require("inc/links.php") ?>
</head>

<body class="w-100">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Boostrap JS -->
    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-gradient-to-r"
        style="background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);">
        <form class="login-form bg-dark text-white p-5 rounded-4 shadow-lg" method="post" style="width: 380px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle fs-1 text-primary"></i>
                <h3 class="mt-2 fw-bold">Admin Login</h3>
            </div>

            <!-- Tên đăng nhập -->
            <div class="form-floating mb-3">
                <input type="text" name="admin_name" class="form-control bg-secondary text-white border-0"
                    id="admin_name" placeholder="Email / Tên đăng nhập" required>
                <label for="admin_name">Email / Tên đăng nhập</label>
            </div>

            <!-- Mật khẩu -->
            <div class="form-floating mb-3">
                <input type="password" name="admin_pass" class="form-control bg-secondary text-white border-0"
                    id="admin_pass" placeholder="Mật khẩu" required>
                <label for="admin_pass">Mật khẩu</label>
            </div>

            <!-- Nút đăng nhập -->
            <button type="submit" name="login" class="btn btn-primary w-100 py-2 fw-bold">Đăng nhập</button>

            <!-- Footer -->
            <p class="text-center text-white-50 small mt-3 mb-0">Chỉ dành cho quản trị viên</p>
        </form>
    </div>


    <?php
    if (isset($_POST["login"])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM admin_cred where admin_name = ? and admin_pass = ? ";
        $value = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $datatype = "ss";

        $res = select($query, $value, $datatype);
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            // session_start();
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row["sr_no"];
            $_SESSION['adminName'] = $row['admin_name'];
            redirect('dashboard.php');
        } else {
            alertMess("warning ", "Đăng nhập thất bại!!!");
        }
    };
    ?>
    <?php require("inc/scripts.php") ?>
</body>

</html>