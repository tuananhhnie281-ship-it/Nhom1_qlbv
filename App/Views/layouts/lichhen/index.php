<h1>Lịch hẹn khám</h1>
<div class="bar">
  <form method="get">
    <input type="hidden" name="controller" value="LichHen">
    <input name="q" placeholder="Tìm bệnh nhân / bác sĩ..." value="<?= e($q) ?>">
    <button>Tìm</button>
  </form>
  <a class="btn" href="<?= url('LichHen', 'create') ?>">+ Đặt lịch</a>
</div>
<table>
  <tr><th>Thời gian</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Lý do</th><th>Trạng thái</th><th></th></tr>
  <?php foreach ($ds as $r): ?>
  <tr>
    <td><?= e($r['ngay_gio']) ?></td><td><?= e($r['ten_benh_nhan']) ?></td><td><?= e($r['ten_bac_si']) ?></td><td><?= e($r['ly_do']) ?></td>
    <td><span class="tag <?= e($r['trang_thai']) ?>"><?= e(nhanTrangThai($r['trang_thai'])) ?></span></td>
    <td class="act">
      <a href="<?= url('LichHen', 'edit', ['id' => $r['id']]) ?>">Sửa / Khám</a>
      <?php if (laAdmin()): ?>
      <form method="post" action="<?= url('LichHen', 'delete') ?>" onsubmit="return confirm('Xóa lịch hẹn này?')">
        <input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= e($r['id']) ?>">
        <button class="link danger">Xóa</button>
      </form>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php if (!$ds): ?><tr><td colspan="6">Chưa có lịch hẹn.</td></tr><?php endif; ?>
</table>
