<?php
class LoginModel {
    public function kiemTra($tenDangNhap, $matKhau) {
        $st = getDB()->prepare('SELECT * FROM nguoi_dung WHERE ten_dang_nhap = ?');
        $st->execute([$tenDangNhap]);
        $u = $st->fetch();
        if ($u && password_verify($matKhau, $u['mat_khau'])) return $u;
        return null;
    }
}
