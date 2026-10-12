<h1><?= !empty($row['id']) ? 'Sửa lịch hẹn' : 'Đặt lịch khám' ?></h1>
<form method="post" action="<?= url('LichHen', 'save') ?>" class="card">
  <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
  <input type="hidden" name="id" value="<?= e($row['id'] ?? '') ?>">
  <label>Bệnh nhân
    <select name="benh_nhan_id" required>
      <option value="">-- Chọn --</option>
      <?php foreach ($dsBenhNhan as $b): ?>
        <option value="<?= $b['id'] ?>" <?= ($row['benh_nhan_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= e($b['ho_ten']) ?> (<?= e($b['sdt']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Bác sĩ
    <select name="bac_si_id" required>
      <option value="">-- Chọn --</option>
      <?php foreach ($dsBacSi as $s): ?>
        <option value="<?= $s['id'] ?>" <?= ($row['bac_si_id'] ?? '') == $s['id'] ? 'selected' : '' ?>><?= e($s['ho_ten']) ?> - <?= e($s['ten_khoa']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Thời gian khám
    <input type="datetime-local" name="ngay_gio" required value="<?= e(str_replace(' ', 'T', substr($row['ngay_gio'] ?? '', 0, 16))) ?>">
  </label>
  <label>Lý do khám <input name="ly_do" value="<?= e($row['ly_do'] ?? '') ?>"></label>
  <label>Trạng thái
    <select name="trang_thai">
      <?php foreach (['cho_kham', 'da_kham', 'da_huy'] as $tt): ?>
        <option value="<?= $tt ?>" <?= ($row['trang_thai'] ?? 'cho_kham') === $tt ? 'selected' : '' ?>><?= nhanTrangThai($tt) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Chẩn đoán <textarea name="chan_doan" rows="3"><?= e($row['chan_doan'] ?? '') ?></textarea></label>
  <label>Ghi chú / Đơn thuốc <textarea name="ghi_chu" rows="3"><?= e($row['ghi_chu'] ?? '') ?></textarea></label>
  <button>Lưu</button> <a href="<?= url('LichHen') ?>">Hủy</a>
</form>
