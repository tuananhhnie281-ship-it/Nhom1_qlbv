<?php
class BenhNhanModel {
    public function layDanhSach($tuKhoa = '') {
        $sql = 'SELECT * FROM benh_nhan';
        $p = [];
        if ($tuKhoa !== '') {
            $sql .= ' WHERE ho_ten LIKE ? OR sdt LIKE ? OR so_bhyt LIKE ?';
            $p = ["%$tuKhoa%", "%$tuKhoa%", "%$tuKhoa%"];
        }
        $st = getDB()->prepare($sql . ' ORDER BY id DESC');
        $st->execute($p);
        return $st->fetchAll();
    }
    public function layTheoId($id) {
        $st = getDB()->prepare('SELECT * FROM benh_nhan WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }
    public function them($d) {
        $st = getDB()->prepare('INSERT INTO benh_nhan (ho_ten, ngay_sinh, gioi_tinh, sdt, dia_chi, so_bhyt) VALUES (?,?,?,?,?,?)');
        $st->execute([$d['ho_ten'], $d['ngay_sinh'] ?: null, $d['gioi_tinh'], $d['sdt'], $d['dia_chi'], $d['so_bhyt']]);
    }
    public function sua($id, $d) {
        $st = getDB()->prepare('UPDATE benh_nhan SET ho_ten=?, ngay_sinh=?, gioi_tinh=?, sdt=?, dia_chi=?, so_bhyt=? WHERE id=?');
        $st->execute([$d['ho_ten'], $d['ngay_sinh'] ?: null, $d['gioi_tinh'], $d['sdt'], $d['dia_chi'], $d['so_bhyt'], $id]);
    }
    public function xoa($id) {
        getDB()->prepare('DELETE FROM benh_nhan WHERE id = ?')->execute([$id]);
    }
    public function demTong() {
        return (int)getDB()->query('SELECT COUNT(*) FROM benh_nhan')->fetchColumn();
    }
}
