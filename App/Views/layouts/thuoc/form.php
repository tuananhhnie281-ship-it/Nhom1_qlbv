<h1><?= $row ? 'Sửa thuốc' : 'Thêm thuốc' ?></h1>
<form method="post" action="<?= url('Thuoc', 'save') ?>" class="card">
  <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
  <input type="hidden" name="id" value="<?= e($row['id'] ?? '') ?>">
  <label>Tên thuốc <input name="ten_thuoc" required value="<?= e($row['ten_thuoc'] ?? '') ?>"></label>
  <label>Đơn vị <input name="don_vi" value="<?= e($row['don_vi'] ?? '') ?>"></label>
  <label>Giá bán (VNĐ) <input type="number" min="0" name="gia_ban" value="<?= e($row['gia_ban'] ?? 0) ?>"></label>
  <label>Số lượng tồn <input type="number" min="0" name="so_luong_ton" value="<?= e($row['so_luong_ton'] ?? 0) ?>"></label>
  <button>Lưu</button> <a href="<?= url('Thuoc') ?>">Hủy</a>
</form>
