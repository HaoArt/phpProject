   <?php
    require(__DIR__ . '/../admin/inc/db_config.php');
    $settings_q = "SELECT * FROM settings WHERE 1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

   <!-- Header Navbar-->
   <nav class="navbar navbar-expand-lg bg-body-tertiary px-lg-3 py-lg-2 shadow-sm sticky-top">
       <div class="container-fluid">
           <a class="navbar-brand me-5 fs-3 fw-bold h-font " href="index.php">
               <?php echo $settings_r['site_title'] ?></a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item">
                       <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"
                           aria-current="page" href="index.php">Trang chủ</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link <?php echo ($current_page == 'rooms.php') ? 'active' : ''; ?>"
                           href="rooms.php">Phòng</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link <?php echo ($current_page == 'facilities.php') ? 'active' : ''; ?>"
                           href="facilities.php">Cơ sở vật chất</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link <?php echo ($current_page == 'contact_us.php') ? 'active' : ''; ?>"
                           href="contact_us.php">Liên hệ </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link <?php echo ($current_page == 'about_us.php') ? 'active' : ''; ?>"
                           href="about_us.php">Về chúng tôi</a>
                   </li>

               </ul>
               <div class="d-flex">
                   <!-- Button trigger modal -->
                   <button type="button" class="btn btn-outline-dark me-lg-2 me-3 shadow-none" data-bs-toggle="modal"
                       data-bs-target="#loginModal">
                       Đăng nhập
                   </button>
                   <button type="button" class="btn btn-outline-dark me-lg-2 me-3 shadow-none" data-bs-toggle="modal"
                       data-bs-target="#registerModal">
                       Đăng ký
                   </button>
               </div>
           </div>
       </div>
   </nav>
   <!--Login Modal -->
   <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="post">
                   <div class="modal-header">
                       <h1 class="modal-title fs-5" id="staticBackdropLabel">
                           <i class="bi bi-person-circle"></i>
                           Đăng nhập
                       </h1>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="mb-3">
                           <label class="form-label">Email </label>
                           <input type="email" class="form-control shadow-none">

                       </div>
                       <div class="mb-3">
                           <label class="form-label">Mật khẩu</label>
                           <input type="password" class="form-control">
                       </div>
                       <div class="d-flex align-items-center justify-content-between">
                           <button type="submit" class="btn btn-dark">Đăng Nhập</button>
                           <a href="javascript: void(0)">Quên mật khẩu?</a>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <!--Register Modal -->
   <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <form action="post">
                   <div class="modal-header">
                       <h1 class="modal-title fs-5" id="staticBackdropLabel">
                           <i class="bi bi-person-circle"></i>
                           Đăng ký
                       </h1>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <span class="badge m-auto rounded-pill text-center bg-light text-dark mb-3 text-wrap lh-base">Tất
                           cả
                           thông tin (Bao
                           gồm mail, điện thoại, căn cước công dân) sẽ
                           được chúng tôi dùng để đặt
                           phòng!
                       </span>
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Tên </label>
                                   <input type="text" name="name" id="name" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Email </label>
                                   <input type="text" name="mail" id="mail" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Điện thoại </label>
                                   <input type="number" name="phone" id="phone" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Căn cước công dân </label>
                                   <input type="file" name="identity" id="identity" class="form-control shadow-none">
                               </div>
                               <div class="col-md-12 ps-0 mb-3">
                                   <label class="form-label">Địa chỉ </label>
                                   <textarea class="form-control" aria-label="With textarea" name="address"
                                       id="adresss"></textarea>
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Mã Capcha</label>
                                   <input type="number" name="pincode" id="pincode" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Ngày sinh</label>
                                   <input type="date" name="birthday" id="birthday" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Mật khẩu </label>
                                   <input type="text" name="password" id="password" class="form-control shadow-none">
                               </div>
                               <div class="col-md-6 ps-0 mb-3">
                                   <label class="form-label">Nhập lại mật khẩu </label>
                                   <input type="text" name="repassword" id="repassword"
                                       class="form-control shadow-none">
                               </div>
                               <div class="text-center">
                                   <button type="submit" class="btn btn-dark">Đăng ký</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>