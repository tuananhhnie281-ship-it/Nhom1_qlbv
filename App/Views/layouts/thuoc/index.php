<h1>Quản lý thuốc</h1>
<div class="bar">
  <form method="get">
    <input type="hidden" name="controller" value="Thuoc">
    <input name="q" placeholder="Tìm tên thuốc..." value="<?= e($q) ?>">
    <button>Tìm</button>
  </form>
  <a class="btn" href="<?= url('Thuoc', 'create') ?>">+ Thêm thuốc</a>
</div>
<table>
  <tr><th>#</th><th>Tên thuốc</th><th>Đơn vị</th><th>Giá bán</th><th>Tồn kho</th><th></th></tr>
  <?php foreach ($ds as $r): ?>
  <tr>
    <td><?= e($r['id']) ?></td><td><?= e($r['ten_thuoc']) ?></td><td><?= e($r['don_vi']) ?></td>
    <td><?= number_format($r['gia_ban'], 0, ',', '.') ?> đ</td><td><?= e($r['so_luong_ton']) ?></td>
    <td class="act">
      <a href="<?= url('Thuoc', 'edit', ['id' => $r['id']]) ?>">Sửa</a>
      <?php if (laAdmin()): ?>
      <form method="post" action="<?= url('Thuoc', 'delete') ?>" onsubmit="return confirm('Xóa thuốc này?')">
        <input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= e($r['id']) ?>">
        <button class="link danger">Xóa</button>
      </form>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$ds): ?><tr><td colspan="6">Chưa có dữ liệu.</td></tr><?php endif; ?>
</table>
