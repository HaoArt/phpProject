-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 10, 2025 lúc 01:39 PM
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
(62, 'uploads/banner/1762677446_IMG_99736.png', '2025-11-09 08:37:26'),
(64, 'uploads/banner/1762677505_5badc72d-a712-4548-abaf-4f18a5a18b89 (4).jpg', '2025-11-09 08:38:25'),
(65, 'uploads/banner/1762677509_5badc72d-a712-4548-abaf-4f18a5a18b89 (1).jpg', '2025-11-09 08:38:29');

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
(1, 'hoang nhat hao');

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
(13, 'Hoàng Nhật Hào', 'uploads/managers/1761054112_Screenshot 2025-10-18 142320.png', '2025-10-21 13:41:52'),
(14, 'Nhuan gaf', 'uploads/managers/1761054335_Screenshot 2025-10-10 235105.png', '2025-10-21 13:45:35'),
(16, 'ádasádaádas', 'uploads/managers/1761055852_Screenshot 2025-10-11 003745.png', '2025-10-21 14:10:52'),
(19, 'su', 'uploads/managers/1761055882_Screenshot 2025-10-11 002144.png', '2025-10-21 14:11:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `cr_no` int(11) NOT NULL,
  `site_title` varchar(150) NOT NULL,
  `site_about` varchar(300) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`cr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Huế Hotel', 'đây là các thông tin về chúng tôi', 0);

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
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
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
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `manager_team`
--
ALTER TABLE `manager_team`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_query`
--
ALTER TABLE `user_query`
  MODIFY `cr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
