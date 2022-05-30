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
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div>
          <?php if($this->session->userdata('user_type') == 'admin'){ ?>
            <p>Download template, to get the template file <a href="<?php echo base_url("assets/template/PRS_template.xlsx"); ?>" download>Download Template</a></p>

            <form action="<?= (base_url('mahasiswa_matakuliah/readfile')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                <input type="file" id="mahasiswa_matakuliah_file" name="mahasiswa_matakuliah_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                <br><br>
                <button type="submit" class="btn btn-sm bg-green">Update All!</button>
            </form>
          <?php } ?>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <!-- <th>Actions</th> -->
                      <?php if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'kepala_lab'){ ?>
                      <th>Mahasiswa</th>
                      <?php } ?>
                      <th>Matakuliah</th>
                      <th>Kelas Paralel</th>
                      <th>Semester</th>
                      <th>Tahun Ajaran</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($mahasiswa_matakuliah)) : ?>
                      <?php if(is_array($mahasiswa_matakuliah)) : ?>
                          <?php foreach($mahasiswa_matakuliah as $key) : ?>
                            <tr>
                              <!-- <td> -->
                              <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                              <!-- </td> -->
                              <?php if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'kepala_lab'){ ?>
                              <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?> ~ <?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                              <?php } ?>
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> ~ <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                              <td><?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?></td>
                              <td><?= (isset($key['semester'])) ? $key['semester'] : '' ?></td>
                              <td><?= (isset($key['tahun_ajaran'])) ? $key['tahun_ajaran'] : '' ?></td>
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