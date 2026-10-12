<h1>Quản lý bệnh nhân</h1>
<div class="bar">
  <form method="get">
    <input type="hidden" name="controller" value="BenhNhan">
    <input name="q" placeholder="Tìm theo tên, SĐT, BHYT..." value="<?= e($q) ?>">
    <button>Tìm</button>
  </form>
  <a class="btn" href="<?= url('BenhNhan', 'create') ?>">+ Thêm bệnh nhân</a>
</div>
<table>
  <tr><th>#</th><th>Họ tên</th><th>Ngày sinh</th><th>Giới tính</th><th>SĐT</th><th>Địa chỉ</th><th>Số BHYT</th><th></th></tr>
  <?php foreach ($ds as $r): ?>
  <tr>
    <td><?= e($r['id']) ?></td><td><?= e($r['ho_ten']) ?></td><td><?= e($r['ngay_sinh']) ?></td>
    <td><?= e($r['gioi_tinh']) ?></td><td><?= e($r['sdt']) ?></td><td><?= e($r['dia_chi']) ?></td><td><?= e($r['so_bhyt']) ?></td>
    <td class="act">
      <a href="<?= url('BenhNhan', 'edit', ['id' => $r['id']]) ?>">Sửa</a>
      <?php if (laAdmin()): ?>
      <form method="post" action="<?= url('BenhNhan', 'delete') ?>" onsubmit="return confirm('Xóa bệnh nhân này?')">
        <input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= e($r['id']) ?>">
        <button class="link danger">Xóa</button>
      </form>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$ds): ?><tr><td colspan="8">Chưa có dữ liệu.</td></tr><?php endif; ?>
</table>
