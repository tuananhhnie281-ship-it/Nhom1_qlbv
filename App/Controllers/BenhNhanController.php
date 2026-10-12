<?php
require_once 'Models/BenhNhanModel.php';

class BenhNhanController {
    private $model;
    public function __construct() { $this->model = new BenhNhanModel(); }

    public function index() {
        $q = trim($_GET['q'] ?? '');
        view('layouts/benhnhan/index', ['ds' => $this->model->layDanhSach($q), 'q' => $q]);
    }
    public function create() {
        view('layouts/benhnhan/form', ['row' => []]);
    }
    public function edit() {
        $row = $this->model->layTheoId((int)($_GET['id'] ?? 0));
        if (!$row) die('Không tìm thấy bệnh nhân.');
        view('layouts/benhnhan/form', ['row' => $row]);
    }
    public function save() {
        kiemTraCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $d = [
            'ho_ten' => trim($_POST['ho_ten'] ?? ''), 'ngay_sinh' => $_POST['ngay_sinh'] ?? '',
            'gioi_tinh' => $_POST['gioi_tinh'] ?? '', 'sdt' => trim($_POST['sdt'] ?? ''),
            'dia_chi' => trim($_POST['dia_chi'] ?? ''), 'so_bhyt' => trim($_POST['so_bhyt'] ?? ''),
        ];
        if ($d['ho_ten'] === '') {
            thongBao('Vui lòng nhập họ tên.', 'err');
            chuyenTrang('BenhNhan', $id ? 'edit' : 'create', $id ? ['id' => $id] : []);
        }
        $id ? $this->model->sua($id, $d) : $this->model->them($d);
        thongBao('Đã lưu bệnh nhân.');
        chuyenTrang('BenhNhan');
    }
    public function delete() {
        kiemTraCsrf();
        if (!laAdmin()) { thongBao('Chỉ Admin được xóa.', 'err'); chuyenTrang('BenhNhan'); }
        try {
            $this->model->xoa((int)$_POST['id']);
            thongBao('Đã xóa bệnh nhân.');
        } catch (PDOException $e) {
            thongBao('Không thể xóa: bệnh nhân đã có lịch hẹn.', 'err');
        }
        chuyenTrang('BenhNhan');
    }
}
