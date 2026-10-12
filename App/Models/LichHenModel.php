<?php
class LichHenModel {
    private $select = 'SELECT l.*, b.ho_ten AS ten_benh_nhan, s.ho_ten AS ten_bac_si
                        FROM lich_hen l
                        JOIN benh_nhan b ON b.id = l.benh_nhan_id
                        JOIN bac_si s ON s.id = l.bac_si_id';

    public function layDanhSach($tuKhoa = '') {
        $sql = $this->select;
        $p = [];
        if ($tuKhoa !== '') {
            $sql .= ' WHERE b.ho_ten LIKE ? OR s.ho_ten LIKE ?';
            $p = ["%$tuKhoa%", "%$tuKhoa%"];
        }
        $st = getDB()->prepare($sql . ' ORDER BY l.ngay_gio DESC');
        $st->execute($p);
        return $st->fetchAll();
    }
    public function layHomNay() {
        return getDB()->query($this->select . " WHERE DATE(l.ngay_gio) = CURDATE() AND l.trang_thai <> 'da_huy' ORDER BY l.ngay_gio")->fetchAll();
    }
    public function layTheoId($id) {
        $st = getDB()->prepare('SELECT * FROM lich_hen WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }
    // Bác sĩ đã có lịch cùng giờ chưa? ($boQuaId dùng khi sửa)
    public function biTrungLich($bacSiId, $ngayGio, $boQuaId = 0) {
        $st = getDB()->prepare("SELECT COUNT(*) FROM lich_hen WHERE bac_si_id = ? AND ngay_gio = ? AND trang_thai <> 'da_huy' AND id <> ?");
        $st->execute([$bacSiId, $ngayGio, $boQuaId]);
        return $st->fetchColumn() > 0;
    }
    public function them($d) {
        $st = getDB()->prepare('INSERT INTO lich_hen (benh_nhan_id, bac_si_id, ngay_gio, ly_do, trang_thai, chan_doan, ghi_chu) VALUES (?,?,?,?,?,?,?)');
        $st->execute([$d['benh_nhan_id'], $d['bac_si_id'], $d['ngay_gio'], $d['ly_do'], $d['trang_thai'], $d['chan_doan'], $d['ghi_chu']]);
    }
    public function sua($id, $d) {
        $st = getDB()->prepare('UPDATE lich_hen SET benh_nhan_id=?, bac_si_id=?, ngay_gio=?, ly_do=?, trang_thai=?, chan_doan=?, ghi_chu=? WHERE id=?');
        $st->execute([$d['benh_nhan_id'], $d['bac_si_id'], $d['ngay_gio'], $d['ly_do'], $d['trang_thai'], $d['chan_doan'], $d['ghi_chu'], $id]);
    }
    public function xoa($id) {
        getDB()->prepare('DELETE FROM lich_hen WHERE id = ?')->execute([$id]);
    }
    public function demTong() {
        return (int)getDB()->query('SELECT COUNT(*) FROM lich_hen')->fetchColumn();
    }
}
