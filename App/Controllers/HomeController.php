<?php
class HomeController {
    public function index() {
        if (!empty($_SESSION['user'])) chuyenTrang('Dashboard');
        chuyenTrang('Login');
    }
}
