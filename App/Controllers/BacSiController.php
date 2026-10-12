<?php
require_once 'Models/BacSiModel.php';

class BacSiController {
    private $model;
    public function __construct() { $this->model = new BacSiModel(); }

    public function index() {
        $q = trim($_GET['q'] ?? '');
        view('layouts/bacsi/index', ['ds' => $this->model->layDanhSach($q), 'q' => $q]);
    }
    public function create() {
        view('layouts/bacsi/form', ['row' => [], 'khoa' => $this->model->layChuyenKhoa()]);
    }
    public function edit() {
        $row = $this->model->layTheoId((int)($_GET['id'] ?? 0));
        if (!$row) die('Không tìm thấy bác sĩ.');
        view('layouts/bacsi/form', ['row' => $row, 'khoa' => $this->model->layChuyenKhoa()]);
    }
    public function save() {
        kiemTraCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $d = [
            'ho_ten' => trim($_POST['ho_ten'] ?? ''),
            'chuyen_khoa_id' => (int)($_POST['chuyen_khoa_id'] ?? 0),
            'sdt' => trim($_POST['sdt'] ?? ''),
        ];
        if ($d['ho_ten'] === '' || $d['chuyen_khoa_id'] === 0) {
            thongBao('Vui lòng nhập họ tên và chọn chuyên khoa.', 'err');
            chuyenTrang('BacSi', $id ? 'edit' : 'create', $id ? ['id' => $id] : []);
        }
        $id ? $this->model->sua($id, $d) : $this->model->them($d);
        thongBao('Đã lưu bác sĩ.');
        chuyenTrang('BacSi');
    }
    public function delete() {
        kiemTraCsrf();
        if (!laAdmin()) { thongBao('Chỉ Admin được xóa.', 'err'); chuyenTrang('BacSi'); }
        try {
            $this->model->xoa((int)$_POST['id']);
            thongBao('Đã xóa bác sĩ.');
        } catch (PDOException $e) {
            thongBao('Không thể xóa: bác sĩ đã có lịch hẹn.', 'err');
        }
        chuyenTrang('BacSi');
    }
}
