<?php
require_once 'Models/ThuocModel.php';

class ThuocController {
    private $model;
    public function __construct() { $this->model = new ThuocModel(); }

    public function index() {
        $q = trim($_GET['q'] ?? '');
        view('layouts/thuoc/index', ['ds' => $this->model->layDanhSach($q), 'q' => $q]);
    }
    public function create() {
        view('layouts/thuoc/form', ['row' => []]);
    }
    public function edit() {
        $row = $this->model->layTheoId((int)($_GET['id'] ?? 0));
        if (!$row) die('Không tìm thấy thuốc.');
        view('layouts/thuoc/form', ['row' => $row]);
    }
    public function save() {
        kiemTraCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $d = [
            'ten_thuoc' => trim($_POST['ten_thuoc'] ?? ''), 'don_vi' => trim($_POST['don_vi'] ?? ''),
            'gia_ban' => $_POST['gia_ban'] ?? 0, 'so_luong_ton' => $_POST['so_luong_ton'] ?? 0,
        ];
        if ($d['ten_thuoc'] === '') {
            thongBao('Vui lòng nhập tên thuốc.', 'err');
            chuyenTrang('Thuoc', $id ? 'edit' : 'create', $id ? ['id' => $id] : []);
        }
        $id ? $this->model->sua($id, $d) : $this->model->them($d);
        thongBao('Đã lưu thuốc.');
        chuyenTrang('Thuoc');
    }
    public function delete() {
        kiemTraCsrf();
        if (!laAdmin()) { thongBao('Chỉ Admin được xóa.', 'err'); chuyenTrang('Thuoc'); }
        $this->model->xoa((int)$_POST['id']);
        thongBao('Đã xóa thuốc.');
        chuyenTrang('Thuoc');
    }
}
