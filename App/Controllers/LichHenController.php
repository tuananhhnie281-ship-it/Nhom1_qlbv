<?php
require_once 'Models/LichHenModel.php';
require_once 'Models/BenhNhanModel.php';
require_once 'Models/BacSiModel.php';

class LichHenController {
    private $model;
    public function __construct() { $this->model = new LichHenModel(); }

    private function hienForm($row) {
        view('layouts/lichhen/form', [
            'row' => $row,
            'dsBenhNhan' => (new BenhNhanModel())->layDanhSach(),
            'dsBacSi' => (new BacSiModel())->layDanhSach(),
        ]);
    }
    public function index() {
        $q = trim($_GET['q'] ?? '');
        view('layouts/lichhen/index', ['ds' => $this->model->layDanhSach($q), 'q' => $q]);
    }
    public function create() {
        $this->hienForm(['trang_thai' => 'cho_kham']);
    }
    public function edit() {
        $row = $this->model->layTheoId((int)($_GET['id'] ?? 0));
        if (!$row) die('Không tìm thấy lịch hẹn.');
        $this->hienForm($row);
    }
    public function save() {
        kiemTraCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $d = [
            'benh_nhan_id' => (int)($_POST['benh_nhan_id'] ?? 0),
            'bac_si_id' => (int)($_POST['bac_si_id'] ?? 0),
            'ngay_gio' => str_replace('T', ' ', substr($_POST['ngay_gio'] ?? '', 0, 16)),
            'ly_do' => trim($_POST['ly_do'] ?? ''),
            'trang_thai' => $_POST['trang_thai'] ?? 'cho_kham',
            'chan_doan' => trim($_POST['chan_doan'] ?? ''),
            'ghi_chu' => trim($_POST['ghi_chu'] ?? ''),
        ];
        if (!in_array($d['trang_thai'], ['cho_kham', 'da_kham', 'da_huy'], true)) $d['trang_thai'] = 'cho_kham';

        $loi = '';
        if ($d['benh_nhan_id'] === 0 || $d['bac_si_id'] === 0) $loi = 'Vui lòng chọn bệnh nhân và bác sĩ.';
        elseif (!DateTime::createFromFormat('Y-m-d H:i', $d['ngay_gio'])) $loi = 'Thời gian không hợp lệ.';
        elseif ($d['trang_thai'] !== 'da_huy' && $this->model->biTrungLich($d['bac_si_id'], $d['ngay_gio'], $id))
            $loi = 'Bác sĩ đã có lịch vào giờ này, hãy chọn giờ khác.';

        if ($loi !== '') {
            thongBao($loi, 'err');
            $d['id'] = $id;
            $this->hienForm($d);   // hiện lại form, giữ dữ liệu đã nhập
            return;
        }
        $id ? $this->model->sua($id, $d) : $this->model->them($d);
        thongBao('Đã lưu lịch hẹn.');
        chuyenTrang('LichHen');
    }
    public function delete() {
        kiemTraCsrf();
        if (!laAdmin()) { thongBao('Chỉ Admin được xóa.', 'err'); chuyenTrang('LichHen'); }
        $this->model->xoa((int)$_POST['id']);
        thongBao('Đã xóa lịch hẹn.');
        chuyenTrang('LichHen');
    }
}
