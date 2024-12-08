-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 26, 2024 lúc 06:24 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_diem_sv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` int(30) NOT NULL,
  `level` varchar(200) NOT NULL,
  `section` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `level`, `section`, `date_created`) VALUES
(1, 'CNTT-12', 'DC_CNTT_12.10.11', '2024-01-05 13:59:56'),
(2, 'CNTT-12', 'DC_CNTT_12.09.09', '2024-01-21 11:07:21'),
(3, 'QTKD-12', 'DC_QTKD_12.10.01', '2024-01-10 09:43:11'),
(4, 'QTKD-10', 'DC_QTKD_10.08.03', '2023-12-29 13:46:24'),
(5, 'TMĐT-12', 'DC_TMĐT_12.09.06', '2023-12-30 19:09:33'),
(6, 'YĐK-09', 'DC_YĐK_09.03.03', '2024-01-01 23:12:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `results`
--

CREATE TABLE `results` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `marks_percentage` varchar(5) NOT NULL,
  `class_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `results`
--

INSERT INTO `results` (`id`, `student_id`, `marks_percentage`, `class_id`, `date_created`) VALUES
(3, 1, '98', 2, '2024-01-26 22:15:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `result_items`
--

CREATE TABLE `result_items` (
  `id` int(30) NOT NULL,
  `result_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `mark` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `result_items`
--

INSERT INTO `result_items` (`id`, `result_id`, `subject_id`, `mark`, `date_created`) VALUES
(9, 3, 1, 98, '2024-01-26 22:15:20'),
(10, 4, 3, 0, '2024-01-26 22:33:32'),
(11, 5, 2, 89, '2024-01-26 22:34:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `student_code` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `class_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `student_code`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `class_id`, `date_created`) VALUES
(1, '20213168', 'Lê', 'Huy', 'Hoàng', 'Nam', 'Hà Nội', 2, '2023-12-29 22:29:03'),
(3, '20193168', 'Nguyễn', 'Như', 'Quỳnh', 'Nam', 'Hà Nội', 4, '2024-01-26 22:24:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(30) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject`, `description`, `date_created`) VALUES
(1, 'IT3262', 'Đồ án chuyên ngành', 'Đồ án chuyên ngành 1', '2024-01-03 15:43:25'),
(2, 'PE1213', 'Giáo dục thể chất', 'Giáo dục thể chất 1+2', '2023-11-21 09:46:30'),
(3, 'SSH1204', 'Lịch sử Đảng Cộng sản Việt Nam', 'Lịch sử Đảng Cộng sản Việt Nam', '2023-12-12 20:19:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Đại học Thương Mại', 'mail@tmu.edu.vn', '+6948 8542 623', '79 Hồ Tùng Mậu, Cầu Giấy, Hà Nội', 'dai_hoc_thuong_mai.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `type`, `date_created`) VALUES
(1, 'Lê Huy', 'Hoàng', 'hoang', '25f9e794323b453885f5181f1b624d0b', 1, '2024-01-15 13:25:41');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `result_items`
--
ALTER TABLE `result_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `results`
--
ALTER TABLE `results`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `result_items`
--
ALTER TABLE `result_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
