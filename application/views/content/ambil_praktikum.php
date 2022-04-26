<style>
.bg-blue{
  background-color: #82b6d9;
  border: 1px solid black !important;
}
.bg-red{
  background-color: #ef8677;
  /* border: 1px solid black !important; */
}
.badge{
  padding: 8px;
  font-size: 12px;
}

.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#82b19b;
	color:#FFF;
	border-radius:50px;
    border-color: #999;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	/* margin-top:22px; */
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

        <div class="title_right" style="float:right;">

            <!-- <span class="badge bg-blue">Kuliah</span> -->
            <span class="badge bg-green">Bisa</span>
            <span class="badge bg-red">Berhalangan</span>

            <button type="button" onclick="generate()" class="btn bg-green">Generate Mahasiswa</button>
            <a class="btn btn-sm bg-green" href="<?php echo base_url("ambil_praktikum/adds"); ?>">Tambah</a>
        </div>
        <br>
        <br>
        <select class="form-control" id="selectmk" onchange="getbymk()">
            <option value="">All</option>
        </select>

        <button class="float" type="button" onclick="simpan()" class="btn bg-green"><i class="fa fa-save fa-2x my-float"></i></button>

        <!-- VIEW -->
        <div id="detail_kelas">

            <!-- <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= isset($title) ? $title : "-" ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div>
                        <a class="btn btn-sm bg-green" href="<?php echo base_url("ambil_praktikum/adds"); ?>">Tambah</a>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable_ambil_praktikum" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NRP</th>
                                            <th>Mata Kuliah</th>
                                            <th>pil1</th>
                                            <th>pil2</th>
                                            <th>pil3</th>
                                            <th>pil4</th>
                                            <th>tipe</th>
                                            <th>terpilih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_ambil_praktikum">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

var arrData     = []; 
var jumData     = 0; 
var arrTerpilih = [];

$(document).ready(function() {
    view();
});
function generate(){
    //Untuk generate mahasiswa yang semester ini seharusnya mengambil praktikum apa saja
    $.post(baseurl + "ambil_praktikum/generateadd", {},
    function(result) {
        alert(result);
        if(result == "sukses"){
            cetak();
        }
        else{
            alert("already uptodate");
        }
    });
}

function getbymk(){
    cetak($('#selectmk').val());
}

function milih(idmatkul, idmhs, idambilprak, idkelasprak, pil){
    // alert("func milih " + idambilprak +" "+ idkelasprak);

    //update kuota dan terpilih
    // var data = {
    //     "id_ambil_prak": idambilprak,
    //     "id_kelas_praktikum": idkelasprak,
    // };
    // arrTerpilih.push(data);

    var namahari = ""; 
    for(var k = 0; k < arrData[idmatkul]['kelas_praktikum'].length; k++) {
        if(arrData[idmatkul]['kelas_praktikum'][k]['id'] == idkelasprak) {
            namahari = arrData[idmatkul]['kelas_praktikum'][k]['hari'] + ", " + arrData[idmatkul]['kelas_praktikum'][k]['jam'];
        }
    }

    var namakolom = "kolomterpilih" + arrData[idmatkul]['kode_mk'] + arrData[idmatkul]['data_mahasiswa'][idmhs]['NRP']; 
    // alert(namakolom); 
    $("#" + namakolom).html(namahari); 
}

function simpan(){
    //update kuota dan terpilih
    // $.post(baseurl + "ambil_praktikum/terpilih", {},
    // function(result) {
    //     alert(result);
    //     if(result == "sukses"){
    //         cetak();
    //     }
    // });
}

