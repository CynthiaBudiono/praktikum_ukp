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
        border-color: #82b19b;
        background: #82b19b;
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

        <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="action_title">Add</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="content-add">
                        <br />
                        <!-- <input type="hidden" class="form-control" name="mode" id="mode" value="add"> -->

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Mahasiswa</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="subject_input form-control select2" name="mahasiswa" id="mahasiswa" style="width:100%;">
                                        <option value="" disabled selected>-- Search Mahasiswa --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 "></label>
                                <div class="col-md-9 col-sm-9">
                                    <div id="detail_mahasiswa"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Mata Kuliah</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="subject_input form-control select2" name="subject" id="subject" style="width:100%;">
                                        <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                                    </select>
                                </div>
                            </div>

                            <div id="content_tipe" style="display: none;">
                                <div class="form-group row" id="content_tipe" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 ">Tipe</label>
                                    <div class="col-md-9 col-sm-9 ">
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
                    </div> <!-- /x_content -->
                </div>
            <!-- </div> -->
        </div>

        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title" id="data_table">
                    <h2>Kelas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><button type="button" class="btn bg-green" id="btnvalidasi" onclick="validasi()">Validasi</button></li>
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
                                        <th>Action</th>
                                        <!-- <th>Kode MK</th> -->
                                        <th>Mata Kuliah</th>
                                        <th>Tipe</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th>Pilihan 3</th>
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

    var data_jadwal = [];
    var baru = 0;

    // view();
    $(document).ready(function() {	
        // alert("masukkkkkkkk ready");
        $('#mahasiswa').select2();
        $('#subject').select2();
        $('#pilihan1').select2();
        $('#pilihan2').select2();
        $('#pilihan3').select2();
        view();

        $.post(baseurl + "mahasiswa/getpesertapraktikum", {},
        function(result) {
            var arr = JSON.parse(result);
            for(var i=0; i<arr.length; i++){
                $('#mahasiswa').append('<option value="'+ arr[i]['NRP'] +'">'+ arr[i]['NRP'] + ' - ' + arr[i]['nama'] +'</option>');
            }
        });

        $('#mahasiswa').on("change", function() {
            $('#detail_mahasiswa').html("Matakuliah yang diambil " + $('#mahasiswa option:selected').text() + " :");
            $.post(baseurl + "mahasiswa_matakuliah/getsubjectbyNRP", {
                nrp: $('#mahasiswa').val(),
            },
            function(result) {
                var arr = JSON.parse(result);
                var kal = '';
                kal +='<ul>';
                for(var i=0; i<arr.length; i++){
                    kal += '<li>'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</li>';
                }
                kal +='</ul>';
                $('#detail_mahasiswa').append(kal);
            });
        });

        $.post(baseurl + "subject/gethavepraktikum", {},
        function(result) {
            var arr = JSON.parse(result);
            // var subject = []
            for(var i=0; i<arr.length; i++){
                $('#subject').append('<option value="'+ arr[i]['kode_mk'] +'">'+ arr[i]['kode_mk'] + ' - ' + arr[i]['nama'] +'</option>');
                
                // alert("status_responsi" + arr[i]['status_responsi']);
            }
        });

        $('.subject_input').on("change", function() {

            // if(arr[i]['status_responsi'] == 1){
            //     $('#content_tipe').css('display', 'block');
            // }

            // $('#pilihan1').remove();
            // $('#pilihan2').remove();
            // $('#pilihan3').remove();

            // $('#pilihan1').append('<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>');
            // $('#pilihan2').append('<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>');
            // $('#pilihan3').append('<option value="placeholder_text" disabled selected>-- Pilih Kelas --</option>');

            // $('#pilihan1 option[value="placeholder_text"]').text('-- Pilih Kelas --');
            // $('#pilihan2 option[value="placeholder_text"]').text('-- Pilih Kelas --');
            // $('#pilihan3 option[value="placeholder_text"]').text('-- Pilih Kelas --');
            // alert("tipe "+$("input[name='tipe']:checked").val());
                
            $.post(baseurl + "kelas_praktikum/getbysubject", {
                kode_mk: $('#subject').val(),
                tipe: $("input[name='tipe']:checked").val(),
            },
            function(result) {
                // alert("masuk");
                var arr = JSON.parse(result);
                // var subject = []
                for(var i=0; i<arr.length; i++){
                    $('#pilihan1').append('<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>');
                    $('#pilihan2').append('<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>');
                    $('#pilihan3').append('<option value="'+ arr[i]['id'] +'">'+ arr[i]['kelas_paralel'] + ' | ' + arr[i]['hari'] + ' ' + arr[i]['jam'] + ' (' + arr[i]['terisi'] + '/' + arr[i]['quota_max'] + ')</option>');
                }
            });
        });
        
    });

    function add(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#kodelab').val());
        // alert(baseurl + "ambil_praktikum/" + $('#mode').val());
        
       
        data = {
            // "kode_mk": $('#subject').val(),
            "id": data_jadwal.length+1,
            "subject": $('#subject option:selected').text(),
            "tipe": $("input[name='tipe']:checked").val(),
            "pil1": $('#pilihan1').val(),
            "pil1_text": (($('#pilihan1 option:selected').text()).split())[0],
            "pil2": $('#pilihan2').val(),
            "pil2_text": (($('#pilihan2 option:selected').text()).split())[0],
            "pil3": $('#pilihan3').val(),
            "pil3_text": (($('#pilihan3 option:selected').text()).split())[0],
        };
        data_jadwal.push(data);
        view();
    }

    function validasi(){
        $.post(baseurl + "ambil_praktikum/add", {
            data: data_jadwal,
        },
        function(result) {
            // alert(result);
            if(result == 'success'){
                view()
                
                $('#kodelab').val("");
                $('#nama').val("");
                $('#quota').val("");
                $("#status").prop("checked", false);

                if($('#mode').val() == 'update'){
                    $('#action_title').html("Add");
                    $('#kodelab').prop("readonly", false);
                    $('#mode').val('add');
                }


            }
            else{
                alert(result);
            }
        });
    }

    function updates($id){
        alert($id)
        // $.post(baseurl + "ambil_praktikum/updates", {
        //     nrp : $nrp,
        // },function(result){
        //     var arr = JSON.parse(result);
            
        //     $('#content-add').css('display', 'block');
            
        //     // make scroll top
        //     document.body.scrollTop = 0;
        //     document.documentElement.scrollTop = 0;

        //     $('#action_title').html(arr['title']);

        //     // $('#nama').val(arr['detil'][0]['nama']);

        //     // $('#quota').val(arr['detil'][0]['quota_max']);

        //     // if(arr['detil'][0]['status'] == 1){
        //     //     $("#status").prop("checked", true);
        //     // }

        //     $('#mode').val('update');
        // });
    }

    function view(){
        // $.post(baseurl + "ambil_praktikum/get", {

        // },
		// function(result) {
            // alert(result);
            // var arr = JSON.parse(result);
            var kal = "";

            // if(data_jadwal != []){
                // alert(data_jadwal);
                for(var i = 0; i < data_jadwal.length; i++){
                    kal += '<tr>';
                    kal += '<td>';
                        kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ data_jadwal[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                        kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ data_jadwal[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                    kal += '</td>';
                    kal += '<td>'+ data_jadwal[i]['subject'] +'</td>';
                    kal += '<td>'+ data_jadwal[i]['tipe'] +'</td>';
                    kal += '<td>'+ (data_jadwal[i]['pil1'] != null) ? data_jadwal[i]['pil1_text'] : "&nbsp" +'</td>';
                    kal += '<td>'+ data_jadwal[i]['pil2_text'] +'</td>';
                    kal += '<td>'+ data_jadwal[i]['pil3_text'] +'</td>';
                    kal += '</tr>';
                }
                
                $("#data_ambil_praktikum").html(kal);
            // }
            
            if(baru == 0){ //initialize datatable
                $("#datatable-ambil_praktikum").DataTable({
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
            baru++;
            
        // });
    }
</script>