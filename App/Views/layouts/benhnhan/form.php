<h1><?= $row ? 'Sửa bệnh nhân' : 'Thêm bệnh nhân' ?></h1>
<form method="post" action="<?= url('BenhNhan', 'save') ?>" class="card">
  <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
  <input type="hidden" name="id" value="<?= e($row['id'] ?? '') ?>">
  <label>Họ tên <input name="ho_ten" required value="<?= e($row['ho_ten'] ?? '') ?>"></label>
  <label>Ngày sinh <input type="date" name="ngay_sinh" value="<?= e($row['ngay_sinh'] ?? '') ?>"></label>
  <label>Giới tính
    <select name="gioi_tinh">
      <?php foreach (['Nam', 'Nữ', 'Khác'] as $g): ?>
        <option value="<?= $g ?>" <?= ($row['gioi_tinh'] ?? '') === $g ? 'selected' : '' ?>><?= $g ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Số điện thoại <input name="sdt" value="<?= e($row['sdt'] ?? '') ?>"></label>
  <label>Địa chỉ <input name="dia_chi" value="<?= e($row['dia_chi'] ?? '') ?>"></label>
  <label>Số BHYT <input name="so_bhyt" value="<?= e($row['so_bhyt'] ?? '') ?>"></label>
  <button>Lưu</button> <a href="<?= url('BenhNhan') ?>">Hủy</a>
</form>
