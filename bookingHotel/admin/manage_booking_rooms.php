<?php
require("inc/essentials.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ĐĂC TRƯNG VÀ TIỆN NGHI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("inc/links.php") ?>

</head>

<body class="bg-light">
    <?php require("inc/header.php") ?>

    <div class="container-fluid z-0">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="mt-custom">
                <h3 class="mb-4">Danh sách đặt phòng</h3>

                <div id="bookingContainer"></div>
            </div>

        </div>
    </div>
    <?php require("inc/scripts.php") ?>
    <!-- <script src="scripts/settings.js"></script> -->
    <script src="scripts/booking.js"></script>
</body>

</html>