<style>
    p{
        margin-bottom: 0px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- VIEW -->
        <?php if(isset($kelas_praktikum_now)) : ?>
            <?php if(is_array($kelas_praktikum_now)) : ?>
                <?php foreach($kelas_praktikum_now as $key) : ?> 

                <!-- NTAR ADA USER GROUP DATA MUNCUL SESUAI PENGAJAR KALO YG LOGIN PENGAJAR -->
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['hariterpilih'])) ? $key['hariterpilih'] : '' ?> <?= (isset($key['jamterpilih'])) ? $key['jamterpilih'] : '' ?> 
                                <?php if(isset($key['detail_kelas'])){ if($key['detail_kelas'] != 0) echo $key['detail_kelas'][0]['nama_laboratorium']; else echo '';} ?> 
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-periode-ini" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Pertemuan Ke-</th>
                                                <th>Presensi</th>
                                                <th>Pretest</th>
                                                <th>Materi</th>
                                                <th>Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(isset($key['detail_nilai'])) : ?>
                                            <?php if(is_array($key['detail_nilai'])) : ?>
                                                <?php foreach($key['detail_nilai'] as $key_detail) : ?>
                                                    <tr>
                                                        <td><?= (isset($key_detail['pertemuan'])) ? $key_detail['pertemuan'] : '' ?></td>
                                                        <td><?= (isset($key_detail['status_absensi'])) ? $key_detail['status_absensi'] : '' ?></td>
                                                        <td><?= (isset($key_detail['nilai_awal'])) ? $key_detail['nilai_awal'] : '' ?></td>
                                                        <td><?= (isset($key_detail['nilai_materi'])) ? $key_detail['nilai_materi'] : '' ?></td>
                                                        <td><?= (isset($key_detail['nilai_tugas'])) ? $key_detail['nilai_tugas'] : '' ?></td>
                                                    </tr>
                                        <?php //if(isset($key['detail_kelas'])) : ?>
                                            <?php //if(is_array($key['detail_kelas'])) : ?>
                                                <?php //foreach($key['detail_kelas'] as $key_detail) : ?>
                                                <!-- <tr>
                                                    <td><?= (isset($key_detail['NRP'])) ? $key_detail['NRP'] : '' ?></td>
                                                    <td><?= (isset($key_detail['nama_mahasiswa'])) ? $key_detail['nama_mahasiswa'] : '' ?></td>
                                                </tr> -->
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- DATA KOSONG -->
                Belum ada pertemuan kelas
            <?php endif; ?>
        
        <?php endif; ?>
        
    </div>
</div>