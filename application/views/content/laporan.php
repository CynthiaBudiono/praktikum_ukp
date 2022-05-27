<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="clearfix"></div>

    <div class="row">
        <div class="x_panel">
            <div class="x_content">
                
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Kelas</h5>
                                <p class="card-text">Dapat memperoleh laporan kelas praktikum yang ada pada periode saat ini</p>
                                <a href="<?= base_url("laporan/kelas"); ?>" class="btn bg-green">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Lulus Praktikum</h5>
                            <p class="card-text">Dapat memperoleh laporan mahasiswa yang lulus praktikum yang ada pada periode saat ini</p>
                            <a href="<?= base_url("laporan/lulus"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Tidak Lulus Praktikum</h5>
                            <p class="card-text">Dapat memperoleh laporan mahasiswa yang tidak lulus praktikum yang ada pada periode saat ini</p>
                            <a href="<?= base_url("laporan/tidak_lulus"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Detail Kelas Praktikum</h5>
                            <p class="card-text">Dapat memperoleh detail kelas praktikum yang ada pada periode saat ini</p>
                            <a href="<?= base_url("laporan/detail_kelas"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Nilai Kelas Praktikum</h5>
                            <p class="card-text">Dapat memperoleh laporan nilai kelas praktikum yang ada pada periode saat ini</p>
                            <a href="<?= base_url("laporan/nilai_kelas"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Mahasiswa</h5>
                            <p class="card-text">Dapat memperoleh laporan kelas praktikum yang telah diambil mahasiswa pada periode saat ini</p>
                            <a href="<?= base_url("laporan/mahasiswa"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Mahasiswa Tertolak</h5>
                            <p class="card-text">Dapat memperoleh laporan mahasiswa yang tertolak pada periode saat ini</p>
                            <a href="<?= base_url("laporan/mahasiswa_tertolak"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Transfer Nilai</h5>
                            <p class="card-text">Dapat memperoleh laporan transfer nilai pada periode saat ini</p>
                            <a href="<?= base_url("laporan/transfer_nilai"); ?>" class="btn bg-green">View</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- /page content -->