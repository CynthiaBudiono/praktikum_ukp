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
                    <button type="button" class="btn btn-lg bg-green">Update All!</button>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Last login</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($dosen)) : ?>
                                    <?php if(is_array($dosen)) : ?>
                                        <?php foreach($dosen as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a>
                                            </td>
                                            <td><?= (isset($key['NIP'])) ? $key['NIP'] : '' ?></td>
                                            <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                                            <td><?= (isset($key['email'])) ? $key['email'] : '' ?></td>
                                            <td><?= (isset($key['last_login'])) ? $key['last_login'] : '' ?></td>
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