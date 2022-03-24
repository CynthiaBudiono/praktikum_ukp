<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Calendar <small>Click to add/edit events</small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= isset($title) ? $title : "-" ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Actions</th>
                        <th>NRP/NIP</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>last login</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($pengajar)) : ?>
                        <?php if(is_array($pengajar)) : ?>
                            <?php foreach($pengajar as $key) : ?>
                              <tr>
                                <td>
                                  <a href="<?php echo base_url("jadwal_berhalangan/adds/"); echo base64_encode($key['id']);?>" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                                <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                </td>
                                <td><?= (isset($key['kode_pengajar'])) ? $key['kode_pengajar'] : '' ?></td>
                                <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                                <td>
                                  <?php 
                                    if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';
                                  ?>
                                </td>
                                <td><?= (isset($key['last_login'])) ? $key['last_login'] : '' ?></td>
                              </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div><!--  /x_content -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->