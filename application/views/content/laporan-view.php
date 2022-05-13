<style>
    p{
        margin-bottom: 0px;
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

        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?= isset($title) ? $title : "-" ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="margin: 0px 10px; padding-top: 4px;"> <!-- UNTUK LAPORAN DETAIL KELAS -->
                            <select class="select2_single" name ="ddkelas_prak" id="ddkelas_prak" tabindex="-1">
                                <option value="all"> ALL </option>
                                <?php if(isset($ddkelasprak)) : ?>
                                    <?php if(is_array($ddkelasprak)) : ?>
                                        <?php foreach($ddkelasprak as $key) : ?>
                                            <option value="<?= (isset($key['id'])) ? $key['id'] : '' ?>"> <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['tipe'])) ? $key['tipe'] : '' ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                        </li>

                        <li style="margin: 0px 10px; padding-top: 4px;">
                            <select class="select2_single" name ="ddsemester" id="ddsemester" tabindex="-1">
                                <option value="1" <?php if(isset($semester)) {if($semester == "Ganjil") echo "selected='selected'";}?>>Ganjil</option>
                                <option value="2" <?php if(isset($semester)) {if($semester == "Genap") echo "selected='selected'";}?>>Genap</option>
                            </select>
                        </li>
                        <li style="margin: 0px 10px; padding-top: 4px;">
                            <select class="select2_single" name ="ddtahun_ajaran" id="ddtahun_ajaran" tabindex="-1">
                                <?php for($i = 0; $i < 5; $i++){ ?>
                                    <option value="<?= date('Y', strtotime('-'.$i.' year')) ?>"><?= date('Y', strtotime('-'.$i.' year')) ?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                                <!-- LAPORAN KELAS -->
                                <?php if($function == 'kelas'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_kelas" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Lama</th>
                                                <th>Kode Lab</th>
                                                <th>Mata Kuliah</th>
                                                <th>Terisi</th>
                                                <th>Pengajar</th>
                                                <th>Semester/Tahun Ajaran</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_kelas"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN KELAS -->

                                <!-- /LAPORAN DETAIL KELAS -->
                                <?php if($function == 'detail_kelas'){?>
                                    <div id="laporan_detail_kelas"></div>
                                <?php } ?> <!-- /LAPORAN DETAIL KELAS -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var baseurl = "<?php echo base_url(); ?>";
    var jenislaporan = "<?= $function ?>";
    // var data_informasi = [];
    var data_laporan = [];
    var baru = 0;
    $(document).ready(function() {
        if(jenislaporan == "kelas"){
            viewkelas();

            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "kelas_praktikum/getperiod", {
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewkelas();
                    
                });
            });

            $("#ddtahun_ajaran").change(function(){
                $.post(baseurl + "kelas_praktikum/getperiod", {
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewkelas();
                });
            });

        }
        else if(jenislaporan == "detail_kelas"){
            $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                id_kelas_praktikum: 0,
            },
            function(result) {
                alert("RESULT : " + result);
                var arr = JSON.parse(result);
                alert(arr.length);
                data_laporan = arr;

                // alert(JSON.stringify(data_laporan));
                viewdetailkelas();
            });
        }
        

        if(jenislaporan == "detail_kelas"){
            $('#ddkelas_prak').css('display', 'block');
            $("#ddkelas_prak").change(function(){
                $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                },
                function(result) {
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewdetailkelas();
                });
            });
        }
        else{
            $('#ddkelas_prak').css('display', 'none');
        }

    });

    // function detail_mahasiswa($id){

    // }
    function pindah(id) {
        // alert(id); 
        var url = "<?= base_url('kelas_praktikum/getdetailmahasiswa/') ?>";
        // alert(url); 
        window.location = url + id;
    }

    function viewkelas(){
        var kal = '';

        for(var i = 0; i < data_laporan.length; i++){
            kal += '<tr>';
                kal += '<td><a onclick=pindah(' + data_laporan[i]['id'] + ') class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a></td>';
                kal += '<td>' + data_laporan[i]['hari'] + '</td>';
                kal += '<td>' + data_laporan[i]['jam'] + '</td>';
                kal += '<td>' + data_laporan[i]['durasi'] + '</td>';
                kal += '<td>' + data_laporan[i]['kode_lab'] + '</td>';
                kal += '<td>' + data_laporan[i]['nama_subject'] + ' ('+ data_laporan[i]['kode_mk'] + ')' + '</td>';
                kal += '<td><?= (isset($key['terisi'])) ? $key['terisi'] : '' ?></td>';
                kal += '<td><p>'; //PENGAJAR DOSEN ATAU ASISTEN
                    if(data_laporan[i]['nama_dosen1'] != null){ 
                        kal += data_laporan[i]['nama_dosen1']; 
                    } 
                    else { 
                        kal += data_laporan[i]['nama_mahasiswa1'];
                    }
                    kal += '</p><p>';
                    if(data_laporan[i]['nama_dosen2'] != null){ 
                        kal += data_laporan[i]['nama_dosen2']; 
                    } 
                    else { 
                        kal += data_laporan[i]['nama_mahasiswa2'];
                    }
                    kal += '</p><p>';
                    if(data_laporan[i]['nama_dosen3'] != null){ 
                        kal += data_laporan[i]['nama_dosen3']; 
                    } 
                    else { 
                        kal += data_laporan[i]['nama_mahasiswa3'];
                    }
                    
                    kal += '</p>';
                kal += '</td>';

                kal += '<td>';
                    if(data_laporan[i]['semester'] == 1){
                        kal += 'Ganjil ';
                    }
                    else{
                        kal += 'Genap ';
                    }
                    kal += data_laporan[i]['tahun_ajaran'];
                kal += '</td>';
                kal += '<td>';
                    if(data_laporan[i]['status'] == 1){
                        kal += '<span class="badge bg-green">active</span>';
                    }
                    else{
                        kal += '<span class="badge bg-danger">non active</span>';
                    }
                kal += '</td>';
            kal += '</tr>';
        }

        initializedatatable(kal);
    }

    function viewdetailkelas(){
        var kal = '';

        for(var i = 0; i < data_laporan.length; i++){
            // alert("MASUK" + data_laporan[i]["kode_kelas_praktikum"]);
            kal += '<div class="col-md-6 col-sm-12">';
                kal += '<p> Kode Kelas Praktikum : ' + data_laporan[i]["kode_kelas_praktikum"] + '</p>';
                kal += '<p> Kode Laboratorium &nbsp : ' + data_laporan[i]["kode_lab"] + '</p>';
            kal += '</div>';
            kal += '<div class="col-md-6 col-sm-12">';
                kal += '<p> Nama Kelas Praktikum : ' + data_laporan[i]["nama_subject"] + ' ' + data_laporan[i]["kelas_paralel"] + '</p>';
                kal += '<p> Waktu &nbsp &nbsp &nbsp :' + data_laporan[i]["hari"] + ' ' + data_laporan[i]["jam"] + '</p>';
            kal += '</div>';

            kal += '<table id="datatable_laporan_detail_kelas" class="table table-striped table-bordered" style="width:100%">';
                kal += '<thead>';
                kal += '<tr>';
                    kal += '<th>No. </th>';
                    kal += '<th>NRP</th>';
                    kal += '<th>Mahasiswa</th>';
                kal += '</tr>';
                kal += '</thead>';
                kal += '<tbody>';
                    for(var j = 0; j < data_laporan[i]['mahasiswa'].length; j++){
                        kal += '<tr>';
                            kal += '<td>' + (j+1) + '</td>';
                            kal += '<td>' + data_laporan[i]['mahasiswa'][j]['NRP'] + '</td>';
                            kal += '<td>' + data_laporan[i]['mahasiswa'][j]['nama_mahasiswa'] + '</td>';
                        kal += '</tr>';
                    }
                kal += '</tbody>';
            kal += '</table>';
        }

        alert(kal);
        $("#laporan_detail_kelas").html(kal);        
    }

    function initializedatatable($kal){
        if(baru > 0){
            $('#datatable_laporan_'+ jenislaporan).DataTable().destroy();
        }
        $("#body_table_"+ jenislaporan).html($kal);
        baru++;

        $('#datatable_laporan_'+ jenislaporan).DataTable( {
            dom: "Blfrtip",
            buttons: [
                {
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });
    }
</script>
