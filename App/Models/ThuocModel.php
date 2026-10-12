<?php
class ThuocModel {
    public function layDanhSach($tuKhoa = '') {
        $sql = 'SELECT * FROM thuoc';
        $p = [];
        if ($tuKhoa !== '') { $sql .= ' WHERE ten_thuoc LIKE ?'; $p = ["%$tuKhoa%"]; }
        $st = getDB()->prepare($sql . ' ORDER BY id DESC');
        $st->execute($p);
        return $st->fetchAll();
    }
    public function layTheoId($id) {
        $st = getDB()->prepare('SELECT * FROM thuoc WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }
    public function them($d) {
        $st = getDB()->prepare('INSERT INTO thuoc (ten_thuoc, don_vi, gia_ban, so_luong_ton) VALUES (?,?,?,?)');
        $st->execute([$d['ten_thuoc'], $d['don_vi'], (int)$d['gia_ban'], (int)$d['so_luong_ton']]);
    }
    public function sua($id, $d) {
        $st = getDB()->prepare('UPDATE thuoc SET ten_thuoc=?, don_vi=?, gia_ban=?, so_luong_ton=? WHERE id=?');
        $st->execute([$d['ten_thuoc'], $d['don_vi'], (int)$d['gia_ban'], (int)$d['so_luong_ton'], $id]);
    }
    public function xoa($id) {
        getDB()->prepare('DELETE FROM thuoc WHERE id = ?')->execute([$id]);
    }
    public function laySapHet() {
        return getDB()->query('SELECT * FROM thuoc WHERE so_luong_ton < 50 ORDER BY so_luong_ton')->fetchAll();
    }
}