function cetak(kodemk = null) {
    // alert("kodemk " + kodemk);
    var kal     = ""; 
        kal     = kal + "<table class='table table-striped'>"; 
        kal = kal + "<tr>"; 
            kal = kal + "<th>Kode MK</th>"; 
            kal = kal + "<th>Nama</th>"; 
        kal = kal + "</tr>"; 
        for(var i = 0; i < arrData.length; i++) {
            if(kodemk == arrData[i]['kode_mk'] || kodemk == null){

                kal = kal + "<tr>"; 
                    kal = kal + "<td>" + arrData[i]['kode_mk'] + "</td>"; 
                    kal = kal + "<td>" + arrData[i]['nama'] + "</td>"; 
                kal = kal + "</tr>"; 

                kal = kal + "<tr>"; 
                kal = kal + "<td>&nbsp;</td>"; 
                    kal = kal + "<td>"; 
                    kal = kal + "<table class='table table-striped'>"; 
                        kal = kal + "<tr>"; 
                            kal = kal + "<th>Kode Kelas</th>"; 
                            kal = kal + "<th>Pararel</th>"; 
                            kal = kal + "<th>Lab</th>"; 
                            kal = kal + "<th>Hari</th>"; 
                            kal = kal + "<th>Jam</th>"; 
                            kal = kal + "<th>Durasi</th>"; 
                            kal = kal + "<th>Terisi</th>"; 
                        kal = kal + "</tr>"; 
                        for(var j = 0; j < arrData[i]['kelas_praktikum'].length; j++) {
                            kal = kal + "<tr>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['kode_kelas_praktikum'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['kelas_paralel'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['kode_lab'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['hari'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['jam'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['durasi'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['kelas_praktikum'][j]['terisi'] + "/" + arrData[i]['kelas_praktikum'][j]['quota_max'] + "</td>"; 
                            kal = kal + "</tr>"; 
                        }
                    kal = kal + "</table></td>"; 
                kal = kal + "</tr>"; 

                kal = kal + "<tr>"; 
                kal = kal + "<td>&nbsp;</td>"; 
                    kal = kal + "<td>"; 
                    kal = kal + "<table class='table table-striped'>"; 
                        kal = kal + "<tr>"; 
                            kal = kal + "<th>NRP</th>"; 
                            kal = kal + "<th>Nama</th>"; 
                            kal = kal + "<th>Angkatan</th>"; 
                            for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                kal = kal + "<th style='text-align: center'>" + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'] + "</th>"; 
                            }
                            kal = kal + "<th>Terpilih</th>"; 
                        kal = kal + "</tr>"; 
                        for(var j = 0; j < arrData[i]['data_mahasiswa'].length; j++) {
                            kal = kal + "<tr>"; 
                                kal = kal + "<td>" + arrData[i]['data_mahasiswa'][j]['NRP'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['data_mahasiswa'][j]['nama_mahasiswa'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['data_mahasiswa'][j]['angkatan'] + "</td>"; 
                                for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                    if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil1'] || 
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil2'] ||
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil3'] ||
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil4'])
                                    { 
                                        if(arrData[i]['data_mahasiswa'][j]['jadwalnabrak'+(k+1)] == 'yes'){
                                            kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>v</td>";
                                        }
                                        else{
                                            kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>v</td>";  
                                        }
                                        // kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih('"+ arrData[i]['data_mahasiswa'][j]['NRP'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ l +"')>v</td>"; 
                                    }
                                    else 
                                    { kal = kal + "<td style='text-align: center' id='terpilih_praktikum"+ j +"'>&nbsp;</td>"; }


                                }

                                kal = kal + "<td id='kolomterpilih" + arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa'][j]['NRP'] + "'>";

                                for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                    if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['terpilih']){
                                        kal = kal + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'];
                                    }
                                }
                                

                                var ada = 0;
                                for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                    if(arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil1'] && 
                                    arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil2'] &&
                                    arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil3'] &&
                                    arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil4'])
                                    {
                                        if(ada == 0){
                                            kal = kal + "<select>";
                                            kal = kal + '<option value="" disabled selected>-- Pilih Jadwal --</option>';
                                            ada = 1;
                                        } 
                                        kal = kal + "<option value="+ arrData[i]['kelas_praktikum'][k]['id'] +">" + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'] + "</option>";

                                        if(ada == 1 && k == arrData[i]['kelas_praktikum'].length-1){
                                            kal = kal + "</select>";
                                        }
                                    }
                                }
                                
                                kal = kal + "</td>"; 
                            kal = kal + "</tr>"; 
                        }
                    kal = kal + "</table></td>"; 
                kal = kal + "</tr>"; 
                
                //responsi
                // alert("DATA MAHASISWA RESPONSI : " + arrData[i]['kelas_responsi']);
                if(arrData[i]['kelas_responsi'] != 0){

                    kal = kal + "<tr>"; 
                    kal = kal + "<td>&nbsp;</td>"; 
                        kal = kal + "<td>"; 
                        kal = kal + "<table class='table table-striped'>"; 
                            kal = kal + "<tr>"; 
                                kal = kal + "<th>Kode Kelas</th>"; 
                                kal = kal + "<th>Pararel</th>"; 
                                kal = kal + "<th>Lab</th>"; 
                                kal = kal + "<th>Hari</th>"; 
                                kal = kal + "<th>Jam</th>"; 
                                kal = kal + "<th>Durasi</th>"; 
                                kal = kal + "<th>Terisi</th>"; 
                            kal = kal + "</tr>"; 
                            for(var j = 0; j < arrData[i]['kelas_responsi'].length; j++) {
                                kal = kal + "<tr>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['kode_kelas_praktikum'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['kelas_paralel'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['kode_lab'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['hari'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['jam'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['durasi'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['kelas_responsi'][j]['terisi'] + "/" + arrData[i]['kelas_praktikum'][j]['quota_max'] + "</td>"; 
                                kal = kal + "</tr>"; 
                            }
                        kal = kal + "</table></td>"; 
                    kal = kal + "</tr>"; 

                    kal = kal + "<tr>"; 
                    kal = kal + "<td>&nbsp;</td>"; 
                        kal = kal + "<td>"; 
                        kal = kal + "<table class='table table-striped'>"; 
                            kal = kal + "<tr>"; 
                                kal = kal + "<th>NRP</th>"; 
                                kal = kal + "<th>Nama</th>"; 
                                kal = kal + "<th>Angkatan</th>"; 
                                for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                    kal = kal + "<th style='text-align: center'>" + arrData[i]['kelas_responsi'][k]['hari'] + ", " + arrData[i]['kelas_responsi'][k]['jam'] + "</th>"; 
                                }
                                kal = kal + "<th>Terpilih</th>"; 
                            kal = kal + "</tr>"; 
                            for(var j = 0; j < arrData[i]['data_mahasiswa_responsi'].length; j++) {
                                kal = kal + "<tr>"; 
                                    kal = kal + "<td>" + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['data_mahasiswa_responsi'][j]['nama_mahasiswa'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['data_mahasiswa_responsi'][j]['angkatan'] + "</td>"; 
                                    for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                        if(arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil1'] || 
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil2'] ||
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil3'] ||
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil4'])
                                        { 
                                            if(arrData[i]['data_mahasiswa'][j]['jadwalnabrak'+(k+1)] == 'yes'){
                                                kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih('"+ arrData[i]['data_mahasiswa'][j]['NRP'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +"')>v</td>";
                                            }
                                            else{
                                                kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih('"+ arrData[i]['data_mahasiswa'][j]['NRP'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +"')>v</td>"; 
                                            }
                                            //kal = kal + "<td class='bg-green' onclick=milih('"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +") style='text-align: center'>v</td>"; 
                                        
                                        }
                                        else 
                                        { kal = kal + "<td style='text-align: center'>&nbsp;</td>"; }
                                    }
                                    kal = kal + "<td>";

                                for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                    if(arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['terpilih']){
                                        kal = kal + arrData[i]['kelas_responsi'][k]['hari'] + ", " + arrData[i]['kelas_responsi'][k]['jam'];
                                    }
                                }
                                
                                var ada = 0;
                                for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                    if(arrData[i]['kelas_responsi'][k]['id'] != arrData[i]['data_mahasiswa_responsi'][j]['pil1'] && 
                                    arrData[i]['kelas_responsi'][k]['id'] != arrData[i]['data_mahasiswa_responsi'][j]['pil2'] &&
                                    arrData[i]['kelas_responsi'][k]['id'] != arrData[i]['data_mahasiswa_responsi'][j]['pil3'] &&
                                    arrData[i]['kelas_responsi'][k]['id'] != arrData[i]['data_mahasiswa_responsi'][j]['pil4'])
                                    {
                                        if(ada == 0){
                                            kal = kal + "<select>";
                                            kal = kal + '<option value="" disabled selected>-- Pilih Jadwal --</option>';
                                            ada = 1;
                                        } 
                                        kal = kal + "<option value="+ arrData[i]['kelas_responsi'][k]['id'] +">" + arrData[i]['kelas_responsi'][k]['hari'] + ", " + arrData[i]['kelas_responsi'][k]['jam'] + "</option>";

                                        if(ada == 1 && k == arrData[i]['kelas_responsi'].length-1){
                                            kal = kal + "</select>";
                                        }
                                    }
                                }
                                
                                kal = kal + "</td>"; 
                                kal = kal + "</tr>"; 
                            }
                        kal = kal + "</table></td>"; 
                    kal = kal + "</tr>"; 
                }
            }

        }
        kal     = kal + "</table>"; 
   
        // $("#detail_kelas").html(result);
        $("#detail_kelas").html(kal);    
    }

