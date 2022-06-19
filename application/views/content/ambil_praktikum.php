<style>
.bg-blue{
  background-color: #82b6d9;
  border: 1px solid black !important;
}
.bg-red{
  background-color: #ef8677;
  border: 1px solid black !important;
}

.bg-green{
    border: 1px solid black !important;
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
	background-color:#1d81be;
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
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
        </div>

        <div class="title_right" style="float:right;">

            <!-- <span class="badge bg-blue">Kuliah</span> -->
            <span class="badge bg-green">Bisa</span>
            <span class="badge bg-red">Berhalangan</span>

            <button type="button" onclick="generate()" class="btn btn-sm bg-green">Generate Mahasiswa</button>
            <button type="button" onclick="pemilihankelas()" class="btn btn-sm bg-green">Pemilihan Kelas</button>
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
        // alert(result);
        console.log(result);
        if(result == "sukses"){
            alert(result);
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
    // alert("func milih " + idmatkul + " " + idmhs + " " + idambilprak +" "+ idkelasprak + " " + pil);

    //update kuota dan terpilih

    // cek dulu sebelumnya dia sdh milih ato belum, kalo sdh milih kurangin kuota kelas sebelumnya, kalo blom milih yaudah langsung +
    var namakolomterpilih = "kolomterpilih" + arrData[idmatkul]['kode_mk'] + arrData[idmatkul]['data_mahasiswa'][idmhs]['NRP'] + idambilprak; 
    var idkolomterpilih = "idkelasprakterpilih" + arrData[idmatkul]['kode_mk'] + arrData[idmatkul]['data_mahasiswa'][idmhs]['NRP'] + idambilprak;
    // alert("namakolomterpilih : " + namakolomterpilih);

    var textkolomterisi = ($("#kolomterisi" + idkelasprak).text()).split('/');
    // alert("terisi : " + textkolomterisi[0] + " < " + textkolomterisi[1]);

    if(parseInt(textkolomterisi[0]) < parseInt(textkolomterisi[1])){ //kuota tak penuh

        var idkelasprakterpilih = $("#" + idkolomterpilih).val();

        // alert("update quota : " + idkelasprak + " == " + idkelasprakterpilih);
        var updatekolomquota;
        if(idkelasprakterpilih != "" || idkelasprakterpilih != null){ //sudah terpilih
            if(idkelasprak != idkelasprakterpilih){ //kalo pilihan yang di klik tidak sama dengan id terpilih
                updatekolomquota = ($("#kolomterisi" + idkelasprakterpilih).text()).split('/');
                $("#kolomterisi" + idkelasprakterpilih).html((parseInt(updatekolomquota[0])-1) + "/" + updatekolomquota[1]);
                var isi = parseInt(textkolomterisi[0])+1;
                $("#kolomterisi" + idkelasprak).html(isi + "/" + textkolomterisi[1]);
            }
            
        }
        else{ //kolom terpilih kosong
            updatekolomquota = ($("#kolomterisi" + idkelasprak).text()).split('/');
            $("#kolomterisi" + idkelasprakterpilih).html((parseInt(updatekolomquota[0])-1) + "/" + updatekolomquota[1]);
            var isi = parseInt(textkolomterisi[0])+1;
            $("#kolomterisi" + idkelasprak).html(isi + "/" + textkolomterisi[1]);
        }

        var belumada = 0;
        for(var i = 0; i< arrTerpilih.length; i++){
            // alert("arrterpilih : " + arrTerpilih[i]["id_ambil_prak"] + " == " + idambilprak);
            if(arrTerpilih[i]["id_ambil_prak"] == idambilprak){ //agar data tidak kembar
                var data = {
                    "id": idambilprak,
                    "terpilih": idkelasprak, //kelas yang terpilih
                    //"pil": pil, //sbg pil brp di ambilprak
                };
                arrTerpilih[i] = data;
                belumada = 1;
            }
        }
        
        if(arrTerpilih.length == 0 || belumada == 0){
            var data = {
                "id": idambilprak,
                "terpilih": idkelasprak, //kelas yang terpilih
                //"pil": pil, //sbg pil brp di ambilprak
            };
            arrTerpilih.push(data);
        }
        
        

        var namahari = ""; 
        for(var k = 0; k < arrData[idmatkul]['kelas_praktikum'].length; k++) {
            if(arrData[idmatkul]['kelas_praktikum'][k]['id'] == idkelasprak) {
                namahari = arrData[idmatkul]['kelas_praktikum'][k]['hari'] + ", " + arrData[idmatkul]['kelas_praktikum'][k]['jam'];
            }
        }
        for(var k = 0; k < arrData[idmatkul]['kelas_responsi'].length; k++) {
            if(arrData[idmatkul]['kelas_responsi'][k]['id'] == idkelasprak) {
                namahari = arrData[idmatkul]['kelas_responsi'][k]['hari'] + ", " + arrData[idmatkul]['kelas_responsi'][k]['jam'];
            }
        }

        $("#" + namakolomterpilih).html(namahari); 
        // alert("idkelasprak : "+ idkelasprak);
        $("#" + idkolomterpilih).val(idkelasprak);
    }
    else{ //kuota penuh
        alert("Kuota Penuh");
    }
}

function simpan(){
    // alert(arrTerpilih.length);
    var arrPraktikum = [];
    for(var j = 0; j < arrData.length; j++){
        for(var k = 0; k < arrData[j]['kelas_praktikum'].length; k++) {
            
            var data = {
                "id": arrData[j]['kelas_praktikum'][k]['id'],
                "terisi": (($('#kolomterisi'+arrData[j]['kelas_praktikum'][k]['id']).text()).split("/"))[0],
            };
            // alert("data kelas prak" + data);
            arrPraktikum.push(data);
        }
    }
    // console.log("arrpraktikum : " + arrPraktikum);

    $.post(baseurl + "ambil_praktikum/terpilih", {
        data_kelas_praktikum: arrPraktikum,
        data_ambil_praktikum: arrTerpilih
    },
    function(result) {
        // alert(result);
        if(result == "sukses"){
            view();
            alert(result);
        }
        else{
            alert("data tidak berhasil disimpan");
        }
    });
}

function pemilihankelas(){
    $.post(baseurl + "ambil_praktikum/pemilihankelas", {
        // data_kelas_praktikum: arrPraktikum,
        // data_ambil_praktikum: arrTerpilih
        kode_mk:$('#selectmk').val()
    },
    function(result) {
        alert(result);
        console.log(result);
        var url = "<?= base_url('ambil_praktikum/') ?>";
        // alert(url); 
        window.location = url;

        // if(result == "sukses"){
        //     view();
        //     alert(result);
        // }
        // else{
        //     alert("data tidak berhasil disimpan");
        // }
    });
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
                                kal = kal + "<td id='kolomterisi"+ arrData[i]['kelas_praktikum'][j]['id'] +"'>" + arrData[i]['kelas_praktikum'][j]['terisi'] + "/" + arrData[i]['kelas_praktikum'][j]['quota_max'] + "</td>"; 
                            kal = kal + "</tr>"; 
                        }
                    kal = kal + "</table></td>"; 
                kal = kal + "</tr>"; 

                kal = kal + "<tr>"; 
                kal = kal + "<td>&nbsp;</td>"; 
                    kal = kal + "<td>"; 
                    kal = kal + "<table class='table table-striped'>"; 
                        kal = kal + "<tr>"; 
                            // kal = kal + "<th>NRP</th>"; 
                            kal = kal + "<th>Mahasiswa</th>"; 
                            kal = kal + "<th>Angkatan</th>"; 
                            kal = kal + "<th>IPK</th>"; 
                            for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                kal = kal + "<th style='text-align: center'>" + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'] + "</th>"; 
                            }
                            kal = kal + "<th>Terpilih</th>"; 
                        kal = kal + "</tr>"; 
                        for(var j = 0; j < arrData[i]['data_mahasiswa'].length; j++) {
                            kal = kal + "<tr>"; 
                                kal = kal + "<td>"
                                    kal = kal + "<p style='margin-bottom:0px;'>" + arrData[i]['data_mahasiswa'][j]['NRP'] + "</p>";
                                    kal = kal + "<p style='margin-bottom:0px;'>" + arrData[i]['data_mahasiswa'][j]['nama_mahasiswa'] + "</p>";
                                kal = kal + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['data_mahasiswa'][j]['angkatan'] + "</td>"; 
                                kal = kal + "<td>" + arrData[i]['data_mahasiswa'][j]['ipk'] + "</td>"; 
                                for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                    if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil1'] || 
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil2'] ||
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil3'] ||
                                    arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil4'])
                                    { 
                                        var cekpil = "v";
                                        if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil1']){
                                            cekpil = "pil1";
                                        }
                                        else if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil2']){
                                            cekpil = "pil2";
                                        }
                                        else if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil3']){
                                            cekpil = "pil3";
                                        }
                                        else if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['pil4']){
                                            cekpil = "pil4";
                                        }
                                        if(arrData[i]['data_mahasiswa'][j]['jadwalnabrak'+(k+1)] == 'yes'){
                                            kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>" + cekpil + "</td>";
                                        }
                                        else{
                                            kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>" + cekpil + "</td>";  
                                        }
                                        // kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih('"+ arrData[i]['data_mahasiswa'][j]['NRP'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ l +"')>v</td>"; 
                                    }
                                    else 
                                    {
                                        console.log("LIHAT DATA "+ (arrData[i]['kelas_praktikum'][k]['id']) + " " + (arrData[i]['data_mahasiswa'][j]['NRP']) + ": " + arrData[i]['data_mahasiswa'][j]['nabrak_kelas_praktikum'+(arrData[i]['kelas_praktikum'][k]['id'])+(arrData[i]['data_mahasiswa'][j]['NRP'])]);
                                        if(arrData[i]['data_mahasiswa'][j]['nabrak_kelas_praktikum'+(arrData[i]['kelas_praktikum'][k]['id'])+(arrData[i]['data_mahasiswa'][j]['NRP'])] == 'yes'){
                                            kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>&nbsp;</td>";
                                        }
                                        else{
                                            kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa'][j]['id'] + "',"+ arrData[i]['kelas_praktikum'][k]['id'] +",'pil"+ (k+1) +"')>&nbsp;</td>";
                                        }
                                    }

                                }

                                kal = kal + "<td>";

                                var ada = 0;

                                for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                    if(arrData[i]['kelas_praktikum'][k]['id'] == arrData[i]['data_mahasiswa'][j]['terpilih']){
                                        kal = kal +"<label style='margin-bottom:0;' id='kolomterpilih" + arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa'][j]['NRP'] + arrData[i]['data_mahasiswa'][j]['id'] + "'>" + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'] + "</label>";
                                        //tambahin input type hidden nya buat di lempar
                                        kal = kal + "<input type='hidden' id='idkelasprakterpilih"+ arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa'][j]['NRP'] + arrData[i]['data_mahasiswa'][j]['id'] +"' value='"+ arrData[i]['kelas_praktikum'][k]['id']  +"'>";
                                        ada = 1;
                                    }
                                }
                                if(ada == 0){
                                    kal = kal +"<label style='margin-bottom:0;' id='kolomterpilih" + arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa'][j]['NRP'] + arrData[i]['data_mahasiswa'][j]['id'] +"'></label>";
                                    kal = kal + "<input type='hidden' id='idkelasprakterpilih"+ arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa'][j]['NRP'] + arrData[i]['data_mahasiswa'][j]['id'] +"' value=''>";
                                }
                                

                                // var ada = 0;
                                // for(var k = 0; k < arrData[i]['kelas_praktikum'].length; k++) {
                                //     if(arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil1'] && 
                                //     arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil2'] &&
                                //     arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil3'] &&
                                //     arrData[i]['kelas_praktikum'][k]['id'] != arrData[i]['data_mahasiswa'][j]['pil4'])
                                //     {
                                //         if(ada == 0){
                                //             kal = kal + "<select>";
                                //             kal = kal + '<option value="" disabled selected>-- Pilih Jadwal --</option>';
                                //             ada = 1;
                                //         } 
                                //         kal = kal + "<option value="+ arrData[i]['kelas_praktikum'][k]['id'] +">" + arrData[i]['kelas_praktikum'][k]['hari'] + ", " + arrData[i]['kelas_praktikum'][k]['jam'] + "</option>";

                                //         if(ada == 1 && k == arrData[i]['kelas_praktikum'].length-1){
                                //             kal = kal + "</select>";
                                //         }
                                //     }
                                // }
                                
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
                                    kal = kal + "<td id='kolomterisi"+ arrData[i]['kelas_responsi'][j]['id'] +"'>" + arrData[i]['kelas_responsi'][j]['terisi'] + "/" + arrData[i]['kelas_responsi'][j]['quota_max'] + "</td>"; 
                                kal = kal + "</tr>"; 
                            }
                        kal = kal + "</table></td>"; 
                    kal = kal + "</tr>"; 

                    kal = kal + "<tr>"; 
                    kal = kal + "<td>&nbsp;</td>"; 
                        kal = kal + "<td>"; 
                        kal = kal + "<table class='table table-striped'>"; 
                            kal = kal + "<tr>"; 
                                kal = kal + "<th>Mahasiswa</th>"; 
                                kal = kal + "<th>Angkatan</th>"; 
                                kal = kal + "<th>IPK</th>"; 
                                for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                    kal = kal + "<th style='text-align: center'>" + arrData[i]['kelas_responsi'][k]['hari'] + ", " + arrData[i]['kelas_responsi'][k]['jam'] + "</th>"; 
                                }
                                kal = kal + "<th>Terpilih</th>"; 
                            kal = kal + "</tr>"; 
                            for(var j = 0; j < arrData[i]['data_mahasiswa_responsi'].length; j++) {
                                kal = kal + "<tr>"; 
                                    kal = kal + "<td>"
                                        kal = kal + "<p style='margin-bottom:0px;'>" + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + "</p>";
                                        kal = kal + "<p style='margin-bottom:0px;'>" + arrData[i]['data_mahasiswa_responsi'][j]['nama_mahasiswa'] + "</p>";
                                    kal = kal + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['data_mahasiswa_responsi'][j]['angkatan'] + "</td>"; 
                                    kal = kal + "<td>" + arrData[i]['data_mahasiswa_responsi'][j]['ipk'] + "</td>"; 
                                    for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                        if(arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil1'] || 
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil2'] ||
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil3'] ||
                                        arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['pil4'])
                                        { 
                                            if(arrData[i]['data_mahasiswa_responsi'][j]['jadwalnabrak'+(k+1)] == 'yes'){
                                                kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +",'pil"+ (k+1) +"')>" + cekpil + "</td>";
                                            }
                                            else{
                                                kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +",'pil"+ (k+1) +"')>" + cekpil + "</td>";
                                            }
                                            //kal = kal + "<td class='bg-green' onclick=milih('"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +") style='text-align: center'>v</td>"; 
                                        
                                        }
                                        else 
                                        { 
                                            if(arrData[i]['data_mahasiswa_responsi'][j]['nabrak_kelas_responsi'+(arrData[i]['kelas_responsi'][k]['id'])+(arrData[i]['data_mahasiswa_responsi'][j]['NRP'])] == 'yes'){
                                                kal = kal + "<td class='bg-red' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +",'pil"+ (k+1) +"')>&nbsp;</td>";
                                            }
                                            else{
                                                kal = kal + "<td class='bg-green' style='text-align: center' onclick=milih(" + i + "," + j + ",'"+ arrData[i]['data_mahasiswa_responsi'][j]['id'] + "',"+ arrData[i]['kelas_responsi'][k]['id'] +",'pil"+ (k+1) +"')>&nbsp;</td>";
                                            }
                                        }
                                    }
                                kal = kal + "<td>";

                                    var ada = 0;

                                    for(var k = 0; k < arrData[i]['kelas_responsi'].length; k++) {
                                        if(arrData[i]['kelas_responsi'][k]['id'] == arrData[i]['data_mahasiswa_responsi'][j]['terpilih']){
                                            kal = kal +"<label style='margin-bottom:0;' id='kolomterpilih" + arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + arrData[i]['data_mahasiswa_responsi'][j]['id'] + "'>" + arrData[i]['kelas_responsi'][k]['hari'] + ", " + arrData[i]['kelas_responsi'][k]['jam'] + "</label>";
                                            //tambahin input type hidden nya buat di lempar
                                            kal = kal + "<input type='hidden' id='idkelasprakterpilih"+ arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + arrData[i]['data_mahasiswa_responsi'][j]['id'] +"' value='"+ arrData[i]['kelas_responsi'][k]['id']  +"'>";
                                            ada = 1;
                                        }
                                    }
                                    if(ada == 0){
                                        kal = kal +"<label style='margin-bottom:0;' id='kolomterpilih" + arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + arrData[i]['data_mahasiswa_responsi'][j]['id'] +"'></label>";
                                        kal = kal + "<input type='hidden' id='idkelasprakterpilih"+ arrData[i]['kode_mk'] + arrData[i]['data_mahasiswa_responsi'][j]['NRP'] + arrData[i]['data_mahasiswa_responsi'][j]['id'] +"' value=''>";
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
        // alert(result);
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