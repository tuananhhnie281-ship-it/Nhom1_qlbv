<?php
require_once 'Models/BenhNhanModel.php';
require_once 'Models/BacSiModel.php';
require_once 'Models/LichHenModel.php';
require_once 'Models/ThuocModel.php';

class DashboardController {
    public function index() {
        $bn = new BenhNhanModel();
        $bs = new BacSiModel();
        $lh = new LichHenModel();
        $th = new ThuocModel();
        view('layouts/dashboard/index', [
            'tongBenhNhan' => $bn->demTong(),
            'tongBacSi'    => $bs->demTong(),
            'tongLichHen'  => $lh->demTong(),
            'lichHomNay'   => $lh->layHomNay(),
            'thuocSapHet'  => $th->laySapHet(),
        ]);
    }
}
