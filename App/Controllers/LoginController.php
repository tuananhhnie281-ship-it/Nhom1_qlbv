<?php
require_once 'Models/LoginModel.php';

class LoginController {
    public function index() {
        view('Log/login');
    }
    public function dangNhap() {
        kiemTraCsrf();
        $model = new LoginModel();
        $u = $model->kiemTra(trim($_POST['ten_dang_nhap'] ?? ''), $_POST['mat_khau'] ?? '');
        if ($u) {
            session_regenerate_id(true);
            $_SESSION['user'] = ['id' => $u['id'], 'ho_ten' => $u['ho_ten'], 'vai_tro' => $u['vai_tro']];
            chuyenTrang('Dashboard');
        }
        thongBao('Sai tên đăng nhập hoặc mật khẩu.', 'err');
        chuyenTrang('Login');
    }
    public function dangXuat() {
        session_destroy();
        chuyenTrang('Login');
    }
}
