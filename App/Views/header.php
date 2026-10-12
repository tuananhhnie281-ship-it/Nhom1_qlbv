<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý bệnh viện</title>
  <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
<?php if (!empty($_SESSION['user'])): ?>
<nav>
  <strong>🏥 Bệnh viện</strong>
  <a href="<?= url('Dashboard') ?>">Tổng quan</a>
  <a href="<?= url('BenhNhan') ?>">Bệnh nhân</a>
  <a href="<?= url('BacSi') ?>">Bác sĩ</a>
  <a href="<?= url('LichHen') ?>">Lịch hẹn</a>
  <a href="<?= url('Thuoc') ?>">Thuốc</a>
  <span class="right"><?= e($_SESSION['user']['ho_ten']) ?> · <a href="<?= url('Login', 'dangXuat') ?>">Đăng xuất</a></span>
</nav>
<?php endif; ?>
<main>
<?php if (!empty($thongbao)): ?>
  <div class="flash <?= e($thongbao[0]) ?>"><?= e($thongbao[1]) ?></div>
<?php endif; ?>