function view(){
    $.post(baseurl + "ambil_praktikum/getclassgroup", {

    },
    function(result) {
        alert(result);
        console.log(result);
        // $("#detail_kelas").html(result);
        var arr = JSON.parse(result);
        arrData  = arr; 

        // alert(arrData[0]['data_mahasiswa'][0]['jadwalnabrak1']);

        jumData  = arr.length; 
        cetak(); 

        var html = "";

        for(var i = 0; i < arrData.length; i++) {
            $('#selectmk').append('<option value="'+ arrData[i]['kode_mk'] +'">'+ arrData[i]['nama'] +'</option>');
        }

       
        // for(var i = 0; i < arr.length; i++){
        //     var kal = "";

        //     alert("LENGTH mahasiswa/kelas : " + arr[i].length);
        //     kal += '<div class="col-md-12 col-sm-12 ">';
        //         kal += '<div class="x_panel">';
        //             kal += '<div class="x_title">';
        //                 kal += '<h2>'+ arr[i][0]['tipe'] + ' ' + arr[i][0]['kode_mk'] + ' - ' + arr[i][0]['nama_subject'] + '</h2>';
        //                 kal += '<ul class="nav navbar-right panel_toolbox">';
        //                     // kal += '<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>';
        //                     // kal += '<li><a class="close-link"><i class="fa fa-close"></i></a></li>';
        //                     kal +='<li><a data-toggle="collapse" href="#datacollapse' + i + '" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-up"></i></a></li>';
        //                 kal += '</ul>';
        //                 kal += '<div class="clearfix"></div>';
        //             kal += '</div>';
        //             kal += '<div id="list_jadwal' + i + '"></div>';
        //             // kal += '<a class="btn btn-sm bg-green" href="<?php //echo base_url("ambil_praktikum/adds"); ?>">Tambah</a>

        //             //JADWAL PRAKTIKUM = jp
        //             $.post(baseurl + "kelas_praktikum/getjadwalforambilprak", {
        //                 kode_mk: arr[i][0]['kode_mk'],
        //                 tipe: arr[i][0]['tipe'],
        //             },
        //             function(result_jadwal) {
        //                 alert("JADWAAL" + result_jadwal);

        //                 if(result_jadwal != null){
        //                     var arr_jadwal = JSON.parse(result_jadwal);
        //                     var kal_jadwal = '';

        //                     kal_jadwal += '<div class="x_content">';

        //                         kal_jadwal += '<table class="table table-striped">';
        //                             kal_jadwal += '<thead>';
        //                             kal_jadwal += '<tr>';
        //                                 kal_jadwal += '<th>kelas paralel</th>';
        //                                 kal_jadwal += '<th>hari</th>';
        //                                 kal_jadwal += '<th>jam</th>';
        //                                 kal_jadwal += '<th>terisi</th>';
        //                             kal_jadwal += '</tr>';
        //                             kal_jadwal += '</thead>';
        //                             kal_jadwal += '<tbody>';

        //                             for(var jp = 0; jp < arr_jadwal.length; jp++){
        //                                 kal_jadwal += '<tr>';
        //                                 kal_jadwal += '<th>' + arr_jadwal[jp]['kelas_paralel']+ '</th>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['hari']+ '</td>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['jam']+ '</td>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['terisi']+ '</td>';
        //                                 kal_jadwal += '</tr>';
        //                             }
        //                             kal_jadwal += '</tbody>';
        //                         kal_jadwal += '</table>';
        //                     kal_jadwal += '</div>';
                            
        //                     $("#list_jadwal" + i).html(kal_jadwal);
        //                 }
                        
        //             });


        //             // kal += '';
        //             kal += '<div class="x_content collapse show" id="datacollapse' + i + '">';
        //                 kal += '<div class="row">';
        //                     kal += '<div class="col-sm-12">';
        //                         kal += '<div class="card-box table-responsive">';
        //                             kal += '<table id="datatable_ambil_praktikum' + i + '" class="table table-striped table-bordered" style="width:100%">';
        //                             kal += '<thead>';
        //                                 kal += '<tr>';
        //                                     kal += '<th>NRP</th>';
        //                                     kal += '<th>IPK</th>';
        //                                     kal += '<th>pil1</th>';
        //                                     kal += '<th>pil2</th>';
        //                                     kal += '<th>pil3</th>';
        //                                     kal += '<th>pil4</th>';
        //                                     kal += '<th>terpilih</th>';
        //                                 kal += '</tr>';
        //                             kal += '</thead>';
        //                             kal += '<tbody id="data_ambil_praktikum' + i + '">';

        //                                 for(var j = 0; j < arr[i].length; j++){

        //                                     kal += '<tr>';
        //                                         kal += '<td>'+ arr[i][j]['NRP'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['ipk'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil1'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil2'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil3'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil4'] +'</td>';
        //                                         kal += '<td>';
        //                                             kal += '<div>' + arr[i][j]['terpilih'];
        //                                             kal +='<label style="float:right;">';
        //                                                 kal +='<select class="select2_single" name ="ddtahun_ajaran" id="ddtahun_ajaran" tabindex="-1">';
        //                                                     kal += '<option value=""></option></select>';
        //                                                 kal += '</label>';
        //                                             kal += '</div>';
        //                                         kal += '</td>';
        //                                     kal += '</tr>';
        //                                 }
                                        
        //                             kal += '</tbody>';
        //                             kal += '</table>';
        //                         kal += '</div>';
        //                     kal += '</div>';
        //                 kal += '</div>';
        //             kal += '</div>';
        //         kal += '</div>';
        //     kal += '</div>';

        //     $("#data_ambil_praktikum"+ i).html(kal);
        //     $("#datatable_ambil_praktikum" + i).DataTable({
        //         dom: "Blfrtip",
        //         buttons: [
        //             {
        //                 extend: "copy",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "csv",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "excel",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "pdfHtml5",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "print",
        //                 className: "btn-sm"
        //             },
        //         ],
        //         responsive: true
        //     });
        //     html += kal;
        // }
        // $("#detail_kelas").html(html);
    });
}


</script>