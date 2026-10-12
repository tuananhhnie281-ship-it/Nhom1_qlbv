CREATE DATABASE IF NOT EXISTS quanly_benhvien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE quanly_benhvien;

CREATE TABLE nguoi_dung (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_dang_nhap VARCHAR(50) NOT NULL UNIQUE,
  mat_khau VARCHAR(255) NOT NULL,
  ho_ten VARCHAR(100) NOT NULL,
  vai_tro VARCHAR(20) NOT NULL DEFAULT 'letan'
);
CREATE TABLE chuyen_khoa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_khoa VARCHAR(100) NOT NULL
);
CREATE TABLE benh_nhan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ho_ten VARCHAR(100) NOT NULL,
  ngay_sinh DATE NULL,
  gioi_tinh VARCHAR(10),
  sdt VARCHAR(15),
  dia_chi VARCHAR(255),
  so_bhyt VARCHAR(20)
);
CREATE TABLE bac_si (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ho_ten VARCHAR(100) NOT NULL,
  chuyen_khoa_id INT NOT NULL,
  sdt VARCHAR(15),
  FOREIGN KEY (chuyen_khoa_id) REFERENCES chuyen_khoa(id)
);
CREATE TABLE thuoc (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_thuoc VARCHAR(100) NOT NULL,
  don_vi VARCHAR(20),
  gia_ban INT DEFAULT 0,
  so_luong_ton INT DEFAULT 0
);
CREATE TABLE lich_hen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  benh_nhan_id INT NOT NULL,
  bac_si_id INT NOT NULL,
  ngay_gio DATETIME NOT NULL,
  ly_do VARCHAR(255),
  trang_thai VARCHAR(20) NOT NULL DEFAULT 'cho_kham',
  chan_doan TEXT,
  ghi_chu TEXT,
  FOREIGN KEY (benh_nhan_id) REFERENCES benh_nhan(id),
  FOREIGN KEY (bac_si_id) REFERENCES bac_si(id)
);

INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, vai_tro) VALUES
('admin', '$2b$12$UyPVkAEjfFBk51/y3HKR6eTvApldY.8ulZSEB41Y6La/O7JsQ6t7e', 'Quản trị viên', 'admin'),
('letan', '$2b$12$BUvrEmCFfp.VXqUXdBoAS.h46qAWwC5VW3nRmsfI3bzmQaPTmLd0O', 'Lễ tân', 'letan');
INSERT INTO chuyen_khoa (ten_khoa) VALUES ('Nội tổng quát'),('Ngoại'),('Nhi'),('Sản'),('Tai mũi họng'),('Răng hàm mặt');
INSERT INTO bac_si (ho_ten, chuyen_khoa_id, sdt) VALUES ('BS. Nguyễn Văn An',1,'0901000001'),('BS. Trần Thị Bình',3,'0901000002');
INSERT INTO benh_nhan (ho_ten, ngay_sinh, gioi_tinh, sdt, dia_chi, so_bhyt) VALUES ('Lê Minh Châu','1995-04-12','Nữ','0912345678','Hà Nội','HS4010000001');
INSERT INTO thuoc (ten_thuoc, don_vi, gia_ban, so_luong_ton) VALUES ('Paracetamol 500mg','Viên',1000,500),('Amoxicillin 500mg','Viên',2500,30);
