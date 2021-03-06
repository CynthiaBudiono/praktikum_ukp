<!-- Untuk mahasiswa, kyk prs , UI kyk kelas_praktikum-add-->
<style>
    .wrapper-radio{
        display: inline-flex;
    }
    .wrapper-radio .option{
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        margin: 0 10px;
        border-radius: 5px;
        cursor: pointer;
        padding: 0 10px;
        border: 2px solid lightgrey;
        transition: all 0.3s ease;
    }
    .wrapper-radio .option .dot{
        height: 15px;
        width: 15px;
        background: #d9d9d9;
        border-radius: 50%;
        position: relative;
    }
    .wrapper-radio .option .dot::before{
        position: absolute;
        content: "";
        border-radius: 50%;
        opacity: 0;
        transform: scale(1.5);
        transition: all 0.3s ease;
    }
    input[type="radio"]{
        display: none;
    }
    #radiopraktikum:checked:checked ~ .radiopraktikum,
    #radioresponsi:checked:checked ~ .radioresponsi{
        border-color: #1d81be;
        background: #1d81be;
    }
    #radiopraktikum:checked:checked ~ .radiopraktikum .dot,
    #radioresponsi:checked:checked ~ .radioresponsi .dot{
        background: url(<?php echo base_url('assets/icons/checkmark.svg');?>);
    }
    #radiopraktikum:checked:checked ~ .radiopraktikum .dot::before,
    #radioresponsi:checked:checked ~ .radioresponsi .dot::before{
        opacity: 1;
        transform: scale(1);
    }
    .wrapper-radio .option span{
        font-size: 12px;
        color: #808080;
    }
    #radiopraktikum:checked:checked ~ .radiopraktikum span,
    #radioresponsi:checked:checked ~ .radioresponsi span{
        color: #fff;
    }

    .bg-yellow{
        background-color: #f2cc8e;
        color: black !important;
        border: 1px solid black !important;
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
        <?php if($bukapendaftaran == "tutup"){?>
            Maaf pendaftaran TUTUP, silahkan menunggu info lanjut pembukaan pendaftaran 
        <?php } else if($bukapendaftaran == "buka"){?>
        
        <div class="col-md-12 col-sm-12" id="box-add">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="action_title">Add</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="content-add">
                        <br />
                        <!-- <input type="hidden" class="form-control" name="mode" id="mode" value="add"> -->
                            <?php if($this->session->userdata('user_type') == 'admin'){ ?>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control select2" name="mahasiswa" id="mahasiswa" style="width:100%;">
                                        <option value="" disabled selected>-- Search Mahasiswa --</option>
                                    </select>
                                </div>
                            </div>
                            <?php } elseif($this->session->userdata('user_type') == 'mahasiswa' || $this->session->userdata('user_type') == 'asisten_dosen' || $this->session->userdata('user_type') == 'asisten_tetap'){ ?>
                                <input type="hidden" class="form-control" name="mahasiswa" id="mahasiswa" value="<?= $this->session->userdata('user_id')?>">
                            <?php }?>

                            <div id="box-component">
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 "></label>
                                    <div class="col-md-9 col-sm-9">
                                        <div id="detail_mahasiswa"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Mata Kuliah</label>
                                    <div class="col-md-5 col-sm-5 ">
                                        <select class="subject_input form-control select2" name="subject" id="subject" style="width:100%;">
                                            <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <div class="wrapper-radio">
                                            <input type="radio" checked value="praktikum" id="radiopraktikum" name="tipe">
                                            <input type="radio" value="responsi" id="radioresponsi" name="tipe">
                                            <label for="radiopraktikum" class="option radiopraktikum">
                                                <div class="dot"></div>
                                                <span>Praktikum</span>
                                                </label>
                                            <label for="radioresponsi" class="option radioresponsi">
                                                <div class="dot"></div>
                                                <span>Responsi</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Pilihan 1</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="pilihan_input form-control select2" name="pilihan1" id="pilihan1" style="width:100%;">
                                            <option value="placeholder_text" disabled selected>-- Pilih Mata Kuliah dahulu --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Pilihan 2</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="pilihan_input form-control select2" name="pilihan2" id="pilihan2" style="width:100%;">
                                            <option value="placeholder_text" disabled selected>-- Pilih Mata Kuliah dahulu --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Pilihan 3</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="pilihan_input form-control select2" name="pilihan3" id="pilihan3" style="width:100%;">
                                            <option value="placeholder_text" disabled selected>-- Pilih Mata Kuliah dahulu --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9">
                                        <!-- <button type="button" class="btn btn-danger">Cancel</button> -->
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="button" class="btn btn-success" id="btnsubmit" onclick="add()"><a href="#data_table" style="color: white;">Tambah</a></button>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- /x_content -->
                </div>
            <!-- </div> -->
        </div>
        <?php }?>
        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title" id="data_table">
                    <h2>Kelas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="margin: 15px 20px 0px 0px;"><span class="badge bg-yellow">Bentrok</span></li>
                        <li><button type="button" class="btn bg-success" id="btnvalidasi" onclick="validasi()" <?php if($this->session->userdata('user_type') == 'mahasiswa' || $this->session->userdata('user_type') == 'asisten_dosen' || $this->session->userdata('user_type') == 'asisten_tetap'){if($bukapendaftaran == "tutup"){?>style="display: none;"<?php } else if($bukapendaftaran == "buka"){?>style="display: block;"<?php }}?>>Validasi</button></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-ambil_praktikum" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        
                                        <!-- <th>Kode MK</th> -->
                                        <th>Mata Kuliah</th>
                                        <th>Tipe</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th>Pilihan 3</th>
                                        <th>Terpilih</th>
                                        <th>Action</th>
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
        </div>
    </div>
</div>

<script>
    var baseurl = "<?php echo base_url(); ?>";
    var usertype = "<?php echo $this->session->userdata('user_type'); ?>";
    var bukapendaftaran = "<?php echo $bukapendaftaran; ?>"; //"tutup";
    var userid = "<?php echo $this->session->userdata('user_id'); ?>";
    var data_jadwal = [];
    var baru = 0;
    var kalsubject = '';
    var holdindex = -1;
    // view();
    $(document).ready(function() {	
        // alert("masukkkkkkkk ready");
        // alert(usertype);
        // alert("buka pendaftaran : " + bukapendaftaran);

        $('#subject').select2();
        $('#pilihan1').select2();
        $('#pilihan2').select2();
        $('#pilihan3').select2();
        
        
        if(usertype == "admin"){
            // alert("masuk");
            $('#mahasiswa').select2();
            $.post(baseurl + "mahasiswa/getpesertapraktikum", {},
            function(result) {
                var arr = JSON.parse(result);
                for(var i=0; i<arr.length; i++){
                    $('#mahasiswa').append('<option value="'+ arr[i]['NRP'] +'">'+ arr[i]['NRP'] + ' - ' + arr[i]['nama'] +'</option>');
                }
            });

            $('#mahasiswa').on("change", function() {
                // getambilpraktikum();
                $.post(baseurl + "ambil_praktikum/getambilprakbynrp", {
                    nrp: $('#mahasiswa').val()
                },
                function(result) {
                    // alert("getambilprakbynrp: " + result);
                    if(result != 0){
                        var arr = JSON.parse(result);

                        if (arr != 0){
                            data_jadwal = [];
                            // $('#box-component').css('display', 'none');
                            // $('#btnvalidasi').css('display', 'none');

                            for(var i=0; i<arr.length; i++){
                                add(arr[i]);
                            }
                        }
                    }               
                });
            

                $('#detail_mahasiswa').html("Matakuliah yang diambil " + $('#mahasiswa option:selected').text() + " :");
                $.post(baseurl + "mahasiswa_matakuliah/getsubjectbyNRP", {
                    nrp: $('#mahasiswa').val(),
                },
                function(result) {
                    if(result != 0){
                        var arr = JSON.parse(result);
                        var kal = '';
                        kal +='<ul>';
                        for(var i=0; i<arr.length; i++){
                            kal += '<li>'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</li>';
                        }
                        kal +='</ul>';
                        $('#detail_mahasiswa').append(kal);
                        kalsubject = '';
                        kalsubject += '<option value="" disabled selected>-- Pilih Mata Kuliah --</option>';
                        for(var i=0; i<arr.length; i++){
                            kalsubject +='<option value="'+ arr[i]['kode_mk'] +'">'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</option>';
                            
                            // alert("status_responsi" + arr[i]['status_responsi']);
                        }
                        $('#subject').html(kalsubject);
                    }
                });
            });
        }
        else if(usertype == "mahasiswa" || usertype == "asisten_dosen" || usertype == 'asisten_tetap'){
            // cek apa pendaftaran lagi buka ato tutup
            // kalo buka blh tambah data dan validasi tapi gk blh edit data yg diambil
            // cek di ambilprak apa ada data yg terpilih sama data nrp
            
            // if(bukapendaftaran == "buka"){
            //     view("pendaftaranbuka");
            // }
            // else{
            //     view("pendaftarantutup");
            // }
            // view("fromdb");
            // alert("MASUK");
            $.post(baseurl + "ambil_praktikum/getambilprakbynrp", {
                nrp: userid
            },
            function(result) {
                // alert("getambilprakbynrp: " + result);
                if(result != 0){
                    var arr = JSON.parse(result);

                    if (arr != 0){
                        data_jadwal = [];
                        // $('#box-component').css('display', 'none');
                        // $('#btnvalidasi').css('display', 'none');

                        for(var i=0; i<arr.length; i++){
                            add(arr[i]);
                        }

                        // view("fromdb");
                        if(bukapendaftaran == "buka"){
                            // alert("masukkkk");
                            // $('#btnvalidasi').css('display', 'block');
                            view();
                        }
                        else{
                            view("pendaftarantutup");
                        }
                    }
                }
                else{
                    // alert("masukkk");
                    // $('#btnvalidasi').css('display', 'none');
                    // $('#box-add').css('display', 'none');
                    // view("pendaftarantutup");
                }
                                
            });

            $.post(baseurl + "mahasiswa_matakuliah/getsubjectbyNRP", {
                    nrp: userid
                },
                function(result) {
                    // alert(result);
                    if(result != 0){
                        var arr = JSON.parse(result);
                        var kal = '';
                        // kal +='<ul>';
                        // for(var i=0; i<arr.length; i++){
                        //     kal += '<li>'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</li>';
                        // }
                        // kal +='</ul>';
                        // $('#detail_mahasiswa').append(kal);
                        kalsubject = '';
                        kalsubject += '<option value="" disabled selected>-- Pilih Mata Kuliah --</option>';
                        for(var i=0; i<arr.length; i++){
                            kalsubject +='<option value="'+ arr[i]['kode_mk'] +'">'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</option>';
                            
                            // alert("status_responsi" + arr[i]['status_responsi']);
                        }
                        $('#subject').html(kalsubject);
                    }
                });
        }
        

        // $.post(baseurl + "mahasiswa_matakuliah/getsubjectbyNRPambilprak", {
        //     nrp: $('#mahasiswa').val(),
        // },
        // function(result) {
        //     alert("subject " + result);
        //     var arr = JSON.parse(result);
            
        // });
        $('input[type=radio][name=tipe]').change(function() {
            $.post(baseurl + "kelas_praktikum/getbysubject", {
                kode_mk: $('#subject').val(),
                tipe: $("input[name='tipe']:checked").val(),
            },
            function(result) {
                // alert("masuk");
                if(result != 0){
                    var arr = JSON.parse(result);
                    // var subject = []
                    var kal = '';
                    kal +='<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
                    for(var i=0; i<arr.length; i++){
                        kal +='<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
                    }
                    $('#pilihan1').html(kal);
                    $('#pilihan2').html(kal);
                    $('#pilihan3').html(kal);
                }
            });
        });

        $('.subject_input').on("change", function() {

            // if(arr[i]['status_responsi'] == 1){
            //     $('#content_tipe').css('display', 'block');
            // }

            $.post(baseurl + "kelas_praktikum/getbysubject", {
                kode_mk: $('#subject').val(),
                tipe: $("input[name='tipe']:checked").val(),
            },
            function(result) {
                // alert("masuk ONCHANGEE " + $('#subject').val() + " " + $("input[name='tipe']:checked").val() + result);
                // console.log(result);
                if(result != 0){

                    var arr = JSON.parse(result);
                    // var subject = []
                    var kal = '';
                    kal +='<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
                    for(var i=0; i<arr.length; i++){
                        kal +='<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
                    }
                    $('#pilihan1').html(kal);
                    $('#pilihan2').html(kal);
                    $('#pilihan3').html(kal);

                    $("#mahasiswa").prop("disabled", true);
                    $("#radiopraktikum").prop("disabled", true);
                    $("#radioresponsi").prop("disabled", true);

                    if(holdindex != -1 && data_jadwal.length > 0){
                        if(data_jadwal[holdindex]['pil1'] != null){
                            // alert("AAAAAAAA");
                            $('#pilihan1').val(data_jadwal[holdindex]['pil1']).trigger('change');
                        }
                        if(data_jadwal[holdindex]['pil2'] != null){
                            $('#pilihan2').val(data_jadwal[holdindex]['pil2']).trigger('change');
                        }
                        if(data_jadwal[holdindex]['pil3'] != null){
                            $('#pilihan3').val(data_jadwal[holdindex]['pil3']).trigger('change');
                        }
                        holdindex = -1;
                    }
                    $.post(baseurl + "subject/get", {
                        kode_mk: $('#subject').val(),
                    },
                    function(result) {
                        var arr = JSON.parse(result);
                        if(arr[0]['status_praktikum'] == 1){
                            // alert('masuk status praktikum');
                            $("#radiopraktikum").prop("disabled", false);
                        }
                        if(arr[0]['status_responsi'] == 1){
                            // alert("masuk status responsi");
                            $("#radioresponsi").prop("disabled", false);
                        }
                        
                    });
                }
            });
        });
        
    });

    function add($record = null){
        // alert("WOI");

        var pil1_berhalangan = '';
        var pil2_berhalangan = '';
        var pil3_berhalangan = '';

        var textpil1 = '';
        var textpil2 = '';
        var textpil3 = '';


        if($record != null){ //table dari DB, sudah validasi
            // alert("terpilih : " + $record['terpilih']);
            // alert('pil1berhalangan: ' + $record['pil1_berhalangan']);
            //kalo data null
            if($record['kelas_paralel1'] == null){textpil1 = "";}  else{ textpil1 = $record['kelas_paralel1'] + ' | ' + $record['hari1'] + ' ' + $record['jam1'];}
            if($record['kelas_paralel2'] == null){textpil2 = "";} else{ textpil2 = $record['kelas_paralel2'] + ' | ' + $record['hari2'] + ' ' + $record['jam2'] }
            if($record['kelas_paralel3'] == null){textpil3 = "";} else{ textpil3 = $record['kelas_paralel3'] + ' | ' + $record['hari3'] + ' ' + $record['jam3']}

            var textterpilih = '';
            if($record['kelas_paralelterpilih'] != null){
                textterpilih = $record['kelas_paralelterpilih'] + ' | '+ $record['hariterpilih'] + ' '+ $record['jamterpilih'];
            }
            data = {
                "id": data_jadwal.length+1,
                "NRP" : $record['NRP'],
                "kode_mk": $record['kode_mk'],
                "subject": $record['kode_mk'] + ' - ' + $record['nama_subject'],
                "tipe": $record['tipe'],
                "pil1": $record['pil1'],
                "pil1_berhalangan": $record['pil1_berhalangan'],
                "pil1_text": textpil1,
                "pil2": $record['pil2'],
                "pil2_berhalangan": $record['pil2_berhalangan'],
                "pil2_text": textpil2,
                "pil3": $record['pil3'],
                "pil3_berhalangan": $record['pil3_berhalangan'],
                "pil3_text": textpil3,
                "terpilih": textterpilih
            };

            data_jadwal.push(data);
            
            // alert("data_jadwal : " + JSON.stringify(data_jadwal));

            if(usertype == "admin"){ //|| usertype == 'asisten_tetap'
                view();
            }
            else if(usertype == "mahasiswa" || usertype == "asisten_dosen" || usertype == 'asisten_tetap'){
                // alert("masuk"); 
                // view("pendaftaranbuka");
                if(bukapendaftaran == "buka"){
                    // alert("masukkkk");
                    view();
                }
                else{
                    view("pendaftarantutup");
                }
            }
            
        }
        else{ //add manual , belum validasi
            var index = -1;
        
            for(var i = 0; i < data_jadwal.length; i++){ //ngecek data kalau sebelumya sdh add data tersebut maka auto update
                if($('#subject option:selected').text() == data_jadwal[i]['subject'] && $("input[name='tipe']:checked").val() == data_jadwal[i]['tipe']){
                    index = i;
                }
            }
            
            textpil1 = (($('#pilihan1 option:selected').text()).split(' ('))[0];
            textpil2 = (($('#pilihan2 option:selected').text()).split(' ('))[0];
            textpil3 = (($('#pilihan3 option:selected').text()).split(' ('))[0];

            
            if($('#pilihan1 option:selected').text() == '-- Pilih Kelas --'){textpil1 = "";}
            if($('#pilihan2 option:selected').text() == '-- Pilih Kelas --'){textpil2 = "";}
            if($('#pilihan3 option:selected').text() == '-- Pilih Kelas --'){textpil3 = "";}
        
            $.post(baseurl + "ambil_praktikum/getnabrak", {
                nrp: $('#mahasiswa').val(),
                idkelasprak: $('#pilihan1').val()
            },
            function(result) {
                // alert("pil1 : " + result);
                pil1_berhalangan = result;

                $.post(baseurl + "ambil_praktikum/getnabrak", {
                    nrp: $('#mahasiswa').val(),
                    idkelasprak: $('#pilihan2').val()
                },
                function(result) {
                    pil2_berhalangan = result;
                    
                    $.post(baseurl + "ambil_praktikum/getnabrak", {
                        nrp: $('#mahasiswa').val(),
                        idkelasprak: $('#pilihan3').val()
                    },
                    function(result) {
                        pil3_berhalangan = result;

                        data = {
                            // "kode_mk": $('#subject').val(),
                            "id": data_jadwal.length+1,
                            "NRP": $('#mahasiswa').val(),
                            "kode_mk": $('#subject option:selected').val(),
                            "subject": $('#subject option:selected').text(),
                            "tipe": $("input[name='tipe']:checked").val(),
                            "pil1": $('#pilihan1').val(),
                            "pil1_berhalangan": pil1_berhalangan,
                            "pil1_text": textpil1,
                            "pil2": $('#pilihan2').val(),
                            "pil2_berhalangan": pil2_berhalangan,
                            "pil2_text": textpil2,
                            "pil3": $('#pilihan3').val(),
                            "pil3_berhalangan": pil3_berhalangan,
                            "pil3_text": textpil3,
                            "terpilih": ""
                        };

                        if(index == -1){
                            data_jadwal.push(data);
                        }
                        else{
                            data_jadwal[index] = data;
                        }

                        // kosongkan isi komponen
                        var kal = '<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
                        $('#pilihan1').html(kal);
                        $('#pilihan2').html(kal);
                        $('#pilihan3').html(kal);

                        $("#subject").prop("disabled", false);
                        $('#subject').html(kalsubject);

                        $("#radiopraktikum").prop("checked", true);
                        view();

                    });
                });
            });

        }
    }

    function getambilpraktikum(){
        
    }

    function validasi(){
        // console.log(data_jadwal);
        $.post(baseurl + "ambil_praktikum/add", {
            data: data_jadwal,
        },
        function(result) {
            alert(result);
            console.log(result);
            if(result == 'success'){

                // $('#btnvalidasi').css('display', 'none');
                // $('#box-add').css('display', 'none');

                view("fromdb");
            }
            else{
                alert("Error! " + result);
            }
        });
    }

    function updates($index){
        holdindex = $index;
        $('#subject').val((data_jadwal[$index]['subject']).split(' - ')[0]).trigger('change');
        $("#subject").prop("disabled", true);

        if(data_jadwal[$index]['tipe'] == "praktikum"){
            $("#radiopraktikum").prop("checked", true);
        }
        else if(data_jadwal[$index]['tipe'] == "responsi"){
            $("#radioresponsi").prop("checked", true);
        }

        // $.post(baseurl + "kelas_praktikum/getbysubject", {
        //     kode_mk: $('#subject').val(),
        //     tipe: $("input[name='tipe']:checked").val(),
        // },
        // function(result) {
        //     // alert("masuk");
        //     var arr = JSON.parse(result);
        //     // var subject = []
        //     var kal1 = '';
        //     var kal2 = '';
        //     var kal3 = '';
        //     kal1 +='<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
        //     kal2 +='<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
        //     kal3 +='<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>';
        //     for(var i=0; i<arr.length; i++){
        //         if(data_jadwal[$index]['pil1'] == arr[i]['id']){
        //             kal1 +='<option checked value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //         else{
        //             kal1 +='<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //         if(data_jadwal[$index]['pil2'] == arr[i]['id']){
        //             kal2 +='<option checked value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //         else{
        //             kal2 +='<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //         if(data_jadwal[$index]['pil3'] == arr[i]['id']){
        //             kal3 +='<option checked value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //         else{
        //             kal3 +='<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>';
        //         }
        //     }
        //     $('#pilihan1').html(kal1);
        //     $('#pilihan2').html(kal2);
        //     $('#pilihan3').html(kal3);
        // });
        
    }

    function deleterecord($index){
        data_jadwal.splice($index, 1);
        view();
    }

    function view($fromdb = null){
        var kal = "";

        if($fromdb != null){
            if(usertype == "mahasiswa" || usertype == "asisten_dosen" || usertype == "asisten_tetap"){ //untuk mahasiswa yg sudah validasi pada periode yg telah dibuka
                $('#btnvalidasi').css('display', 'none');
                if(data_jadwal.length > 0){
                    $('#box-add').css('display', 'none');
                }
            }
        }
        // alert(usertype + " " + bukapendaftaran);
        // if(usertype == "asisten_tetap" && bukapendaftaran == "tutup"){
        //     $('#btnvalidasi').css('display', 'none');
        // }
        for(var i = 0; i < data_jadwal.length; i++){
            kal += '<tr>';
            
            // alert(data_jadwal[i]['subject']);
            kal += '<td>'+ data_jadwal[i]['subject'] +'</td>';
            kal += '<td>'+ data_jadwal[i]['tipe'] +'</td>';
            // alert("jadwal berhalangan " + data_jadwal[i]['pil1_berhalangan']);
            if(data_jadwal[i]['pil1_berhalangan'] == 'yes'){
                // alert("masuk IFF");
                kal += '<td class="bg-yellow">'+ data_jadwal[i]['pil1_text'] + '</td>';
            }
            else{
                kal += '<td>'+ data_jadwal[i]['pil1_text'] + '</td>';
            }
            if(data_jadwal[i]['pil2_berhalangan'] == 'yes'){
                kal += '<td class="bg-yellow">'+ data_jadwal[i]['pil2_text'] + '</td>';
            }
            else{
                kal += '<td>'+ data_jadwal[i]['pil2_text'] + '</td>';
            }
            if(data_jadwal[i]['pil3_berhalangan'] == 'yes'){
                kal += '<td class="bg-yellow">'+ data_jadwal[i]['pil3_text'] + '</td>';
            }
            else{
                kal += '<td>'+ data_jadwal[i]['pil3_text'] + '</td>';
            }
            if(data_jadwal[i]['terpilih'] == ''){
                kal += '<td>&nbsp</td>';
            }
            else{
                kal += '<td>'+ data_jadwal[i]['terpilih'] + '</td>';
            }
            kal += '<td>';
                if($fromdb != null){
                    if(usertype == "mahasiswa" || usertype == "asisten_dosen"){
                        if(data_jadwal[i]['terpilih'] != ""){
                            kal += '<button disabled type="button" class="btn btn-sm btn-info btn-action"><i class="fa fa-pencil"></i> Edit</button>';
                            kal += '<button disabled type="button" class="btn btn-sm btn-danger btn-action"><i class="fa fa-trash-o"></i> Delete</button>';
                        }
                    }
                }
                else{
                    if(usertype == "mahasiswa" || usertype == "asisten_dosen"){
                        if(data_jadwal[i]['terpilih'] != ""){
                            kal += '<button disabled type="button" class="btn btn-sm btn-info btn-action"><i class="fa fa-pencil"></i> Edit</button>';
                            kal += '<button disabled type="button" class="btn btn-sm btn-danger btn-action"><i class="fa fa-trash-o"></i> Delete</button>';
                        }
                        else{
                            kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ i +'")><i class="fa fa-pencil"></i> Edit</button>';
                            kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=deleterecord("'+ i +'")><i class="fa fa-trash-o"></i> Delete</button>';
                        }
                    }
                    else{
                        kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ i +'")><i class="fa fa-pencil"></i> Edit</button>';
                        kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=deleterecord("'+ i +'")><i class="fa fa-trash-o"></i> Delete</button>';
                    }
                    
                }
            kal += '</td>';
            kal += '</tr>';
        }
        
        if(baru > 0){
            $("#datatable-ambil_praktikum").DataTable().destroy();
        }

        $("#data_ambil_praktikum").html(kal);
        baru++;

        $("#datatable-ambil_praktikum").DataTable({
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