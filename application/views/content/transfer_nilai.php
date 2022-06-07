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
          <!-- <p>Download template, to get the template file <a href="<?php echo base_url("assets/template/mahasiswa_template.xlsx"); ?>" download>Download Template</a></p>

          <form action="<?= (base_url('mahasiswa/readfile')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

          <input type="file" id="template" name="template" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
          <br><br>
          <button type="button" class="btn btn-sm bg-green">Update All!</button> -->

          </form>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Actions</th>
                      <th>Mahasiswa</th>
                      <th>Mata Kuliah</th>
                      <th>Nilai Akhir</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($mahasiswa)) : ?>
                      <?php if(is_array($mahasiswa)) : ?>
                          <?php foreach($mahasiswa as $key) : ?>
                            <tr>
                              <td>
                              <a href="<?= (base_url('mahasiswa_nilai/viewdetail')); ?>/<?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>/<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                              <a data-toggle="modal" data-target=".bs-example-modal-sm" class="btn bg-green btn-sm btn-action" style="color: white;"><i class="fa fa-exchange" style="color: white;" onclick=transfer("<?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>","<?= (isset($key['id_kelas_praktikum'])) ? $key['id_kelas_praktikum'] : '' ?>")></i> Transfer </a>
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                              </td>
                              <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?> ~ <?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> ~ <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                              <td><?= (isset($key['hasil_akhir'])) ? $key['hasil_akhir'] : '' ?></td>
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

<!-- Small modal -->
<!-- <button type="button" class="btn btn-primary" >Small modal</button> -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Transfer Nilai</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Pilih Kelas Transfer</h4>
        <select class="select2_single" name ="ddkelasprak" id="ddkelasprak" tabindex="-1">
            <?php if(isset($ddkelasprak)) : ?>
                <?php if(is_array($ddkelasprak)) : ?>
                    <?php foreach($ddkelasprak as $key) : ?>
                      <option value="<?= (isset($key['id'])) ? $key['id'] : '' ?>"> <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['tipe'])) ? $key['tipe'] : '' ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </select>
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-secondary btn-sm"> Close </a>
        <a href="<?= (base_url('mahasiswa_nilai/addtransfernilai')); ?>/<?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>/<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>" class="btn bg-green btn-sm btn-action"><i class="fa fa-exchange"></i> Transfer </a>
      </div>
    </div>
  </div>
</div>
<!-- /modals -->

<script>
  $('#ddkelasprak').select2();

  function transfer($nrp, $id_kelas_prak){
    alert("AAAAAAAAAAAAAAA");
    // alert($nrp);
    // alert($id_kelas_prak);


  }
</script>