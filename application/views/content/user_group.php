<!-- page content -->
<!-- <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
            </div>
        </div>

        <div class="clearfix"></div> -->

        <!-- VIEW -->
        <!-- <div class="col-md-12 col-sm-12 ">
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("user_group/adds"); ?>">Tambah</a>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>id</th>
                                        <th>nama</th>
                                        <th>status</th>
                                        <th>created</th>
                                        <th>updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($user_group)) : ?>
                                    <?php if(is_array($user_group)) : ?>
                                        <?php foreach($user_group as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url("user_group/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                            <td><?= (isset($key['id'])) ? $key['id'] : '' ?></td>
                                            <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                                            <td>
                                                <?php 
                                                    if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';?>
                                            </td>
                                            <td><?= (isset($key['created'])) ? $key['created'] : '' ?></td>
                                            <td><?= (isset($key['updated'])) ? $key['updated'] : '' ?></td>
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
</div> -->