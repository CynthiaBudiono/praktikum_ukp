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

        <!-- <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Kode Lab</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" placeholder="ex. JK">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" placeholder="ex. Jaringan Komputer">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Quota Maksimum</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" placeholder="quota max" min=1>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Status</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                    <label>
                                        <input type="checkbox" class="js-switch" checked />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9">
                                <button type="button" class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>  -->
                <!-- /x_content -->
            <!-- </div>
        </div> -->
        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= isset($title) ? $title : "-" ?><small>periode ini (<?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?>)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/adds"); ?>">Tambah Pertemuan</a>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/addwexcel"); ?>">Tambah w/ Excel</a>
                    <?php if(isset($kelas_praktikum_now)) { if($kelas_praktikum_now > 0){?> <!-- KALO DATANYA ADA -->
                        <a class="btn btn-info btn-sm" href="<?php echo base_url("kelas_praktikum/updatesall"); ?>">Edit</a>
                    <?php }}?>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-periode-ini" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Actions</th> -->
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Lama</th>
                                        <th>Laboratorium</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kelas</th>
                                        <th>Terisi</th>
                                        <th>Pengajar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($kelas_praktikum_now)) : ?>
                                    <?php if(is_array($kelas_praktikum_now)) : ?>
                                        <?php foreach($kelas_praktikum_now as $key) : ?>
                                        <tr>
                                            <!-- <td> -->
                                                <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                                                <!-- <a href="<?php echo base_url("kelas_praktikum/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a> -->
                                                <!-- <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                            <!-- </td> -->
                                            <!-- <td><?= (isset($key['kode_kelas_praktikum'])) ? $key['kode_kelas_praktikum'] : '' ?></td> -->
                                            <!-- <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td> -->
                                            <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?></td>
                                            <td><?= (isset($key['jam'])) ? $key['jam'] : '' ?></td>
                                            <td><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?></td>
                                            <td><?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?></td>
                                            <td><?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                                            <td><?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?></td>
                                            <td><?= (isset($key['terisi'])) ? $key['terisi'] : '' ?></td>
                                            <td><p><?php if($key['nama_dosen1'] != NULL){ echo $key['nama_dosen1']; } elseif($key['nama_mahasiswa1'] != NULL) {echo $key['nama_mahasiswa1']; }?></p>
                                                <p><?php if($key['nama_dosen2'] != NULL){ echo $key['nama_dosen2']; } elseif($key['nama_mahasiswa2'] != NULL) {echo $key['nama_mahasiswa2']; }?></p>
                                                <p><?php if($key['nama_dosen3'] != NULL){ echo $key['nama_dosen3']; } elseif($key['nama_mahasiswa3'] != NULL) {echo $key['nama_mahasiswa3']; }?></p>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';?>
                                            </td>
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


        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= isset($title) ? $title : "-" ?><small>yang telah berlalu</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div>
                    PERIODE
                    <select class="select2_single" name ="ddsemester" id="ddsemester" tabindex="-1">
                        <option value="1" <?php if(isset($semester)) {if($semester == "Ganjil") echo "selected='selected'";}?>>Ganjil</option>
                        <option value="2" <?php if(isset($semester)) {if($semester == "Genap") echo "selected='selected'";}?>>Genap</option>
                    </select>
                    <select class="select2_single" name ="ddtahun_ajaran" id="ddtahun_ajaran" tabindex="-1">
                        <?php for($i = 0; $i < 5; $i++){ ?>
                            <option value="<?= date('Y', strtotime('-'.$i.' year')) ?>"><?= date('Y', strtotime('-'.$i.' year')) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-periode-lama" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Actions</th> -->
                                        <!-- <th>Kode Kelas</th> -->
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Lama</th>
                                        <th>Kode Lab</th>
                                        <th>Mata Kuliah</th>
                                        <th>Terisi</th>
                                        <th>Pengajar</th>
                                        <th>Semester/Tahun Ajaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($kelas_praktikum)) : ?>
                                    <?php if(is_array($kelas_praktikum)) : ?>
                                        <?php foreach($kelas_praktikum as $key) : ?>
                                        <tr>
                                            <!-- <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                                                <!-- <a href="<?php echo base_url("kelas_praktikum/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a> -->
                                                <!-- <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                            <!-- </td> -->
                                            <!-- <td><?= (isset($key['kode_kelas_praktikum'])) ? $key['kode_kelas_praktikum'] : '' ?></td> -->
                                            <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?></td>
                                            <td><?= (isset($key['jam'])) ? $key['jam'] : '' ?></td>
                                            <td><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?></td>
                                            <td><?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?></td>
                                            <td><?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?> (<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>)</td>
                                            <td><?= (isset($key['terisi'])) ? $key['terisi'] : '' ?></td>
                                            <td><p><?php if($key['nama_dosen1'] != NULL){ echo $key['nama_dosen1']; } elseif($key['nama_mahasiswa1'] != NULL) {echo $key['nama_mahasiswa1']; }?></p>
                                                <p><?php if($key['nama_dosen2'] != NULL){ echo $key['nama_dosen2']; } elseif($key['nama_mahasiswa2'] != NULL) {echo $key['nama_mahasiswa2']; }?></p>
                                                <p><?php if($key['nama_dosen3'] != NULL){ echo $key['nama_dosen3']; } elseif($key['nama_mahasiswa3'] != NULL) {echo $key['nama_mahasiswa3']; }?></p></td>
                                            <td><?php if(isset($key['semester'])){ if($key['semester'] == 1) echo "Ganjil"; else echo "Genap";}else echo ''; ?> <?= (isset($key['tahun_ajaran'])) ? $key['tahun_ajaran'] : '' ?></td>
                                            <td>
                                                <?php 
                                                    if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';?>
                                            </td>
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


<script>
    var baseurl = "<?php echo base_url(); ?>";

    $(document).ready(function() {
        $('#datatable-periode-ini').DataTable( {
            dom: "Blfrtip",
            buttons: [
                {
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });
        $('#datatable-periode-lama').DataTable( {
            dom: "Blfrtip",
            buttons: [
                {
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });


        $("#ddsemester").change(function(){
            alert("aa" + this.value);
            $.post(baseurl + "kelas_praktikum/getperiod", {
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                alert(result);
            });
        });

        $("#ddtahun_ajaran").change(function(){
            $.post(baseurl + "kelas_praktikum/getperiod", {
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                alert(result);
            });
        });
    });
</script>
