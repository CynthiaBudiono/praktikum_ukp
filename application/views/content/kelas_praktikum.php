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
                    <h2><?= isset($title) ? $title : "-" ?><small>periode ini</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/adds"); ?>">Tambah</a>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/addwexcel"); ?>">Tambah w/ Excel</a>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-periode-ini" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Kode Kelas</th>
                                        <th>Kode MK</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kode Lab</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Durasi</th>
                                        <th>Terisi</th>
                                        <th>NIP1</th>
                                        <th>NIP2</th>
                                        <th>NIP3</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($kelas_praktikum_now)) : ?>
                                    <?php if(is_array($kelas_praktikum_now)) : ?>
                                        <?php foreach($kelas_praktikum_now as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                                                <a href="<?php echo base_url("kelas_praktikum/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                            <td><?= (isset($key['kode_kelas_praktikum'])) ? $key['kode_kelas_praktikum'] : '' ?></td>
                                            <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td>
                                            <td><?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                                            <td><?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?></td>
                                            <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?></td>
                                            <td><?= (isset($key['jam'])) ? $key['jam'] : '' ?></td>
                                            <td><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?></td>
                                            <td><?= (isset($key['terisi'])) ? $key['terisi'] : '' ?></td>
                                            <td><?= (isset($key['NIP1'])) ? $key['NIP1'] : '' ?></td>
                                            <td><?= (isset($key['NIP2'])) ? $key['NIP2'] : '' ?></td>
                                            <td><?= (isset($key['NIP3'])) ? $key['NIP3'] : '' ?></td>
                                            <td><?= (isset($key['semester'])) ? $key['semester'] : '' ?></td>
                                            <td><?= (isset($key['tahun_ajaran'])) ? $key['tahun_ajaran'] : '' ?></td>
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
                    <!-- <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/adds"); ?>">Tambah</a> -->
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-periode-lama" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Kode Kelas</th>
                                        <th>Kode MK</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kode Lab</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Durasi</th>
                                        <th>Terisi</th>
                                        <th>NIP1</th>
                                        <th>NIP2</th>
                                        <th>NIP3</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($kelas_praktikum)) : ?>
                                    <?php if(is_array($kelas_praktikum)) : ?>
                                        <?php foreach($kelas_praktikum as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                                                <!-- <a href="<?php echo base_url("kelas_praktikum/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a> -->
                                                <!-- <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                            </td>
                                            <td><?= (isset($key['kode_kelas_praktikum'])) ? $key['kode_kelas_praktikum'] : '' ?></td>
                                            <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td>
                                            <td><?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                                            <td><?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?></td>
                                            <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?></td>
                                            <td><?= (isset($key['jam'])) ? $key['jam'] : '' ?></td>
                                            <td><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?></td>
                                            <td><?= (isset($key['terisi'])) ? $key['terisi'] : '' ?></td>
                                            <td><?= (isset($key['NIP1'])) ? $key['NIP1'] : '' ?></td>
                                            <td><?= (isset($key['NIP2'])) ? $key['NIP2'] : '' ?></td>
                                            <td><?= (isset($key['NIP3'])) ? $key['NIP3'] : '' ?></td>
                                            <td><?= (isset($key['semester'])) ? $key['semester'] : '' ?></td>
                                            <td><?= (isset($key['tahun_ajaran'])) ? $key['tahun_ajaran'] : '' ?></td>
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
    });
</script>
