<?php
// Kết nối CSDL MySQL (XAMPP mặc định: root, không mật khẩu)
function getDB() {
    static $conn = null;
    if ($conn === null) {
        $host = 'localhost';
        $dbname = 'quanly_benhvien';
        $user = 'root';
        $pass = '';
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Không kết nối được CSDL: ' . $e->getMessage());
        }
    }
    return $conn;
}
