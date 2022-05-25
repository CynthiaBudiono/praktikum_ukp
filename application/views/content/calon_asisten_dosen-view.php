<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= isset($title) ? $title : "-" ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Nama </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['nama_mahasiswa']) ? $detil[0]['nama_mahasiswa'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Alamat </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['alamat']) ? $detil[0]['alamat'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> NO HP </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['no_hp']) ? $detil[0]['no_hp'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> LINE ID </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['line_id']) ? $detil[0]['line_id'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Gender </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['gender']) ? $detil[0]['gender'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Motivasi </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['motivasi']) ? $detil[0]['motivasi'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Kelebihan </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['alamat']) ? $detil[0]['alamat'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Kekurangan </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['kekurangan']) ? $detil[0]['kekurangan'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Komitmen </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['komitmen']) ? $detil[0]['komitmen'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Pengalaman </div>
                                <div class="col-md-8 col-sm-12"> <?= isset($detil[0]['pengalaman']) ? $detil[0]['pengalaman'] : "" ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-sm-12"> Berkas </div>
                                <div class="col-md-8 col-sm-12"> Open a berkas file, <a target="_blank" href="<?= base_url() ?>/assets/berkas/<?= isset($detil[0]['upload_berkas']) ? $detil[0]['upload_berkas'] : "" ?>"><?= isset($detil[0]['upload_berkas']) ? $detil[0]['upload_berkas'] : "-" ?></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>