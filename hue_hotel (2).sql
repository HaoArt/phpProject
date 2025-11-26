-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2025 lúc 11:46 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hue_hotel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_cred`
--

CREATE TABLE `admin_cred` (
  `cr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_cred`
--

INSERT INTO `admin_cred` (`cr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'haoadmin', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner_carousel`
--

CREATE TABLE `banner_carousel` (
  `cr_no` int(11) NOT NULL,
  `img_banner` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner_carousel`
--

INSERT INTO `banner_carousel` (`cr_no`, `img_banner`, `created_at`) VALUES
(2, 'uploads/banner/1762593457_IMG_15372.png', '2025-11-08 09:17:37'),
(3, 'uploads/banner/1762593467_IMG_40905.png', '2025-11-08 09:17:47'),
(4, 'uploads/banner/1762593473_IMG_55677.png', '2025-11-08 09:17:53'),
(5, 'uploads/banner/1762593480_IMG_62045.png', '2025-11-08 09:18:00'),
(6, 'uploads/banner/1762593488_IMG_93127.png', '2025-11-08 09:18:08'),
(62, 'uploads/banner/1762677446_IMG_99736.png', '2025-11-09 08:37:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `cr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`cr_no`, `room_id`, `user_email`, `check_in`, `check_out`, `total_price`, `status`, `created_at`) VALUES
(1, 8, 'boxart117@gmail.com', '2025-11-21', '2025-11-29', 20000000.00, 1, '2025-11-20 13:06:54'),
(2, 8, 'boxart117@gmail.com', '2025-11-25', '2025-11-11', 2500000.00, 2, '2025-11-20 13:44:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_detail`
--

CREATE TABLE `contact_detail` (
  `cr_no` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `ggmap` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fb` varchar(150) NOT NULL,
  `github` varchar(150) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_detail`
--

INSERT INTO `contact_detail` (`cr_no`, `address`, `phone1`, `phone2`, `ggmap`, `email`, `fb`, `github`, `iframe`) VALUES
(1, 'Quảng An,Tx. Hương Trà, Thành phố Huế, Việt Nam', '0865272106\n         ', '0866861876', 'https://maps.app.goo.gl/xQDBYzFniRWtqsdr7', 'hoangnhathao0117@gmail.com \n                 ', 'fb.com/nhathao.hoang.946 ', 'github.com/HaoArt ', 'src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d102927.80889707133!2d107.56442275362377!3d16.522180408741516!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1759967677617!5m2!1sen!2s\"');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `facilities`
--

CREATE TABLE `facilities` (
  `cr_no` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `icon` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `facilities`
--

INSERT INTO `facilities` (`cr_no`, `name`, `icon`, `description`) VALUES
(4, 'Báo động hỏa hoạn', 'uploads/facilities/1762694594_1.svg', 'Hệ thống báo động hỏa hoạn hiện đại giúp phát hiện khói và lửa kịp thời, đảm bảo an toàn tối đa cho khách và nhân viên, với cảnh báo âm thanh và ánh sáng rõ ràng'),
(5, 'Tivi', 'uploads/facilities/1762694658_2.svg', 'Tivi màn hình lớn đời mới, hiển thị sắc nét, tích hợp nhiều kênh giải trí và ứng dụng đa phương tiện, mang đến trải nghiệm thư giãn tuyệt vời ngay tại phòng'),
(6, 'Wifi', 'uploads/facilities/1762694699_3.svg', 'Wi-Fi tốc độ cao miễn phí, phủ sóng toàn bộ khu vực, giúp bạn kết nối Internet dễ dàng từ mọi vị trí trong khách sạn.'),
(7, 'massage', 'uploads/facilities/1762694751_4.svg', 'Thư giãn hoàn toàn với dịch vụ massage chuyên nghiệp, nơi bạn được chăm sóc từng chi tiết để xua tan căng thẳng, hồi phục năng lượng và tận hưởng phút giây thư giãn tuyệt đối sau một ngày dài.'),
(8, 'Điều hòa', 'uploads/facilities/1762694783_5.svg', 'Trải nghiệm không gian mát lạnh, dễ chịu với hệ thống điều hòa hiện đại, giúp bạn thư giãn tuyệt đối và tận hưởng giấc ngủ ngon dù bất kể thời tiết bên ngoài ra sao.'),
(9, 'Lò sửi', 'uploads/facilities/1762694815_6.svg', 'Thưởng thức không gian ấm áp và dễ chịu vào những ngày se lạnh với lò sưởi hiện đại, mang lại cảm giác thư giãn tuyệt đối và tạo nên bầu không khí ấm cúng cho căn phòng.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `features`
--

CREATE TABLE `features` (
  `cr_no` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `features`
--

INSERT INTO `features` (`cr_no`, `name`) VALUES
(5, 'Ban công'),
(6, 'Phòng ngủ'),
(7, 'Phòng bếp'),
(8, 'Phòng tắm hơi'),
(9, 'Sân thượng'),
(10, 'Giường cỡ lớn King Size');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manager_team`
--

CREATE TABLE `manager_team` (
  `cr_no` int(11) NOT NULL,
  `name_manager` varchar(100) NOT NULL,
  `img_manager` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manager_team`
--

INSERT INTO `manager_team` (`cr_no`, `name_manager`, `img_manager`, `created_at`) VALUES
(20, 'Võ Quốc Triệu', 'uploads/managers/1763122526_IMG_17352.jpg', '2025-11-14 12:15:26'),
(21, 'Võ Quốc Triệu', 'uploads/managers/1763122690_rac.jpg', '2025-11-14 12:18:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `cr_no` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`cr_no`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`) VALUES
(1, 'Phòng Đơn', 10, 360000, 36, 3, 1, 'qưerasdfđắ', 1),
(2, 'Phòng Đôi', 15, 630000, 63, 2, 2, 'ádasdas', 1),
(5, 'Phòng Gia Đình', 20, 1200000, 5, 4, 3, 'Phòng truyền thống giành cho gia đình', 1),
(6, 'Phòng Truyền Thống', 20, 500000, 6, 5, 2, 'đâsđsđưa', 0),
(7, 'Phòng Hiện Đại', 25, 650000, 41, 3, 2, 'đứa', 1),
(8, 'Phòng Đại Gia Đình', 40, 2500000, 4, 10, 5, 'qwreryutiosdfghjkl;zxcvbnm', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_facilities`
--

CREATE TABLE `room_facilities` (
  `cr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_facilities`
--

INSERT INTO `room_facilities` (`cr_no`, `room_id`, `facilities_id`) VALUES
(24, 1, 6),
(25, 5, 4),
(26, 5, 5),
(27, 5, 6),
(28, 5, 7),
(29, 5, 8),
(30, 5, 9),
(31, 6, 4),
(32, 6, 5),
(33, 6, 6),
(34, 6, 7),
(35, 6, 8),
(36, 7, 4),
(37, 7, 5),
(38, 7, 6),
(39, 7, 7),
(40, 7, 8),
(41, 7, 9),
(42, 8, 4),
(43, 8, 5),
(44, 8, 6),
(45, 8, 7),
(46, 8, 8),
(47, 8, 9),
(48, 2, 5),
(49, 2, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_features`
--

CREATE TABLE `room_features` (
  `cr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_features`
--

INSERT INTO `room_features` (`cr_no`, `room_id`, `features_id`) VALUES
(12, 1, 6),
(13, 1, 7),
(14, 5, 5),
(15, 5, 6),
(16, 5, 7),
(17, 6, 5),
(18, 6, 6),
(19, 7, 5),
(20, 7, 6),
(21, 7, 7),
(22, 8, 5),
(23, 8, 6),
(24, 8, 7),
(25, 2, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_image`
--

CREATE TABLE `room_image` (
  `cr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_image`
--

INSERT INTO `room_image` (`cr_no`, `room_id`, `img`) VALUES
(1, 1, 'uploads/rooms/1763547139_mark-champs-Id2IIl1jOB0-unsplash.jpg'),
(2, 2, 'uploads/rooms/1763547145_vojtech-bruzek-Yrxr3bsPdS0-unsplash.jpg'),
(4, 5, 'uploads/rooms/1763547099_dad-hotel-Y-bJWAjPzsY-unsplash.jpg'),
(5, 6, 'uploads/rooms/1763548451_olexandr-ignatov-w72a24brINI-unsplash.jpg'),
(6, 7, 'uploads/rooms/1763548521_point3d-commercial-imaging-ltd-5BV56SdvLmo-unsplash.jpg'),
(7, 8, 'uploads/rooms/1763548594_sara-dubler-Koei_7yYtIo-unsplash.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `cr_no` int(11) NOT NULL,
  `site_title` varchar(150) NOT NULL,
  `site_about` varchar(500) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`cr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Huế Hotel', 'Huế Hotel mang đến không gian nghỉ dưỡng tiện nghi, sạch sẽ và thoải mái giữa lòng Cố đô Huế. Chúng tôi luôn nỗ lực phục vụ tận tâm và tạo nên trải nghiệm lưu trú hài lòng nhất cho mọi du khách.', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_cred`
--

CREATE TABLE `user_cred` (
  `cr_no` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `birthday` date NOT NULL,
  `profile` varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_cred`
--

INSERT INTO `user_cred` (`cr_no`, `name`, `email`, `phone`, `address`, `birthday`, `profile`, `password`, `status`, `is_verified`) VALUES
(6, 'Hoàng Nhật Hào', 'boxart117@gmail.com', '0866861876', 'đội 4 an xuân', '2004-12-17', 'uploads/profile/1763637874_IMG_17352.jpg', '$2y$12$rS0I2wDAFzJn4/zm0ToMyuLmAFfy/plPe74N8mVjuzXF6YtOCOjja', 1, 1),
(7, 'Trần Đức Thành Nhuận', 'tranductn@gmail.com', '1234567891', 'đội 3 an xuân', '2004-08-09', 'uploads/profile/1763638468_IMG_17352.jpg', '$2y$12$0BI6OayxRR2hJ9GwHlF/2eby7aVxv4gQuagur584A9o6b6pcqM7la', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_query`
--

CREATE TABLE `user_query` (
  `cr_no` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_query`
--

INSERT INTO `user_query` (`cr_no`, `name`, `email`, `phone`, `subject`, `message`, `date`, `seen`) VALUES
(7, 'Võ quốc triệu', 'trieubuscu@gmail.com', '1234567897', 'book em 1 phòng 2 dao', 'càng nhiều càng tốt', '2025-11-14', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `banner_carousel`
--
ALTER TABLE `banner_carousel`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`cr_no`),
  ADD KEY `rm b id` (`room_id`);

--
-- Chỉ mục cho bảng `contact_detail`
--
ALTER TABLE `contact_detail`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `manager_team`
--
ALTER TABLE `manager_team`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`cr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room idf` (`room_id`);

--
-- Chỉ mục cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`cr_no`),
  ADD KEY `feartures id` (`features_id`),
  ADD KEY `room id` (`room_id`);

--
-- Chỉ mục cho bảng `room_image`
--
ALTER TABLE `room_image`
  ADD PRIMARY KEY (`cr_no`),
  ADD KEY `rm img id` (`room_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`cr_no`);

--
-- Chỉ mục cho bảng `user_query`
--
ALTER TABLE `user_query`
  ADD PRIMARY KEY (`cr_no`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `banner_carousel`
--
ALTER TABLE `banner_carousel`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `contact_detail`
--
ALTER TABLE `contact_detail`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `facilities`
--
ALTER TABLE `facilities`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `features`
--
ALTER TABLE `features`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `manager_team`
--
ALTER TABLE `manager_team`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `room_features`
--
ALTER TABLE `room_features`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `room_image`
--
ALTER TABLE `room_image`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user_query`
--
ALTER TABLE `user_query`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `rm b id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`cr_no`);

--
-- Các ràng buộc cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`cr_no`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room idf` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`cr_no`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `feartures id` FOREIGN KEY (`features_id`) REFERENCES `features` (`cr_no`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`cr_no`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `room_image`
--
ALTER TABLE `room_image`
  ADD CONSTRAINT `rm img id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`cr_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
