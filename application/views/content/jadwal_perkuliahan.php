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
          <?php 
              $t = base_url("assets/template/jadwal_kuliah_template.xlsx");
              $t = str_replace("https://","http://",$t);
          ?>
          <p>Download template, to get the template file <a href="<?php echo $t; ?>" download>Download Template</a></p>

          <!-- <p>Download template, to get the template file <a href="<?php echo base_url("assets/template/jadwal_kuliah_template.xlsx"); ?>" download>Download Template</a></p> -->

          <form action="<?= (base_url('jadwal_perkuliahan/readfile')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="file" id="jadwal_perkuliahan_file" name="jadwal_perkuliahan_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
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
                      <th>Kode MK</th>
                      <th>Mata Kuliah</th>
                      <th>KLS</th>
                      <th>Waktu</th>
                      <th>Pengajar</th>
                      <th>SMS</th>
                      <th>Ruang</th>
                      <th>Periode</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($jadwal_perkuliahan)) : ?>
                      <?php if(is_array($jadwal_perkuliahan)) : ?>
                          <?php foreach($jadwal_perkuliahan as $key) : ?>
                            <tr>
                              <!-- <td> -->
                              <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                              <!-- </td> -->
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td>
                              <td><?= (isset($key['nama_matakuliah'])) ? $key['nama_matakuliah'] : '' ?></td>
                              <td><?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?></td>
                              <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?>, <?= (isset($key['jam'])) ? $key['jam'] : '' ?>
                                  <p style="font-size:12px; font-weight: bold;"><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?> menit</p>
                              </td>
                              <td>
                                <p style="margin-bottom: 0px;"><?= (isset($key['NIP1'])) ? $key['NIP1'] : '' ?> ~ <?= (isset($key['nama_dosen1'])) ? $key['nama_dosen1'] : '' ?></p>
                                <p style="margin-bottom: 0px;"><?= (isset($key['NIP2'])) ? $key['NIP2'] : '' ?> ~ <?= (isset($key['nama_dosen2'])) ? $key['nama_dosen2'] : '' ?></p>
                              </td>
                              <td><?= (isset($key['for_semester'])) ? $key['for_semester'] : '' ?></td>
                              <td><?= (isset($key['ruang'])) ? $key['ruang'] : '' ?></td>
                              <td><?php if(isset($key['semester'])){ if($key['semester'] == 1) echo "Ganjil"; else echo "Genap";} else echo ''; ?> <?= (isset($key['tahun_ajaran'])) ? $key['tahun_ajaran'] : '' ?></td>
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