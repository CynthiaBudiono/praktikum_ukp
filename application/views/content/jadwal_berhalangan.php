<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
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
                        <th>Role</th>
                        <th>Status</th>
                        <th>last login</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php if(isset($pengajar)) : ?>
                        <?php if(is_array($pengajar)) : ?>
                            <?php for($i = 0; $i < count($pengajar); $i++) { ?>
                              <?php //var_dump($pengajar[1][0]['kode_pengajar']); exit;?>
                              <tr>
                                <td>
                                  <a href="<?php echo base_url("jadwal_berhalangan/adds/"); echo base64_encode($pengajar[$i]['kode_pengajar']).'/'.base64_encode($pengajar[$i]['role']);?>" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View  </a>
                                <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                </td>
                                <td><?= (isset($pengajar[$i]['kode_pengajar'])) ? $pengajar[$i]['kode_pengajar'] : '' ?></td>
                                <td><?= (isset($pengajar[$i]['nama'])) ? $pengajar[$i]['nama'] : '' ?></td>
                                <td><?= (isset($pengajar[$i]['role'])) ? $pengajar[$i]['role'] : '' ?></td>
                                <td>
                                  <?php 
                                    if(isset($pengajar[$i]['status'])) if($pengajar[$i]['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';
                                  ?>
                                </td>
                                <td><?= (isset($pengajar[$i]['last_login'])) ? $pengajar[$i]['last_login'] : '' ?></td>
                              </tr>
                        <?php } endif; ?>
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

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

$(document).ready(function() {

});

function adds($kode, $role){
  // alert($kode + " " + $role);
  $.post(baseurl + "jadwal_berhalangan/adds", {
    kode_pengajar: $kode,
    role: $role
  }, //DOSEN & Asisten Dosen
  function(result) {
    alert(result);
  });
}

</script>