-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 05:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btth01_cse485`
--

-- --------------------------------------------------------

--
-- Table structure for table `baiviet`
--

CREATE TABLE `baiviet` (
  `ma_bviet` int(10) UNSIGNED NOT NULL,
  `tieude` varchar(200) NOT NULL,
  `ten_bhat` varchar(100) NOT NULL,
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text DEFAULT NULL,
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ngayviet` datetime NOT NULL DEFAULT current_timestamp(),
  `hinhanh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `baiviet`
--
DELIMITER $$
CREATE TRIGGER `tg_CapNhatTheLoai_Delete` AFTER DELETE ON `baiviet` FOR EACH ROW BEGIN
    -- Update the number of articles in the corresponding theloai row
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_CapNhatTheLoai_Insert` AFTER INSERT ON `baiviet` FOR EACH ROW BEGIN
    -- Update the number of articles in the corresponding theloai row
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ten_tgia` varchar(100) NOT NULL,
  `hinh_tgia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `ten_tloai` varchar(50) NOT NULL,
  `SLBaiViet` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for views `vw_music`
-- (See below for the actual views)
--
CREATE TABLE `vw_music` (
`ma_bviet` int(10) unsigned
,`tieude` varchar(200)
,`ten_bhat` varchar(100)
,`ma_tloai` int(10) unsigned
,`tomtat` text
,`noidung` text
,`ma_tgia` int(10) unsigned
,`ngayviet` datetime
,`hinhanh` varchar(200)
,`ten_tgia` varchar(100)
,`ten_tloai` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for views `vw_music`
--
DROP TABLE IF EXISTS `vw_music`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_music`  AS SELECT `baiviet`.`ma_bviet` AS `ma_bviet`, `baiviet`.`tieude` AS `tieude`, `baiviet`.`ten_bhat` AS `ten_bhat`, `baiviet`.`ma_tloai` AS `ma_tloai`, `baiviet`.`tomtat` AS `tomtat`, `baiviet`.`noidung` AS `noidung`, `baiviet`.`ma_tgia` AS `ma_tgia`, `baiviet`.`ngayviet` AS `ngayviet`, `baiviet`.`hinhanh` AS `hinhanh`, `tacgia`.`ten_tgia` AS `ten_tgia`, `theloai`.`ten_tloai` AS `ten_tloai` FROM ((`baiviet` join `tacgia` on(`tacgia`.`ma_tgia` = `baiviet`.`ma_tgia`)) join `theloai` on(`theloai`.`ma_tloai` = `baiviet`.`ma_tloai`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`ma_bviet`),
  ADD KEY `fk_bv_tgia` (`ma_tgia`),
  ADD KEY `fk_bv_tloai` (`ma_tloai`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`ma_tgia`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ma_tloai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `ma_bviet` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `ma_tgia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ma_tloai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `fk_bv_tgia` FOREIGN KEY (`ma_tgia`) REFERENCES `tacgia` (`ma_tgia`),
  ADD CONSTRAINT `fk_bv_tloai` FOREIGN KEY (`ma_tloai`) REFERENCES `theloai` (`ma_tloai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




						--------------- SQL QUERIES ---------------
--Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình 
select ten_bhat from baiviet join theloai on baiviet.ma_tloai =  theloai.ma_tloai where ten_tloai = 'Nhạc trữ tình';
--Liệt kê các bài viết của tác giả “Nhacvietplus” 
select ten_bhat from baiviet join tacgia on baiviet.ma_tgia =  tacgia.ma_tgia where ten_tgia = 'Nhacvietplus';
-- Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào

SELECT tl.ma_tloai, tl.ten_tloai
FROM theloai tl
LEFT JOIN baiviet bv ON tl.ma_tloai = bv.ma_tloai
WHERE bv.ma_bviet IS NULL;

-- Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết.
SELECT ma_bviet, ten_bhat ten_tgia, ten_tloai, ngayviet from baiviet join tacgia on tacgia.ma_tgia = baiviet.ma_tgia join theloai on theloai.ma_tloai = baiviet.ma_tloai;

--Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY theloai.ma_tloai, theloai.ten_tloai
HAVING COUNT(baiviet.ma_bviet) = (
    SELECT MAX(tong_so_bai_viet)
    FROM (
        SELECT theloai.ma_tloai, COUNT(baiviet.ma_bviet) AS tong_so_bai_viet
        FROM baiviet
        JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
        GROUP BY theloai.ma_tloai
    ) AS so_bai_viet_max
);

-- Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM baiviet
JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tloai
GROUP BY tacgia.ma_tgia, tacgia.ten_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;
--  Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT ten_bhat 
FROM baiviet 
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';

--Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT ten_bhat 
FROM baiviet 
WHERE (tieude LIKE '%thương%' OR ten_bhat LIKE '%thương%')
   OR (ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%amh%')
   OR (ten_bhat LIKE '%em%' OR ten_bhat LIKE '%em%')
   OR (ten_bhat LIKE '%yeu%' OR ten_bhat LIKE '%yeu%');



 -- Tạo 1 views có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả
CREATE VIEW vw_Music AS
SELECT baiviet.*, tacgia.ten_tgia, theloai.ten_tloai
FROM baiviet join tacgia on tacgia.ma_tgia = baiviet.ma_tgia
join theloai on theloai.ma_tloai = baiviet.ma_tloai;
SELECT * FROM vw_Music;


-- Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web
CREATE TABLE users (
  id int(10) UNSIGNED NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  full_name varchar(100) NOT NULL,
  birth date DEFAULT NULL,
  phone varchar(11) NOT NULL,
  address varchar(255) NOT NULL,
  email varchar(100) NOT NULL,
  role varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO users (id, username, password, full_name, birth, phone, address, email, role) VALUES
(1, 'Nam', '123456', 'DucNam', '0000-00-00', '0987654321', '175 Tay Son', 'DucNam@gmail.comn', 'ADMIN'),
(2, 'HNam', '123456', 'HoaiNam', '0000-00-00', '0987654322', '177 Tay Son', 'HoaiNam@gmail.comn', 'USER'),
(3, 'Minh', '123456', 'VanMinh', '0000-00-00', '0987654323', '179 Tay Son', 'VanMinh@gmail.comn', 'ASSISTANT'),
(4, 'Nghia', '123456', 'NamNghia', '0000-00-00', '0987654324', '189 Tay Son', 'NamNghia@gmail.comn', 'USER'),
(5, 'QMinh', '123456', 'QuangMinh', '0000-00-00', '0987654325', '199 Tay Son', 'QuangMinh@gmail.comn', 'USER');


ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY username (username),
  ADD UNIQUE KEY email (email),
  ADD UNIQUE KEY phone (phone);
  
  ALTER TABLE users
  MODIFY id int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6 COMMIT;
  
  

-- Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi. 
Đăng nhập/Quản trị trang web
 DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN p_ten_tloai VARCHAR(50))
BEGIN
    DECLARE v_ma_tloai INT;
    
    SELECT ma_tloai INTO v_ma_tloai
    FROM theloai
    WHERE ten_tloai = p_ten_tloai;
    
    IF v_ma_tloai IS NULL THEN
        SELECT 'Thể loại không tồn tại.' AS Error_Message;
    ELSE
        SELECT * FROM baiviet
        WHERE ma_tloai = v_ma_tloai;
    END IF;
    
END //

DELIMITER ;
-- gọi proc: CALL sp_DSBaiViet('nhạc trẻ');

-- Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo.
		ALTER TABLE theloai
ADD COLUMN SLBaiViet INT DEFAULT 0;




-- Create the trigger for insert operation
DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai_Insert
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    -- Update the number of articles in the corresponding theloai row
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

DELIMITER ;

-- Create the trigger for update operation
-- do nothing


-- Create the trigger for delete operation
DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai_Delete
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    -- Update the number of articles in the corresponding theloai row
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END //

DELIMITER ;
