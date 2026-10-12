<?php
// Điểm vào duy nhất: index.php?controller=BenhNhan&action=index
session_start();
require_once 'db.php';

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function url($controller, $action = 'index', $params = []) {
    return 'index.php?' . http_build_query(['controller' => $controller, 'action' => $action] + $params);
}
function chuyenTrang($controller, $action = 'index', $params = []) {
    header('Location: ' . url($controller, $action, $params));
    exit;
}
function csrf() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function kiemTraCsrf() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(400);
        die('Yêu cầu không hợp lệ.');
    }
}
function laAdmin() { return ($_SESSION['user']['vai_tro'] ?? '') === 'admin'; }
function thongBao($noiDung, $loai = 'ok') { $_SESSION['thongbao'] = [$loai, $noiDung]; }
function nhanTrangThai($tt) {
    $ds = ['cho_kham' => 'Chờ khám', 'da_kham' => 'Đã khám', 'da_huy' => 'Đã hủy'];
    return $ds[$tt] ?? $tt;
}

// Hiển thị view: header + nội dung + footer
function view($file, $data = []) {
    extract($data);
    $thongbao = $_SESSION['thongbao'] ?? null;
    unset($_SESSION['thongbao']);
    require 'Views/header.php';
    require 'Views/' . $file . '.php';
    require 'Views/footer.php';
}

$cacController = ['Home', 'Login', 'Dashboard', 'BenhNhan', 'BacSi', 'LichHen', 'Thuoc'];
$controller = $_GET['controller'] ?? 'Home';
$action = $_GET['action'] ?? 'index';

if (!in_array($controller, $cacController, true) || !preg_match('/^[a-zA-Z]+$/', $action)) {
    http_response_code(404);
    die('Trang không tồn tại.');
}
if ($controller !== 'Login' && $controller !== 'Home' && empty($_SESSION['user'])) {
    chuyenTrang('Login');
}

require_once "Controllers/{$controller}Controller.php";
$class = $controller . 'Controller';
$obj = new $class();
if (!method_exists($obj, $action)) {
    http_response_code(404);
    die('Chức năng không tồn tại.');
}
$obj->$action();
