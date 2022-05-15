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
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
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
                                <?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['hari'])) ? $key['hari'] : '' ?> <?= (isset($key['jam'])) ? $key['jam'] : '' ?> 
                                <?php if(isset($key['detail_kelas'])){ if($key['detail_kelas'] != 0) echo $key['detail_kelas'][0]['nama_laboratorium']; else echo '';} ?> 
                                <?= (isset($key['terisi'])) ? $key['terisi'] : '-' ?> Mhs / 
                                
                                <?php if(isset($key['detail_kelas'])){ if($key['detail_kelas'] != 0) echo $key['detail_kelas'][0]['quota_max']; else echo '';} ?>
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?php if(isset($key['detail_nilai'])){ if($key['detail_nilai'] != 0) $pertemuan = $key['detail_nilai'][0]['pertemuan']; else $pertemuan = '0';} ?>
                                <a class="btn btn-sm bg-green" href="<?php echo base_url("mahasiswa_nilai/tambah_pertemuan/"); echo base64_encode($key['id'])."/".$pertemuan; ?>">Tambah Pertemuan</a>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                Pertemuan terakhir ke- <?php if(isset($key['detail_nilai'])){ if($key['detail_nilai'] != 0) echo $key['detail_nilai'][0]['pertemuan']; else echo '0';} ?>
                            </div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-periode-ini" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Pertemuan Ke-</th>
                                                <th>Tanggal</th>
                                                <!-- <th>NRP</th>
                                                <th>Nama</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(isset($key['all_pertemuan'])) : ?>
                                            <?php if(is_array($key['all_pertemuan'])) : ?>
                                                <?php foreach($key['all_pertemuan'] as $key_detail) : ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo base_url("mahasiswa_nilai/updates/"); echo base64_encode($key_detail['id_kelas_praktikum'])."/".($key_detail['pertemuan']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a> 
                                                        </td>
                                                        <td><?= (isset($key_detail['pertemuan'])) ? $key_detail['pertemuan'] : '' ?></td>
                                                        <td><?= (isset($key_detail['tanggal_pertemuan'])) ? $key_detail['tanggal_pertemuan'] : '' ?></td>
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
            <?php endif; ?>
                <?php //else : ?>

                    <!-- DATA KOSONG -->
            <?php endif; ?>
        
    </div>
</div>


<script>
    var baseurl = "<?php echo base_url(); ?>";

    $(document).ready(function() {
        // $('#datatable-periode-ini').DataTable( {
        //     dom: "Blfrtip",
        //     buttons: [
        //         {
        //             extend: "copy",
        //             className: "btn-sm"
        //         },
        //         {
        //             extend: "csv",
        //             className: "btn-sm"
        //         },
        //         {
        //             extend: "excel",
        //             className: "btn-sm"
        //         },
        //         {
        //             extend: "pdfHtml5",
        //             className: "btn-sm"
        //         },
        //         {
        //             extend: "print",
        //             className: "btn-sm"
        //         },
        //     ],
        //     responsive: true
        // });
    });
</script>
