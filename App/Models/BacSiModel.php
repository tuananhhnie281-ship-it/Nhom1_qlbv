<?php
class BacSiModel {
    public function layDanhSach($tuKhoa = '') {
        $sql = 'SELECT b.*, k.ten_khoa FROM bac_si b JOIN chuyen_khoa k ON k.id = b.chuyen_khoa_id';
        $p = [];
        if ($tuKhoa !== '') {
            $sql .= ' WHERE b.ho_ten LIKE ? OR b.sdt LIKE ?';
            $p = ["%$tuKhoa%", "%$tuKhoa%"];
        }
        $st = getDB()->prepare($sql . ' ORDER BY b.id DESC');
        $st->execute($p);
        return $st->fetchAll();
    }
    public function layChuyenKhoa() {
        return getDB()->query('SELECT * FROM chuyen_khoa ORDER BY ten_khoa')->fetchAll();
    }
    public function layTheoId($id) {
        $st = getDB()->prepare('SELECT * FROM bac_si WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }
    public function them($d) {
        $st = getDB()->prepare('INSERT INTO bac_si (ho_ten, chuyen_khoa_id, sdt) VALUES (?,?,?)');
        $st->execute([$d['ho_ten'], $d['chuyen_khoa_id'], $d['sdt']]);
    }
    public function sua($id, $d) {
        $st = getDB()->prepare('UPDATE bac_si SET ho_ten=?, chuyen_khoa_id=?, sdt=? WHERE id=?');
        $st->execute([$d['ho_ten'], $d['chuyen_khoa_id'], $d['sdt'], $id]);
    }
    public function xoa($id) {
        getDB()->prepare('DELETE FROM bac_si WHERE id = ?')->execute([$id]);
    }
    public function demTong() {
        return (int)getDB()->query('SELECT COUNT(*) FROM bac_si')->fetchColumn();
    }
}
