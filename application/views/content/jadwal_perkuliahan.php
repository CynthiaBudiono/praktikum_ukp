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
        <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
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
                      <th>Kode MK</th>
                      <th>Mata Kuliah</th>
                      <th>Kelas Paralel</th>
                      <th>Hari</th>
                      <th>Jam</th>
                      <th>Durasi</th>
                      <th>For semester</th>
                      <th>Semester</th>
                      <th>Tahun Ajaran</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($jadwal_perkuliahan)) : ?>
                      <?php if(is_array($jadwal_perkuliahan)) : ?>
                          <?php foreach($jadwal_perkuliahan as $key) : ?>
                            <tr>
                              <td>
                              <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a> -->
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                              </td>
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?></td>
                              <td><?= (isset($key['nama_matakuliah'])) ? $key['nama_matakuliah'] : '' ?></td>
                              <td><?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?></td>
                              <td><?= (isset($key['hari'])) ? $key['hari'] : '' ?></td>
                              <td><?= (isset($key['jam'])) ? $key['jam'] : '' ?></td>
                              <td><?= (isset($key['durasi'])) ? $key['durasi'] : '' ?></td>
                              <td><?= (isset($key['for_semester'])) ? $key['for_semester'] : '' ?></td>
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