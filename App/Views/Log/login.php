<form method="post" action="<?= url('Login', 'dangNhap') ?>" class="card login">
  <h2>Đăng nhập</h2>
  <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
  <label>Tên đăng nhập <input name="ten_dang_nhap" required autofocus></label>
  <label>Mật khẩu <input type="password" name="mat_khau" required></label>
  <button>Đăng nhập</button>
  <small>Tài khoản mẫu: admin / admin123 · letan / letan123</small>
</form>
