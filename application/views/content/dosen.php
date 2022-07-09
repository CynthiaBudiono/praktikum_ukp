<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= isset($title) ? $title : "-" ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <?php 
                        $t = base_url("assets/template/dosen_template.xlsx");
                        $t = str_replace("https://","http://",$t);
                    ?>
                    <p>Download template, to get the template file <a href="<?php echo $t; ?>" download style="color:red; border: 1px solid black; padding: 1px;">Download Template</a></p>

                    <!-- <p>Download template, to get the template file <a href="<?php echo base_url("assets/template/dosen_template.xlsx"); ?>" download>Download Template</a></p> -->

                    <form action="<?= (base_url('dosen/readfile')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                    <input type="file" id="dosen_file" name="dosen_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                    <br><br>
                    <button type="submit" class="btn btn-sm bg-green">Update All!</button>

                    </form>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Actions</th> -->
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
                                            <!-- <td>
                                                <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a>
                                            </td> -->
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