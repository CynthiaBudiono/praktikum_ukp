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
                <div>
                    <button type="button" class="btn btn-sm bg-green">Tambah</button>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Kode MK</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>kelas paralel</th>
                                        <th>Status praktikum</th>
                                        <th>Status transfer nilai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($subject)) : ?>
                                    <?php if(is_array($subject)) : ?>
                                        <?php foreach($subject as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a>
                                                <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                            </td>
                                            <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td>
                                            <td><?= (isset($key['NIPDosen'])) ? $key['NIPDosen'] : '' ?></td>
                                            <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                                            <td>
                                                <?php if(isset($key['status_praktikum'])) if($key['status_praktikum']==1) echo '<span class="badge bg-green">ada</span>'; else '<span class="badge bg-danger">tidak ada</span>'; ?>
                                            </td>
                                            <td>
                                                <?php if(isset($key['status_transfer_nilai'])) if($key['status_transfer_nilai']==1) echo '<span class="badge bg-green">boleh</span>'; else '<span class="badge bg-danger">tidak boleh</span>'; ?>
                                            </td>
                                            <td>
                                                <?php if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else '<span class="badge bg-danger">non active</span>'; ?>
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