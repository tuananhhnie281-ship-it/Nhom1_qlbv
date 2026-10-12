<h1>Tổng quan</h1>
<div class="stats">
  <div class="card"><b><?= $tongBenhNhan ?></b>Bệnh nhân</div>
  <div class="card"><b><?= $tongBacSi ?></b>Bác sĩ</div>
  <div class="card"><b><?= $tongLichHen ?></b>Lịch hẹn</div>
</div>

<h2>Lịch khám hôm nay</h2>
<table>
  <tr><th>Giờ</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Trạng thái</th></tr>
  <?php foreach ($lichHomNay as $r): ?>
    <tr>
      <td><?= e(substr($r['ngay_gio'], 11, 5)) ?></td>
      <td><?= e($r['ten_benh_nhan']) ?></td>
      <td><?= e($r['ten_bac_si']) ?></td>
      <td><?= e(nhanTrangThai($r['trang_thai'])) ?></td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$lichHomNay): ?><tr><td colspan="4">Hôm nay chưa có lịch.</td></tr><?php endif; ?>
</table>

<h2>Thuốc sắp hết (tồn dưới 50)</h2>
<table>
  <tr><th>Tên thuốc</th><th>Tồn kho</th></tr>
  <?php foreach ($thuocSapHet as $t): ?>
    <tr><td><?= e($t['ten_thuoc']) ?></td><td><?= e($t['so_luong_ton']) ?></td></tr>
  <?php endforeach; ?>
  <?php if (!$thuocSapHet): ?><tr><td colspan="2">Tất cả đều đủ.</td></tr><?php endif; ?>
</table>
