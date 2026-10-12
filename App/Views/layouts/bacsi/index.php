<h1>Quản lý bác sĩ</h1>
<div class="bar">
  <form method="get">
    <input type="hidden" name="controller" value="BacSi">
    <input name="q" placeholder="Tìm theo tên, SĐT..." value="<?= e($q) ?>">
    <button>Tìm</button>
  </form>
  <a class="btn" href="<?= url('BacSi', 'create') ?>">+ Thêm bác sĩ</a>
</div>
<table>
  <tr><th>#</th><th>Họ tên</th><th>Chuyên khoa</th><th>SĐT</th><th></th></tr>
  <?php foreach ($ds as $r): ?>
  <tr>
    <td><?= e($r['id']) ?></td><td><?= e($r['ho_ten']) ?></td><td><?= e($r['ten_khoa']) ?></td><td><?= e($r['sdt']) ?></td>
    <td class="act">
      <a href="<?= url('BacSi', 'edit', ['id' => $r['id']]) ?>">Sửa</a>
      <?php if (laAdmin()): ?>
      <form method="post" action="<?= url('BacSi', 'delete') ?>" onsubmit="return confirm('Xóa bác sĩ này?')">
        <input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= e($r['id']) ?>">
        <button class="link danger">Xóa</button>
      </form>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$ds): ?><tr><td colspan="5">Chưa có dữ liệu.</td></tr><?php endif; ?>
</table>
