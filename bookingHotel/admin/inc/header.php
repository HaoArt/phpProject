    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between "
        id="header-custom">
        <h3 class="me-5 fs-3 fw-bold h-font">Huế Hotel</h3>
        <h3 class="text-center">Chào, <?php echo $_SESSION['adminName'] ?></h3>
    </div>
    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-custom">
        <nav class="navbar navbar-expand-lg bg-dark p-0 bg-body-tertiary ">
            <div class="container-fluid flex-lg-column align-items-stretch bg-dark z-2">
                <h5 class="mt-3 text-light">Danh mục quản Lý </h5>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse  flex-column align-items-stretch " id="filterDropdown">
                    <ul class="list-unstyled m-0">
                        <li><a href="dashboard.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'dashboard.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-speedometer2"></i> Dashboard</a></li>
                        <li><a href="manage_booking_rooms.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_booking_rooms.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-door-closed"></i>Lịch sử đặt Phòng</a></li>
                        <li><a href="manage_rooms.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_rooms.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-door-closed"></i>Phòng</a></li>
                        <li><a href="manage_feature_facilities.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_feature_facilities.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-cup-hot-fill"></i></i> Đặc trưng, tiện nghi</a></li>
                        <li><a href="manage_queries.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_queries.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-journal-text"></i> Liên hệ khách hàng</a></li>
                        <li><a href="manage_banner.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_banner.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-file-image"></i> Ảnh bìa</a></li>
                        <li><a href="manage_setting.php"
                                class="d-block py-2 px-3 text-light text-decoration-none <?php echo ($current_page == 'manage_setting.php') ? 'c-active' : ''; ?>"><i
                                    class="bi bi-gear"></i> Cài đặt</a></li>
                        <li><a href="logout.php" class="d-block py-2 px-3 text-danger text-decoration-none"><i
                                    class="bi bi-box-arrow-right"></i> Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>