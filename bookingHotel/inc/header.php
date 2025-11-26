   <?php
    // require(__DIR__ . '/../admin/inc/db_config.php');
    require_once(__DIR__ . '/../admin/inc/db_config.php');
    $settings_q = "SELECT * FROM settings WHERE 1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));
    $current_page = basename($_SERVER['PHP_SELF']);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    ?>

   <!-- Header Navbar-->
   <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top px-lg-4 py-2">
       <div class="container-fluid">
           <!-- Logo -->
           <a class="navbar-brand fs-3 fw-bold h-font" href="index.php">
               <?= $settings_r['site_title'] ?>
           </a>

           <!-- Toggle button for mobile -->
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
               aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>

           <!-- Navbar links -->
           <div class="collapse navbar-collapse" id="navbarContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <?php
                    $pages = [
                        "index.php" => "Trang chủ",
                        "rooms.php" => "Phòng",
                        "facilities.php" => "Cơ sở vật chất",
                        "contact_us.php" => "Liên hệ",
                        "about_us.php" => "Về chúng tôi"
                    ];
                    foreach ($pages as $file => $title) {
                        $active = ($current_page == $file) ? "active" : "";
                        echo "<li class='nav-item'>
                        <a class='nav-link $active' href='$file'>$title</a>
                    </li>";
                    }
                    ?>
               </ul>

               <!-- User / Auth buttons -->
               <?php if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] === true): ?>
               <div class="dropdown">
                   <button class="btn p-0 bg-transparent shadow-none" type="button" id="userMenuBtn"
                       data-bs-toggle="dropdown" aria-expanded="false">
                       <img src="<?= $_SESSION['user']['profile'] ?? 'assets/img/default_user.png'; ?>"
                           class="rounded-circle border border-2 border-secondary" width="40" height="40"
                           style="object-fit: cover;">
                   </button>
                   <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userMenuBtn">
                       <li><span class="dropdown-item fw-bold"><?= $_SESSION['user']['name']; ?></span></li>
                       <li><a class="dropdown-item" href="profile.php">Hồ sơ</a></li>
                       <li><a class="dropdown-item" href="booking_history.php">Lịch sử đặt phòng</a></li>
                       <li>
                           <hr class="dropdown-divider">
                       </li>
                       <li><button class="dropdown-item text-danger" onclick="logout()">Đăng xuất</button></li>
                   </ul>
               </div>
               <?php else: ?>
               <div class="d-flex">
                   <button type="button" class="btn btn-outline-dark me-2 shadow-none" data-bs-toggle="modal"
                       data-bs-target="#loginModal">Đăng nhập</button>
                   <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                       data-bs-target="#registerModal">Đăng ký</button>
               </div>
               <?php endif; ?>
           </div>
       </div>
   </nav>

   <!--Login Modal -->
   <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="loginModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content border-0 shadow-lg">
               <form id="loginForm" action="post">
                   <!-- Header -->
                   <div class="modal-header bg-dark text-white">
                       <h5 class="modal-title d-flex align-items-center" id="loginModalLabel">
                           <i class="bi bi-person-circle me-2 fs-3"></i> Đăng nhập
                       </h5>
                       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                           aria-label="Close"></button>
                   </div>

                   <!-- Body -->
                   <div class="modal-body p-4">
                       <div class="mb-3">
                           <label class="form-label fw-semibold">Email</label>
                           <input type="email" name="email_l" id="email_l" class="form-control shadow-sm"
                               placeholder="Nhập email của bạn">
                       </div>
                       <div class="mb-3">
                           <label class="form-label fw-semibold">Mật khẩu</label>
                           <input type="password" name="password_l" id="password_l" class="form-control shadow-sm"
                               placeholder="Nhập mật khẩu">
                       </div>
                       <div class="d-flex justify-content-between align-items-center">
                           <button type="button" onclick="login()" class="btn btn-primary shadow-sm px-4">
                               Đăng Nhập
                           </button>
                           <a href="javascript:void(0);" onclick="forgotPassword()"
                               class="text-decoration-none text-primary">
                               Quên mật khẩu?
                           </a>
                       </div>
                       <hr class="my-3">
                       <p class="text-center mb-0 text-muted">Chưa có tài khoản?
                           <a href="#" class="text-decoration-none text-primary" data-bs-target="#registerModal"
                               data-bs-toggle="modal" data-bs-dismiss="modal">
                               Đăng ký ngay
                           </a>
                       </p>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <!--Register Modal -->
   <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="registerModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered">
           <div class="modal-content border-0 shadow-lg">
               <form id="registerForm" method="POST" enctype="multipart/form-data">
                   <!-- Header -->
                   <div class="modal-header bg-dark text-white">
                       <h5 class="modal-title d-flex align-items-center" id="registerModalLabel">
                           <i class="bi bi-person-circle me-2 fs-3"></i> Đăng ký
                       </h5>
                       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                   </div>

                   <!-- Body -->
                   <div class="modal-body p-4">
                       <div class="mb-3 text-center">
                           <span class="badge bg-light text-dark p-2 rounded-pill">
                               Tất cả thông tin của bạn sẽ được bảo mật và không thể thay đổi!
                           </span>
                       </div>
                       <div class="container-fluid">
                           <div class="row g-3">
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Tên</label>
                                   <input type="text" name="name" class="form-control shadow-sm" placeholder="Nhập tên"
                                       required>
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Email</label>
                                   <input type="email" name="email" class="form-control shadow-sm"
                                       placeholder="Nhập email" required>
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Điện thoại</label>
                                   <input type="tel" name="phone" class="form-control shadow-sm"
                                       placeholder="Nhập số điện thoại" required>
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Ngày sinh</label>
                                   <input type="date" name="birthday" class="form-control shadow-sm" required>
                               </div>
                               <div class="col-md-12">
                                   <label class="form-label fw-semibold">Ảnh cá nhân</label>
                                   <input type="file" name="profile" class="form-control shadow-sm" required>
                               </div>
                               <div class="col-md-12">
                                   <label class="form-label fw-semibold">Địa chỉ</label>
                                   <textarea class="form-control shadow-sm" name="address" rows="2"
                                       placeholder="Nhập địa chỉ" required></textarea>
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Mật khẩu</label>
                                   <input type="password" name="password" class="form-control shadow-sm"
                                       placeholder="Nhập mật khẩu" required>
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label fw-semibold">Nhập lại mật khẩu</label>
                                   <input type="password" name="repassword" class="form-control shadow-sm"
                                       placeholder="Nhập lại mật khẩu" required>
                               </div>
                               <div class="col-12 text-center mt-3">
                                   <button type="button" onclick="register()"
                                       class="btn btn-primary shadow-sm px-4 py-2">
                                       Đăng ký
                                   </button>
                               </div>
                               <div class="col-12 text-center mt-2">
                                   <small class="text-muted">
                                       Đã có tài khoản?
                                       <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                           data-bs-dismiss="modal" class="text-decoration-none text-primary">
                                           Đăng nhập ngay
                                       </a>
                                   </small>
                               </div>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <script src="./script/login_register_logout.js"></script>