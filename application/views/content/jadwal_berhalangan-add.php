<style>
  table, th, td, .bg-green {
    border: 1px solid black !important;
  }
.bg-blue{
  background-color: #82b6d9;
  border: 1px solid black !important;
}
.bg-red{
  background-color: #ef8677;
  border: 1px solid black !important;
}
.badge{
  padding: 8px;
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

        <div class="title_right" style="float:right; text-align:right; margin-top:8px;">
            <span class="badge bg-blue">Kuliah</span>
            <span class="badge bg-green">Bisa</span>
            <span class="badge bg-red">Berhalangan</span>
        </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Jadwal <small><?= isset($getinfo[0]['nama']) ? $getinfo[0]['nama'] : "-" ?></small></h2>
            <input type="hidden" id="kode_pengajar" name="kode_pengajar" value="<?= isset($primary) ? $primary : '-' ?>">
            <input type="hidden" id="role" name="role" value="<?= isset($role) ? $role : '-' ?>">
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Jam</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                      </tr>
                    </thead>

                    <tbody id="table_week"></tbody>
                  
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<!-- modal -->
<!-- <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Text in a modal</h4>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div> -->
<!-- /modals -->

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";
var usertype = "<?php echo $this->session->userdata('user_type'); ?>";
var hours = ['7:30:00','8:30:00','9:30:00','10:30:00','11:30:00','12:30:00','13:30:00','14:30:00','15:30:00','16:30:00','17:30:00','18:30:00','19:30:00'];
var hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
var papan = [
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
              ['?', '?', '?', '?', '?', '?'],
            ];

$(document).ready(function() {
  var kode_pengajar = $('#kode_pengajar').val();
  var usertype = "<?php echo $this->session->userdata('user_type'); ?>";
  
  var role = $('#role').val();
  // alert(kode_pengajar + " " + role);
  if(role == "Dosen"){
    $.post(baseurl + "jadwal_berhalangan/getbyNIP", {
      NIP: kode_pengajar,
    },
    function(result) {
      // alert(result);
      if (result != 0){
        var arr = JSON.parse(result);
      
        for(var i = 0; i < hours.length; i++){
          // console.log("aaaaaaaa " + i + " " + hours[i]);
          for(var j = 0; j < hari.length; j++){
            // console.log("bbbbbbb " + j)
            for(var k = 0; k < arr.length; k++){
              // console.log(arr.length + " ccccccc" + k + " " + arr[k]['jam'] +" == "+ hours[i]);
              if(hari[j] == "Senin" && arr[k]['hari'] == "Senin" && arr[k]['jam'] == hours[i]){
                // papan[i] = [];
                  // console.log("eeeeeeeeee ");
                  // console.log("DURASIII " + parseInt(arr[k]['durasi'])/60);
                  papan[i][j] = "red";

                  var durasi = arr[k]['durasi']/60;
                  for(var l = 1; l < durasi; l++){
                    console.log("MASUK" + durasi);
                    papan[i+l][j] = "red";
                  }
              } 
              if(hari[j] == "Selasa" && arr[k]['hari'] == "Selasa" && arr[k]['jam'] == hours[i]){
                // papan[i] = [];
                  console.log("eeeeeeeeee ");
                  // console.log("DURASIII " + parseInt(arr[k]['durasi'])/60);
                  papan[i][j] = "red";

                  var durasi = arr[k]['durasi']/60;
                  for(var l = 1; l < durasi; l++){
                    console.log("MASUK" + durasi);
                    papan[i+l][j] = "red";
                  }
              }
              if(hari[j] == "Rabu" && arr[k]['hari'] == "Rabu" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "red";
                // for(var l = 1; l < (arr[k]['durasi']/60); l++){ //note *SOALNYA PASTI /JAM
                //   papan[i+l][j] = "red";
                // }
              }
              if(hari[j] == "Kamis" && arr[k]['hari'] == "Kamis" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "red";
              }
              if(hari[j] == "Jumat" && arr[k]['hari'] == "Jumat" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "red";
              }
              if(hari[j] == "Sabtu" && arr[k]['hari'] == "Sabtu" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "red";
              } 
            }
          }
        }  
      }
      
      console.log("PAPAN" + papan);
      showtable();
    });
    $.post(baseurl + "dosen/getjadwalbyNIP", {
      NIP: kode_pengajar,
    },
    function(result) {
      // console.log("XXX" + result);
      if(result != 0){
        
        var arr = JSON.parse(result);
      
        for(var i = 0; i < hours.length; i++){
          // console.log("aaaaaaaa " + i + " " + hours[i]);
          for(var j = 0; j < hari.length; j++){
            // console.log("bbbbbbb " + j)
            for(var k = 0; k < arr.length; k++){
              // console.log(arr.length + " ccccccc" + k + " " + arr[k]['jam'] +" == "+ hours[i]);
              if(hari[j] == "Senin" && arr[k]['hari'] == "Senin" && arr[k]['jam'] == hours[i]){
                // papan[i] = [];
                  // console.log("eeeeeeeeee ");
                  // console.log("DURASIII " + parseInt(arr[k]['durasi'])/60);
                papan[i][j] = "blue";

                  // var durasi = arr[k]['durasi']/60;
                  // for(var l = 1; l < durasi; l++){
                  //   console.log("MASUK");
                  //   papan[i+l][j] = "blue";
                  // }
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
              if(hari[j] == "Selasa" && arr[k]['hari'] == "Selasa" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "blue";
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
              if(hari[j] == "Rabu" && arr[k]['hari'] == "Rabu" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "blue";
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
              if(hari[j] == "Kamis" && arr[k]['hari'] == "Kamis" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "blue";
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
              if(hari[j] == "Jumat" && arr[k]['hari'] == "Jumat" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "blue";
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
              if(hari[j] == "Sabtu" && arr[k]['hari'] == "Sabtu" && arr[k]['jam'] == hours[i]){
                papan[i][j] = "blue";
                for(var l = 1; l < (arr[k]['durasi']/60); l++){
                  papan[i+l][j] = "blue";
                }
              }
            }
          }
        }  
      }
      
      console.log("PAPAN" + papan);
      showtable();
    });
  }
  else if(role == "Mahasiswa"){

  }
  
  
});

function showtable(){
  // alert(papan.length);
  var kal='';
  for(var i = 0; i < papan.length; i++){ //JAM
    kal +='<tr>';
        kal +='<td>' + hours[i] + '</td>';
    for(var j = 0; j < hari.length; j++){ //HARI
        console.log(papan[i][j]);
        if(papan[i][j] == 'blue'){
          console.log("masuk blue");
          kal +='<td class="bg-blue"></td>';
        }
        else if(papan[i][j] == 'red'){
          // <button type="button" class="btn btn-primary" >Small modal</button>
          // kal +='<td data-toggle="modal" data-target=".bs-example-modal-sm" onclick="berhalangan_delete('+ i +','+ j +');" class="bg-red"></i></td>';
          kal +='<td onclick="berhalangan_delete('+ i +','+ j +');" class="bg-red"></i></td>';
        }
        else if(papan[i][j] == '?'){
          kal +='<td onclick="berhalangan_add('+ i +','+ j +');" class="bg-green"></i></td>';
        }
        
    }
    kal +='</tr>';
  }
  $("#table_week").html(kal);
}

function berhalangan_add($indexjam, $indexhari){
  // alert(hours[$indexjam] + " " + hari[$indexhari]);
  if(usertype != 'mahasiswa'){
    $.post(baseurl + "jadwal_berhalangan/add", {
      pengajar_id: $('#kode_pengajar').val(),
      role: $('#role').val(),
      hari: hari[$indexhari],
      jam: hours[$indexjam],
      //keterangan:
    },
    function(result) {
      // alert(result);
      if (result == "sukses"){
        papan[$indexjam][$indexhari] = "red";
        showtable();
      }
    });
  }
  
}

function berhalangan_delete($indexjam, $indexhari){

  if(usertype != 'mahasiswa'){
    $.post(baseurl + "jadwal_berhalangan/delete", {
      pengajar_id: $('#kode_pengajar').val(),
      role: $('#role').val(),
      hari: hari[$indexhari],
      jam: hours[$indexjam],
      //keterangan:
    },
    function(result) {
      // alert(result);
      if (result == "sukses"){
        papan[$indexjam][$indexhari] = "?"; //GREEN
        showtable();
      }
    });
  }
}
</script>