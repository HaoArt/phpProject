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
    <form class="login-form bg-light p-lg-5 p-3 border rounded" method="post">
        <h5 class="mb-4 text-center">ADMIN LOGIN</h5>
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="admin_name" id="form2Example1" class="form-control" style="width: 300px;" />
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" name="admin_pass" id="form2Example2" class="form-control" />
            <label class="form-label" for="form2Example2">Password</label>
        </div>

        <!-- 2 column grid layout for inline styling -->


        <!-- Submit button -->
        <button type="submit" name="login" data-mdb-button-init data-mdb-ripple-init
            class="btn btn-primary btn-block mb-4 w-100">Sign
            in</button>

        <!-- Register buttons -->


    </form>
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