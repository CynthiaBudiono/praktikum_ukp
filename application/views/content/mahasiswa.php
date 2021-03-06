<style>
  .btn-action{
    font-size: 12px;
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

    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2><?= isset($title) ? $title : "-" ?></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li> -->
          </ul>
          <div class="clearfix"></div>
        </div>
        <div>
          <?php 
              $t = base_url("assets/template/mahasiswa_template.xlsx");
              $t = str_replace("https://","http://",$t);
          ?>
          <p>Download template, to get the template file <a href="<?php echo $t; ?>" download style="color:red; border: 1px solid black; padding: 1px;">Download Template</a></p>

          <!-- <p>Download template, to get the template file <a href="<?php echo base_url("assets/template/mahasiswa_template.xlsx"); ?>" download>Download Template</a></p> -->

          <form action="<?= (base_url('mahasiswa/readfile')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

            <input type="file" id="mahasiswa_file" name="mahasiswa_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
            <br><br>
            <button type="submit" class="btn btn-sm bg-green">Update All!</button>
            <!-- onclick=loadloader() -->
            <div class="loader" style="display: none;"></div>
          
          </form>
          <button type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-sm btn-danger">Delete All!</button>
        </div>
        
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <!-- <th>Actions</th> -->
                      <th>NRP</th>
                      <th>Nama</th>
                      <th>Angkatan</th>
                      <th>IPS</th>
                      <th>IPK</th>
                      <th>Email</th>
                      <th>Last login</th>
                      <th>Status</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($mahasiswa)) : ?>
                      <?php if(is_array($mahasiswa)) : ?>
                          <?php foreach($mahasiswa as $key) : ?>
                            <tr>
                              <!-- <td>
                              <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                              <!-- </td> -->
                              <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?></td>
                              <td><?= (isset($key['nama'])) ? $key['nama'] : '' ?></td>
                              <td><?= (isset($key['angkatan'])) ? $key['angkatan'] : '' ?></td>
                              <td><?= (isset($key['ips'])) ? $key['ips'] : '' ?></td>
                              <td><?= (isset($key['ipk'])) ? $key['ipk'] : '' ?></td>
                              <td><?= (isset($key['email'])) ? $key['email'] : '' ?></td>
                              <td><?= (isset($key['last_login'])) ? $key['last_login'] : '' ?></td>
                              <td><?php if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else '<span class="badge bg-danger">non active</span>'; ?></td>
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
<!-- /page content -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel2">Konfirmasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span>
              </button>
          </div>
          <div class="modal-body" id="modal_body">
            <h5>Apakah anda yakin mereset data mahasiswa ?</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="<?= (base_url('mahasiswa/deleteall')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                <button type="submit" class="btn btn-primary">Yakin</button>
              </form>
          </div>

      </div>
    </div>
</div>

<script>
  function loadloader(){
    $('#loader').css('display', 'block');
  }
</script>