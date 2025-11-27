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
    <!-- Swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require("inc/links.php") ?>
</head>

<body style="background-color: #f5f5f5;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php require("inc/header.php") ?>


    <div class="my-5 px-4">
        <h2 class="h-font fw-bold text-center">Liên hệ với chúng tôi</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Chào mừng bạn đến với Huế Hotel! Chúng tôi luôn sẵn sàng lắng nghe ý kiến, giải đáp
            thắc mắc
            và hỗ trợ bạn trong quá trình đặt phòng hoặc trải nghiệm dịch vụ. Hãy điền thông tin vào form bên
            dưới, bao gồm tên, email, số điện thoại và nội dung bạn muốn trao đổi. Đội ngũ nhân viên chuyên nghiệp
            của chúng tôi sẽ phản hồi trong thời gian sớm nhất để đảm bảo bạn có trải nghiệm tuyệt vời tại khách sạn.
            Đừng ngần ngại chia sẻ nhu cầu hoặc góp ý của bạn, vì chúng tôi luôn mong muốn cải thiện dịch vụ và mang
            đến sự hài lòng tối đa cho khách hàng.</p>
    </div>

    <?php
    $contact_q = "SELECT * FROM contact_detail WHERE 1";
    $contact_r = mysqli_fetch_assoc(mysqli_query($con, $contact_q));

    // echo $contact_r['address'];
    ?>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-start    ">
            <div class="col-lg-6 col-md-6 mb-5 px-4 order-lg-2 order-md-2 order-2">
                <div class="">
                    <h1 class="mb-3 text-center">Liên hệ ngay</h1>
                    <div class="border bg-white overflow-hidden">
                        <form method="post">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="name" class="form-label">Họ và tên <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                        </span>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Chủ đề <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" value=""
                                        required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Nội dung <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" name="send" type="submit">Gửi tin
                                            nhắn</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 mb-5 bg-white px-4 pt-4 order-lg-1 order-md-1 order-1">
                <iframe class="w-100 rounded" <?php echo $contact_r['iframe']; ?> height="350" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="">
                    <h5 class="mt-2 ms-3">Địa chỉ</h5>
                    <a href="https://maps.app.goo.gl/xQDBYzFniRWtqsdr7"
                        class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <?php echo $contact_r['address']; ?>
                    </a>
                    <h5 class="mt-2 ms-3">Gọi cho tôi</h5>
                    <a href="#tel: 1234567890" class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-2"></i> <?php echo $contact_r['phone1']; ?>
                    </a><br>
                    <a href="#tel: 1234567890" class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-2"></i> <?php echo $contact_r['phone2']; ?>
                    </a>
                    <h5 class="mt-2 ms-3">Email liên lạc</h5>
                    <a href="https://mail.google.com/mail/nhathaohoang117@gmail.com"
                        class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-envelope-at-fill me-2"></i> <?php echo $contact_r['email']; ?>
                    </a><br>
                    <h5 class="mt-2 ms-3">Mạng xã hội</h5>
                    <a href="#tel: 1234567890" class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-facebook  me-2"></i> <?php echo $contact_r['fb']; ?>
                    </a>
                    <br>
                    <!-- <a href="#tel: 1234567890" class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-envelope-at-fill  me-2"></i> <?php echo $contact_r['iframe']; ?>
                    </a>
                    <br> -->
                    <a href="#tel: 1234567890" class="d-inline-block mb-2 ms-4 text-decoration-none text-dark">
                        <i class="bi bi-github  me-2"></i> <?php echo $contact_r['github']; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
    require("inc/footer.php");
    require("inc/scripts.php");
    require("inc/essentials.php");
    if (isset($_POST['send'])) {
        $frm_data = filteration($_POST);
        print_r($frm_data);
        $q = "INSERT INTO `user_query`( `name`, `email`, `phone`, `subject`, `message`) VALUES (?,?,?,?,?)";
        $values = [$frm_data["name"], $frm_data["email"], $frm_data["phone"], $frm_data["subject"], $frm_data["message"]];
        $res = insert($q, $values, 'sssss');
        if ($res) {
            alertMess('success', "Gửi liên hệ thành công");
        } else {
            alertMess('warning', "Gửi liên hệ thất bại");
        }
    }
    ?>

</body>

</html>