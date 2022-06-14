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
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
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
                                <?php if(isset($detail_nilai)) : ?>
                                    <?php if(is_array($detail_nilai)) : ?>
                                        <?php foreach($detail_nilai as $key_detail) : ?>
                                            <tr>
                                                <td><?= (isset($key_detail['pertemuan'])) ? $key_detail['pertemuan'] : '' ?></td>
                                                <td><?= (isset($key_detail['status_absensi'])) ? $key_detail['status_absensi'] : '' ?></td>
                                                <td><?= (isset($key_detail['nilai_awal'])) ? $key_detail['nilai_awal'] : '' ?></td>
                                                <td><?= (isset($key_detail['nilai_materi'])) ? $key_detail['nilai_materi'] : '' ?></td>
                                                <td><?= (isset($key_detail['nilai_tugas'])) ? $key_detail['nilai_tugas'] : '' ?></td>
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
    </div>
</div>