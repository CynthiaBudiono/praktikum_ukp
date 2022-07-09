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
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:max-content;"><?= isset($title) ? $title : "-" ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="margin: 0px 10px; padding-top: 4px;"> <!-- UNTUK LAPORAN DETAIL KELAS, NILAI KELAS -->
                            <select class="select2_single" name ="ddkelas_prak" id="ddkelas_prak" tabindex="-1" style="display: none;">
                                <?php if($function == 'detail_kelas'){?>
                                    <option value="0"> ALL </option>
                                <?php } ?>
                                <!-- <option value="all"> ALL </option> -->
                                <?php if(isset($ddkelasprak)) : ?>
                                    <?php if(is_array($ddkelasprak)) : ?>
                                        <?php foreach($ddkelasprak as $key) : ?>
                                            <option value="<?= (isset($key['id'])) ? $key['id'] : '' ?>"> <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?> (<?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?>) <?= (isset($key['tipe'])) ? $key['tipe'] : '' ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                        </li>

                        <li style="margin: 0px 10px; padding-top: 4px;"> <!-- UNTUK mahasiswa tertolak -->
                            <select class="select2_single" name ="ddsubject" id="ddsubject" tabindex="-1" style="display: none;">
                                <!-- <option value="all"> ALL </option> -->
                                <?php if(isset($ddsubject)) : ?>
                                    <?php if(is_array($ddsubject)) : ?>
                                        <?php foreach($ddsubject as $key) : ?>
                                            <option value="<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>"> <?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></option>
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
                        <!-- <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
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
                                                <!-- <th>Action</th> -->
                                                <th>Hari, Jam</th>
                                                <th>Lab</th>
                                                <th>Mata Kuliah</th>
                                                <!-- <th>Terisi</th> -->
                                                <th>Pengajar</th>
                                                <th>Periode</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_kelas"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN KELAS -->

                                <?php if($function == 'lulus'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_lulus" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Mahasiswa</th>
                                                <th>Nilai Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_lulus"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN LULUS -->

                                <?php if($function == 'tidak_lulus'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_tidak_lulus" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Mahasiswa</th>
                                                <th>Nilai Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_tidak_lulus"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN LULUS -->

                                <!-- /LAPORAN DETAIL KELAS -->
                                <?php if($function == 'detail_kelas'){?>
                                    <div id="laporan_detail_kelas"></div>
                                <?php } ?> <!-- /LAPORAN DETAIL KELAS -->

                                <!-- /LAPORAN MAHASISWA TERTOLAK -->
                                <?php if($function == 'mahasiswa_tertolak'){?>
                                    <!-- <div id="laporan_mahasiswa_tertolak"></div> -->
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_mahasiswa_tertolak" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NRP</th>
                                                <th>Nama</th>
                                                <th>Pil1</th>
                                                <th>Pil2</th>
                                                <th>Pil3</th>
                                                <th>Terpilih</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_mahasiswa_tertolak"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN MAHASISWA TERTOLAK -->

                                <!-- /LAPORAN MAHASISWA -->
                                <?php if($function == 'mahasiswa'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_mahasiswa" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Mahasiswa</th>
                                                <th>Mata Kuliah</th>
                                                <th>Pil1</th>
                                                <th>Pil2</th>
                                                <th>Pil3</th>
                                                <th>Terpilih</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_mahasiswa"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN MAHASISWA -->
                                

                                <!-- /LAPORAN DETAIL NILAI KELAS -->
                                <?php if($this->session->userdata('user_type') == 'mahasiswa'){ ?>
                                    <?php if($function == 'nilai_kelas'){?>
                                        <select class="mahasiswa_input form-control select2" name="ddmahasiswa" id="ddmahasiswa" style="width:100%;">
                                            <option value="" disabled selected>Search mahasiswa</option>
                                        </select>
                                        <div class="card-box table-responsive">
                                            <table id="datatable_laporan_nilai_kelas" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Pertemuan ke-</th>
                                                    <th>Nilai Awal</th>
                                                    <th>Nilai Materi</th>
                                                    <th>Nilai Tugas</th>
                                                    <th>rata_rata</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body_table_nilai_kelas"></tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div>
                                            <div class="col-md-10 col-sm-10">
                                                <h2>Average</h2>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <h2 id="ratarata"></h2>
                                            </div>
                                        </div>
                                    <?php } ?> <!-- /LAPORAN DETAIL NILAI KELAS -->
                                <?php }else { ?>
                                    <?php if($function == 'nilai_kelas'){?>
                                        <div class="card-box table-responsive">
                                            <table id="datatable_laporan_nilai_kelas" class="table table-striped table-bordered" style="width:100%">
                                            <thead id="head_table_nilai_kelas">
                                                <tr id="tr_table_nilai_kelas">
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body_table_nilai_kelas"></tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div>
                                            <div class="col-md-10 col-sm-10">
                                                <h2>Rata Rata Kelas</h2>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <h2 id="ratarata"></h2>
                                            </div>
                                        </div>
                                    <?php } ?> <!-- /LAPORAN DETAIL KELAS -->
                                <?php } ?>

                                <!-- /LAPORAN TRANSFER NILAI -->
                                <?php if($function == 'transfer_nilai'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_transfer_nilai" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>Mahasiswa</th>
                                                <th>Mata Kuliah</th>
                                                <th>Nilai Akhir</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_transfer_nilai"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN TRANSFER NILAI -->

                                <!-- /LAPORAN DETAIL TRANSFER NILAI -->
                                <?php if($function == 'detail_transfer_nilai'){?>
                                    <div class="card-box table-responsive">
                                        <table id="datatable_laporan_detail_transfer_nilai" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Pertemuan ke-</th>
                                                <th>Nilai Awal</th>
                                                <th>Nilai Materi</th>
                                                <th>Nilai Tugas</th>
                                                <th>rata_rata</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_table_detail_transfer_nilai"></tbody>
                                        </table>
                                    </div>
                                <?php } ?> <!-- /LAPORAN DETAIL TRANSFER NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var baseurl = "<?php echo base_url(); ?>";
    var usertype = "<?php echo $this->session->userdata('user_type'); ?>"; 
    var jenislaporan = "<?= $function ?>";
    // var data_informasi = [];
    var data_laporan = [];
    var baru = 0;
    $(document).ready(function() {
        if(jenislaporan == "kelas"){
            viewkelas();
            $('#ddkelas_prak').css('display', 'none');

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
        else if(jenislaporan == "lulus"){
            $('#ddkelas_prak').css('display', 'block');
            $("#ddkelas_prak").change(function(){
                // alert($("#ddkelas_prak").val());
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewlulus();
                });
            });
            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewlulus();
                });
            });
            $("#ddtahun_ajaran").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewlulus();
                });
            });
            $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                id_kelas_praktikum: $("#ddkelas_prak").val(),
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                // alert(result);
                var arr = JSON.parse(result);

                data_laporan = arr;

                viewlulus();
            });
        }
        else if(jenislaporan == "tidak_lulus"){
            $('#ddkelas_prak').css('display', 'block');
            $("#ddkelas_prak").change(function(){
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewtidaklulus();
                });
            });
            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewlulus();
                });
            });
            $("#ddtahun_ajaran").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                    id_kelas_praktikum: $("#ddkelas_prak").val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewlulus();
                });
            });
            $.post(baseurl + "mahasiswa_nilai/getlulustidaklulus", {
                id_kelas_praktikum: $("#ddkelas_prak").val(),
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                var arr = JSON.parse(result);

                data_laporan = arr;

                viewtidaklulus();
            });
        }
        else if(jenislaporan == "detail_kelas"){

            // if(usertype == "mahasiswa" || usertype == "asisten_dosen"){
            //     $('#ddsemester').css('display', 'none');
            //     $('#ddtahun_ajaran').css('display', 'none');
            // }
            // else{
                $('#ddkelas_prak').css('display', 'block');
                // alert("AAA : " + $("#ddtahun_ajaran").val());
                
                $("#ddkelas_prak").change(function(){
                    $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                        id_kelas_praktikum: $("#ddkelas_prak").val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        // alert(result);


                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewdetailkelas();
                    });
                });

                $("#ddsemester").change(function(){
                // alert("aa" + this.value);

                    $.post(baseurl + "kelas_praktikum/getperiod", {
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        // alert(result);
                        var arr = JSON.parse(result);
                        var html = '<option val="0">ALL</option> <option val="" disabled>-Pilih Kelas-</option>';

                        for(var i = 0; i < arr.length; i++){
                            html += '<option value="' + arr[i]['id'] + '">' + arr[i]['nama_subject'] + ' (' + arr[i]['kelas_paralel'] + ') ' + arr[i]['tipe'] +'</option>';
                        }

                        $('#ddkelas_prak').html(html);
                    });
                    

                    $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                        id_kelas_praktikum: $("#ddkelas_prak").val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewdetailkelas();
                    });
                });

                $("#ddtahun_ajaran").change(function(){

                    $.post(baseurl + "kelas_praktikum/getperiod", {
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        // alert(result);
                        var arr = JSON.parse(result);
                        var html = '<option val="0">ALL</option> <option val="" disabled>-Pilih Kelas-</option>';

                        for(var i = 0; i < arr.length; i++){
                            html += '<option value="' + arr[i]['id'] + '">' + arr[i]['nama_subject'] + ' (' + arr[i]['kelas_paralel'] + ') ' + arr[i]['tipe'] +'</option>';
                        }

                        $('#ddkelas_prak').html(html);
                    });

                    $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                        id_kelas_praktikum: $("#ddkelas_prak").val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        // alert("getdetailmahasiswa : " + result);
                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewdetailkelas();
                    });
                });
            // }

            $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
                id_kelas_praktikum: $("#ddkelas_prak").val(),
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                // alert("getdetailmahasiswa : " + result);
                var arr = JSON.parse(result);

                data_laporan = arr;

                viewdetailkelas();
            });

            // $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", {
            //     id_kelas_praktikum: $("#ddkelas_prak").val(),
            //     semester: $("#ddsemester").val(),
            //     tahun_ajaran : $("#ddtahun_ajaran").val()
            // },
            // function(result) {
            //     // alert("getdetailmahasiswa : " + result);
            //     var arr = JSON.parse(result);

            //     data_laporan = arr;

            //     viewdetailkelas();
            // });
            // $.post(baseurl + "kelas_praktikum/getdetailmahasiswa", { // VIEW ALL
            //     id_kelas_praktikum: 0,
            //     semester: $("#ddsemester").val(),
            //     tahun_ajaran : $("#ddtahun_ajaran").val()
            // },
            // function(result) {
            //     // alert("RESULT : " + result);
            //     var arr = JSON.parse(result);
            //     // alert(arr.length);
            //     data_laporan = arr;

            //     // alert(JSON.stringify(data_laporan));
            //     viewdetailkelas();
            // });
            
        }
        else if(jenislaporan == "mahasiswa"){
            viewmahasiswa();
            $('#ddkelas_prak').css('display', 'none');
            $('#ddsubject').css('display', 'block');

            $('#ddsubject').on("change paste keyup select", function() {
                $.post(baseurl + "ambil_praktikum/getmahasiswaambil", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val(),
                },
                function(result) {
                    // alert(result);
                    changekelasbyperiod();
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswa();
                });
            });

            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "ambil_praktikum/getmahasiswaambil", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    changekelasbyperiod();
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswa();
                });
            });

            $("#ddtahun_ajaran").change(function(){
                $.post(baseurl + "ambil_praktikum/getmahasiswaambil", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    changekelasbyperiod();
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswa();
                });
            });
            $.post(baseurl + "ambil_praktikum/getmahasiswaambil", {
                id : $('#ddsubject').val(),
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                // alert(result);
                var arr = JSON.parse(result);
                data_laporan = arr;
                viewmahasiswa();
            });
        }
        else if(jenislaporan == "mahasiswa_tertolak"){
            viewmahasiswatertolak();
            $('#ddkelas_prak').css('display', 'none');
            $('#ddsubject').css('display', 'block');

            // alert("kode_mk : " + $('#ddsubject').val());
            // alert("semester" + $('#ddsemester').val());
            // alert("tahun_ajaran : " + $('#ddtahun_ajaran').val());
            $('#ddsubject').on("change paste keyup select", function() {
                $.post(baseurl + "ambil_praktikum/getmahasiswatertolak", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val(),
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswatertolak();
                });
            });

            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "ambil_praktikum/getmahasiswatertolak", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswatertolak();
                });
            });

            $("#ddtahun_ajaran").change(function(){
                $.post(baseurl + "ambil_praktikum/getmahasiswatertolak", {
                    id : $('#ddsubject').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewmahasiswatertolak();
                });
            });

        }
        else if(jenislaporan == "nilai_kelas"){
            // viewnilaikelas();
            $('#ddkelas_prak').css('display', 'block');
            if(usertype == "mahasiswa"){
                $('#ddmahasiswa').select2();
                // $('#ddkelas_prak').css('display', 'block');
                $('#ddkelas_prak').on("change paste keyup select", function() {
                    $.post(baseurl + "ambil_praktikum/getterpilihkelas", {
                        id : $('#ddkelas_prak').val()
                    },
                    function(result) {
                        var arr = JSON.parse(result);
                        var kal = '';
                        kal += '<option value="" disabled selected>Search mahasiswa</option>';
                        // kal += '<option value="all"> ALL </option>';
                        for(var i=0; i<arr.length; i++){
                            kal += '<option value="'+ arr[i]['NRP'] +'">'+ arr[i]['nama_mahasiswa'] +'</option>';
                        }

                        $('#ddmahasiswa').html(kal);
                    });
                });

                $("#ddmahasiswa").change(function(){
                    $.post(baseurl + "mahasiswa_nilai/getdetailmahasiswa", {
                        id : $('#ddkelas_prak').val(),
                        nrp: $("#ddmahasiswa").val(),
                    },
                    function(result) {
                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewnilaikelas();
                    });
                });
            }
            else{
                $.post(baseurl + "mahasiswa_nilai/getsummary", {
                    id : $('#ddkelas_prak').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {

                    // alert(result);
                    changekelasbyperiod("viewnilaikelassummary");
                    // var arr = JSON.parse(result);

                    // data_laporan = arr;

                    // viewnilaikelassummary();
                    // viewnilaikelassummaryall();
                });
                $("#ddsemester").change(function(){
                    $.post(baseurl + "mahasiswa_nilai/getsummary", {
                        id : $('#ddkelas_prak').val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        changekelasbyperiod("viewnilaikelassummary");
                        // var arr = JSON.parse(result);
                        // data_laporan = arr;
                        // viewnilaikelassummary();
                    });
                });

                $("#ddtahun_ajaran").change(function(){
                    $.post(baseurl + "mahasiswa_nilai/getsummary", {
                        id : $('#ddkelas_prak').val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {
                        // changekelasbyperiod("viewnilaikelassummary");
                        changekelasbyperiod();
                        // $.post(baseurl + "kelas_praktikum/getperiod", {
                        //     semester: $("#ddsemester").val(),
                        //     tahun_ajaran : $("#ddtahun_ajaran").val()
                        // },
                        // function(result) {
                        //     // alert(result);
                        //     var arr = JSON.parse(result);
                        //     var html = '<option val="" disabled>-Pilih Kelas-</option>';

                        //     for(var i = 0; i < arr.length; i++){
                        //         html += '<option value="' + arr[i]['id'] + '">' + arr[i]['nama_subject'] + ' (' + arr[i]['kelas_paralel'] + ') ' + arr[i]['tipe'] +'</option>';
                        //     }

                        //     $('#ddkelas_prak').html(html);

                        // });

                        // var arr = JSON.parse(result);
                        // data_laporan = arr;
                        // viewnilaikelassummary();
                    });
                });
                
                $('#ddkelas_prak').on("change paste keyup select", function() {
                    // alert($('#ddkelas_prak').val());
                    $.post(baseurl + "mahasiswa_nilai/getsummary", {
                        id : $('#ddkelas_prak').val(),
                        semester: $("#ddsemester").val(),
                        tahun_ajaran : $("#ddtahun_ajaran").val()
                    },
                    function(result) {

                        // alert(result);
                        console.log(result);
                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewnilaikelassummary();
                    });
                });
            }
        }
        else if(jenislaporan == "transfer_nilai"){
            $('#ddkelas_prak').css('display', 'none');
            $('#ddsubject').css('display', 'none');

            $.post(baseurl + "mahasiswa_nilai/gettransfernilai", {
                semester: $("#ddsemester").val(),
                tahun_ajaran : $("#ddtahun_ajaran").val()
            },
            function(result) {
                // alert(result);
                if(result != "[]"){
                    var arr = JSON.parse(result);

                    data_laporan = arr;

                    viewtransfernilai();
                }
                else{
                    data_laporan[0] = [];

                    viewtransfernilai();
                }
                
            });

            $("#ddsemester").change(function(){
                // alert("aa" + this.value);
                $.post(baseurl + "mahasiswa_nilai/gettransfernilai", {
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    if(result != "[]"){

                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewtransfernilai();
                    }
                    else{
                        data_laporan[0] = [];

                        viewtransfernilai();
                    }
                });
            });

            $("#ddtahun_ajaran").change(function(){
                $.post(baseurl + "mahasiswa_nilai/gettransfernilai", {
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {
                    // alert(result);
                    // console.log(result);
                    if(result != "[]"){
                        var arr = JSON.parse(result);

                        data_laporan = arr;

                        viewtransfernilai();
                    }
                    else{
                        data_laporan[0] = [];

                        viewtransfernilai();
                    }
                });
            });
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
                // kal += '<td><a onclick=pindah(' + data_laporan[i]['id'] + ') class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a></td>';
                kal += '<td>' + data_laporan[i]['hari'] + ', ' + data_laporan[i]['jam'] + '<br><b>(' + data_laporan[i]['durasi'] + ' menit)</b></td>';
                kal += '<td>' + data_laporan[i]['kode_lab'] + ' ~ ' + data_laporan[i]['nama_lab'] + '<br><b>(' + data_laporan[i]['terisi'] + '/' + data_laporan[i]['quota_max'] + ')</b></td>';
                kal += '<td>' + data_laporan[i]['kode_mk'] + ' ~ ' + data_laporan[i]['nama_subject'] + '</td>';
                kal += '<td><p>'; //PENGAJAR DOSEN ATAU ASISTEN
                    if(data_laporan[i]['nama_dosen1'] != null){ 
                        kal += data_laporan[i]['nama_dosen1']; 
                    } 
                    else if(data_laporan[i]['nama_mahasiswa1'] != null){ 
                        kal += data_laporan[i]['nama_mahasiswa1'];
                    }
                    kal += '</p><p>';
                    if(data_laporan[i]['nama_dosen2'] != null){ 
                        kal += data_laporan[i]['nama_dosen2']; 
                    } 
                    else if(data_laporan[i]['nama_mahasiswa2'] != null){ 
                        kal += data_laporan[i]['nama_mahasiswa2'];
                    }
                    kal += '</p><p>';
                    if(data_laporan[i]['nama_dosen3'] != null){ 
                        kal += data_laporan[i]['nama_dosen3']; 
                    } 
                    else if(data_laporan[i]['nama_mahasiswa3'] != null){ 
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
                kal += '<p> <b>Kode Kelas Praktikum : </b>' + data_laporan[i]["kode_kelas_praktikum"] + '</p>';
                kal += '<p> <b>Kode Laboratorium &nbsp : </b>' + data_laporan[i]["kode_lab"] + '</p>';
            kal += '</div>';
            kal += '<div class="col-md-6 col-sm-12">';
                kal += '<p> <b>Nama Kelas Praktikum : </b>' + data_laporan[i]["nama_subject"] + ' ' + data_laporan[i]["kelas_paralel"] + ' (' + data_laporan[i]["tipe"] +')</p>';
                kal += '<p> <b>Waktu &nbsp &nbsp &nbsp : </b>' + data_laporan[i]["hari"] + ' ' + data_laporan[i]["jam"] + '</p>';
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

        // alert(kal);

        // initializedatatable(kal);
        $("#laporan_detail_kelas").html(kal);   

        if(data_laporan.length == 1){
            $('#datatable_laporan_detail_kelas').DataTable( {
                dom: "Blfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm"
                    },
                    // {
                    //     extend: "csv",
                    //     className: "btn-sm"
                    // },
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
    }

    function viewmahasiswa(){
        var kal = '';

        for(var i = 0; i < data_laporan.length; i++){
            kal += '<tr>';
                kal += '<td>' + data_laporan[i]['NRP'] + ' - ' + data_laporan[i]['nama_mahasiswa'] + '</td>';
                kal += '<td>' + data_laporan[i]['kode_mk'] + ' - ' + data_laporan[i]['nama_subject'] + '</td>';
                if(data_laporan[i]['pil1'] != null){
                    kal += '<td>' + data_laporan[i]['hari1'] + ', ' + data_laporan[i]['jam1'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['pil2'] != null){
                    kal += '<td>' + data_laporan[i]['hari2'] + ', ' + data_laporan[i]['jam2'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['pil3'] != null){
                    kal += '<td>' + data_laporan[i]['hari3'] + ', ' + data_laporan[i]['jam3'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['terpilih'] != 0){
                    kal += '<td>' + data_laporan[i]['hariterpilih'] + ', ' + data_laporan[i]['jamterpilih'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                
            kal += '</tr>';
        }

        initializedatatable(kal);
    }

    function viewmahasiswatertolak(){
        var kal = '';

        for(var i = 0; i < data_laporan.length; i++){
            kal += '<tr>';
                kal += '<td>' + data_laporan[i]['NRP'] + '</td>';
                kal += '<td>' + data_laporan[i]['nama_mahasiswa'] + '</td>';
                if(data_laporan[i]['pil1'] != null){
                    kal += '<td>' + data_laporan[i]['hari1'] + ", " + data_laporan[i]['jam1'] +'</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['pil2'] != null){
                    kal += '<td>' + data_laporan[i]['hari2'] + ", " + data_laporan[i]['jam2'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['pil3'] != null){
                    kal += '<td>' + data_laporan[i]['hari3'] + ", " + data_laporan[i]['jam3'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
                if(data_laporan[i]['terpilih'] != 0){
                    kal += '<td>' + data_laporan[i]['hariterpilih'] + ", " + data_laporan[i]['jamterpilih'] + '</td>';
                }
                else{
                    kal += '<td></td>';
                }
            kal += '</tr>';
        }

        initializedatatable(kal);
    }

    function changekelasbyperiod($viewfunc = ""){
        $.post(baseurl + "kelas_praktikum/getperiod", {
            semester: $("#ddsemester").val(),
            tahun_ajaran : $("#ddtahun_ajaran").val()
        },
        function(result) {
            // alert(result);
            var arr = JSON.parse(result);
            // var html = '';
            var html = '<option val="" disabled selected>-Pilih Kelas-</option>';

            for(var i = 0; i < arr.length; i++){
                html += '<option value="' + arr[i]['id'] + '">' + arr[i]['nama_subject'] + ' (' + arr[i]['kelas_paralel'] + ') ' + arr[i]['tipe'] +'</option>';
            }

            $('#ddkelas_prak').html(html);

            if($viewfunc == "viewnilaikelassummary"){
                $.post(baseurl + "mahasiswa_nilai/getsummary", {
                    id : $('#ddkelas_prak').val(),
                    semester: $("#ddsemester").val(),
                    tahun_ajaran : $("#ddtahun_ajaran").val()
                },
                function(result) {

                    var arr = JSON.parse(result);
                    data_laporan = arr;
                    viewnilaikelassummary();
                });
            }

        });


    }

    function viewnilaikelas(){
        var kal = '';
        var ratarata = 0;
        var jumlah = 0;
        for(var i = 0; i < data_laporan.length; i++){
            // alert(data_laporan[i]['pertemuan']);
            kal += '<tr>';
                kal += '<td>' + data_laporan[i]['pertemuan'] + '</td>';
                kal += '<td>' + data_laporan[i]['nilai_awal'] + '</td>';
                kal += '<td>' + data_laporan[i]['nilai_materi'] + '</td>';
                kal += '<td>' + data_laporan[i]['nilai_tugas'] + '</td>';
                kal += '<td>' + data_laporan[i]['rata_rata'] + '</td>';
            kal += '</tr>';
            jumlah += data_laporan[i]['rata_rata'];
        }
        ratarata = jumlah / (data_laporan.length);

        $("#ratarata").html(ratarata);
        // alert(kal);
        // $("#laporan_nilai_kelas").html(kal);
        initializedatatable(kal);

    }

    function viewnilaikelassummaryall(){
        // var kal = '';

        // // datatable_laporan_nilai_kelas
        // for(var i = 0; i < data_laporan.length; i++){

        //     kal += '<tr>';
        //         kal += '<td>' + data_laporan[i]['nama_mahasiswa'] + '</td>';
        //         kal += '<td>' + data_laporan[i]['rata_rata'] + '</td>';
        //     kal += '</tr>';
        // }
    }

    function viewnilaikelassummary(){
        var kal = '';
        var ratarata = 0;
        var jumlah = 0;
        // datatable_laporan_nilai_kelas
        if(data_laporan.length > 0){
            // alert("NILAII" + data_laporan[0]['nilai'].length);
            $("#tr_table_nilai_kelas").html("<th>Nama</th>"); 
            for(var j = 0; j < data_laporan[0]['nilai'].length; j++){
                $("#tr_table_nilai_kelas").append("<th>P"+ data_laporan[0]['nilai'][j]['pertemuan'] +"</th>");
            }

            for(var i = 0; i < data_laporan.length; i++){
                kal += '<tr>';
                    kal += '<td>' + data_laporan[i]['NRP'] + " - " + data_laporan[i]['nama_mahasiswa'] + '</td>';
                    for(var j = 0; j < data_laporan[i]['nilai'].length; j++){
                        kal += '<td>' + data_laporan[i]['nilai'][j]['rata_rata'] + '</td>';
                    }
                kal += '</tr>';
            }
        }
    
        
        // ratarata = jumlah / (data_laporan.length);

        // $("#ratarata").html(ratarata);
        // alert(kal);
        // $("#laporan_nilai_kelas").html(kal);
        initializedatatable(kal);        
    }

    function viewlulus(){
        var kal = '';
        var hasil = 0;
        for(var i = 0; i < data_laporan.length; i++){
            hasil = (data_laporan[i]['sum_rata_rata']/data_laporan[i]['jumlah_pertemuan']);
            if(hasil > 56){
                // alert("HASIL AKHIR : " + data_laporan[i]['sum_rata_rata'] + " / " + data_laporan[i]['jumlah_pertemuan']);
                kal += '<tr>';
                    kal += '<td>' + data_laporan[i]['NRP'] + ' - ' + data_laporan[i]['nama_mahasiswa'] +'</td>';
                    kal += '<td>' + hasil + '</td>';
                kal += '</tr>';
            }
        }

        initializedatatable(kal);
    }

    function viewtidaklulus(){
        var kal = '';
        var hasil = 0;
        for(var i = 0; i < data_laporan.length; i++){
            hasil = (data_laporan[i]['sum_rata_rata']/data_laporan[i]['jumlah_pertemuan']);
            if(hasil < 56){
                kal += '<tr>';
                    kal += '<td>' + data_laporan[i]['NRP'] + ' - ' + data_laporan[i]['nama_mahasiswa'] +'</td>';
                    kal += '<td>' + hasil + '</td>';
                kal += '</tr>';
            }
        }

        initializedatatable(kal);
    }

    function viewtransfernilai(){
        var kal = '';
        var hasil = 0;
        for(var i = 0; i < data_laporan[0].length; i++){
            hasil = (data_laporan[0][i]['sum_rata_rata']/data_laporan[0][i]['jumlah_pertemuan']);
            kal += '<tr>';
                
                // kal += '<td><a onclick=detailtransfernilai(' + data_laporan[0][i]['id_kelas_praktikum'] + ',' + data_laporan[0][i]['NRP'] + ') style="color:white" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a></td>';
                kal += '<td>' + data_laporan[0][i]['NRP'] + ' - ' + data_laporan[0][i]['nama_mahasiswa'] +'</td>';
                kal += '<td>' + data_laporan[0][i]['kode_mk'] + ' - ' + data_laporan[0][i]['nama_subject'] +'</td>';
                kal += '<td>' + data_laporan[0][i]['hasil_akhir'] + '</td>';
                kal += '<td><a href="<?= (base_url('mahasiswa_nilai/viewdetail')); ?>/' + data_laporan[0][i]['NRP'] + '/' + btoa(data_laporan[0][i]['id_kelas_praktikum']) + '" style="color:white" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a></td>';
            kal += '</tr>';
        }

        initializedatatable(kal);
    }

    function detailtransfernilai($idkelasprak, $nrp){
        // alert("func detailtransfernilai : " + $idkelasprak + " " + $nrp);
        
        // $.post(baseurl + "mahasiswa_nilai/getdetailtransfernilai", {
        //     id_kelas_prak: $idkelasprak,
        //     nrp : $nrp
        // },
        // function(result) {
        //     var arr = JSON.parse(result);

        //     data_laporan = arr;

        //     viewdetailtransfernilai();
        // });
    }

    function viewdetailtransfernilai(){
        // var kal = '';
        // var hasil = 0;
        // for(var i = 0; i < data_laporan.length; i++){
        //     hasil = (data_laporan[i]['sum_rata_rata']/data_laporan[i]['jumlah_pertemuan']);
        //     kal += '<tr>';
        //         kal += '<td>' + data_laporan[i]['pertemuan'] + '</td>';
        //         kal += '<td>' + data_laporan[i]['nilai_awal'] + '</td>';
        //         kal += '<td>' + data_laporan[i]['nilai_materi'] + '</td>';
        //         kal += '<td>' + data_laporan[i]['nilai_tugas'] + '</td>';
        //     kal += '</tr>';
        // }

        // initializedatatable(kal);
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
                // {
                //     extend: "csv",
                //     className: "btn-sm"
                // },
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
