<h1><?= $row ? 'Sửa bác sĩ' : 'Thêm bác sĩ' ?></h1>
<form method="post" action="<?= url('BacSi', 'save') ?>" class="card">
  <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
  <input type="hidden" name="id" value="<?= e($row['id'] ?? '') ?>">
  <label>Họ tên <input name="ho_ten" required value="<?= e($row['ho_ten'] ?? '') ?>"></label>
  <label>Chuyên khoa
    <select name="chuyen_khoa_id" required>
      <option value="">-- Chọn --</option>
      <?php foreach ($khoa as $k): ?>
        <option value="<?= $k['id'] ?>" <?= ($row['chuyen_khoa_id'] ?? '') == $k['id'] ? 'selected' : '' ?>><?= e($k['ten_khoa']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Số điện thoại <input name="sdt" value="<?= e($row['sdt'] ?? '') ?>"></label>
  <button>Lưu</button> <a href="<?= url('BacSi') ?>">Hủy</a>
</form>
