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
                      
                      <th>Mahasiswa</th>
                      <th>Mata Kuliah</th>
                      <th>Nilai Akhir</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($mahasiswa)) : ?>
                      <?php if(is_array($mahasiswa)) : ?>
                          <?php foreach($mahasiswa as $key) : ?>
                            <tr>
                              
                              <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?> ~ <?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> ~ <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                              <td><?= (isset($key['hasil_akhir'])) ? $key['hasil_akhir'] : '' ?></td>
                              <td>
                              <a href="<?= (base_url('mahasiswa_nilai/viewdetail')); ?>/<?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>/<?= (isset($key['id_kelas_praktikum'])) ? base64_encode($key['id_kelas_praktikum']) : '' ?>" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                              <a onclick=transfer("<?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>","<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>","<?= (isset($key['id_kelas_praktikum'])) ? $key['id_kelas_praktikum'] : '' ?>") data-toggle="modal" data-target=".bs-example-modal-sm" class="btn bg-green btn-sm btn-action" style="color: white;"><i class="fa fa-exchange" style="color: white;"></i> Transfer </a>
                              <!-- <a href="#" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
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
        <!-- <input type="text" class="form-control" name="nrp" id="nrp"> -->
        <input type="hidden" class="form-control" name="id_kelas_prak" id="id_kelas_prak">
        <input type="hidden" class="form-control" name="id_kelas_transfer" id="id_kelas_transfer">
        <h5 id="nrp"></h5>
        Mahasiswa mengambil mata kuliah ini di kelas <b id="kelas_prak"></b> 
        apakah anda yakin mentransfer data nilai sebelumnya?
        <br>
        <span id="error_msg" style="color: red;"></span>
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-secondary btn-sm"> Close </a>
        <button onclick=addtransfer() class="btn bg-green btn-sm"><i class="fa fa-exchange"></i> Transfer </button>
      </div>
    </div>
  </div>
</div>
<!-- /modals -->

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";

  function transfer($nrp, $kode_mk, $id_kelas_prak){
    $("#nrp").html($nrp);
    $("#kode_mk").val($kode_mk);
    $("#id_kelas_prak").val($id_kelas_prak);

    $.post(baseurl + "ambil_praktikum/cekambilprak", {
      nrp : $("#nrp").html(),
      kode_mk : $kode_mk
    },
    function(result) {
      
      if(result != 0){
        var arr = JSON.parse(result);
        var html = arr[0]['hari'] + " " + arr[0]['jam'] + " (" + arr[0]['durasi'] + " menit)";
        $("#kelas_prak").html(html);

        $("#id_kelas_transfer").val(arr[0]['terpilih']);
      }
      else{
        alert(result);
      }
    });
  }

  function addtransfer(){
    // alert($("#nrp").html());
    // alert($("#id_kelas_prak").val());
    // alert($('#id_kelas_transfer').val());

    // if($("#idkelas").val() == $('#ddkelasprak').val()){
    //   $("#error_msg").html("kelas yang dipilih sama dengan kelas yang saat ini, silahkan pilih kelas lain");
    // }
    // else{
       $.post(baseurl + "mahasiswa_nilai/addtransfernilai", {
        nrp : $("#nrp").html(),
        id_kelas_praktikum : $("#id_kelas_prak").val(),
        mahasiswa_nilai_id_transfer : $('#id_kelas_transfer').val()
      },
      function(result) {
        if(result == "sukses"){
          var url = "<?= base_url('laporan/transfer_nilai') ?>";
          window.location = url;
        }
        else{
          alert(result);
        }
      });
    // }
   
  }
  
</script>