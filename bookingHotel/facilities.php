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
    <!-- Swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="background-color: #f5f5f5;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php require("inc/header.php") ?>


    <div class="my-5 px-4">
        <h2 class="h-font fw-bold text-center">Về cơ sở vật chất</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente harum, atque error
            porro consequuntur saepe
            nostrum optio, explicabo dolorem sunt quam sint pariatur voluptatem eligendi qui tempora eius eum tempore?
        </p>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $q = "SELECT * FROM facilities ORDER BY cr_no DESC";
            $r = mysqli_query($con, $q);
            if (mysqli_num_rows($r) > 0) {
                while ($row = mysqli_fetch_assoc($r)) {
                    $name = htmlspecialchars($row['name']);
                    $icon = htmlspecialchars($row['icon']);
                    $des = htmlspecialchars($row['description']);
                    // print_r($row['name']);
            ?>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class=" bg-white rounded shadow border-top border-4 border-dark p-lg-3 pop">
                            <div class="d-flex align-items-center justify-content-start">
                                <img src="./admin/<?php echo $icon ?>" alt="" width="40px">
                                <h5 class="ms-3"><?php echo $name ?></h5>
                            </div>
                            <p><?php echo $des ?></p>
                        </div>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>

    <?php require("inc/footer.php");
    require("inc/scripts.php");
    ?>

</body>

</html>