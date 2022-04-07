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
                    <!-- for($key=0; $key < count($kelas_praktikum_now); $key++ ){ -->
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['hari'])) ? $key['hari'] : '' ?> <?= (isset($key['jam'])) ? $key['jam'] : '' ?> <?= (isset($key['terisi'])) ? $key['terisi'] : '-' ?> Mhs </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/adds"); ?>">Tambah Pertemuan</a>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-periode-ini" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>Actions</th> -->
                                                <th>NRP</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(isset($detail_kelas)) : ?>
                                            <?php if(is_array($detail_kelas)) : ?>
                                                <?php foreach($detail_kelas as $key) : ?>
                                                <tr>
                                                    <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?></td>
                                                    <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                                                </tr>
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
