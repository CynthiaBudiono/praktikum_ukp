<style>
    .select2-selection__arrow b{
        display:none !important;
    }
    .pop-over-style{
        background-color: #fef7ea;
        border: 1px solid #ed9500;
    }

    .pop-over-style i{
        padding: 6px;
        color: white;
        background-color: #ee9500;
        border-radius: 8px;
        box-shadow: 2px 2px #fceacd;
        margin-right: 10px;
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

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 id="action_title">Add</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down" id='collapse-add'></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="content-add" style="display: none;">
                    <br />
                    <div class="alert alert-dismissible pop-over-style" role="alert" id="div_alert" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        <strong>Warning.</strong> <span id="error_msg'">Data ada yang kosong!</span>
                    </div>
                    <form class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Tipe</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" id="tipe" onchange="getdetail()">
                                    <option value="">--Pilih Tipe Asisten--</option>
                                    <option value="dosen">Asisten Dosen</option>
                                    <option value="tetap">Asisten Tetap</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Matakuliah</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control select2" name ="ddsubject" id="ddsubject" tabindex="-1" style="width:100%;">
                                    <option value="" disabled selected> -- Pilih Matakuliah Penanggung Jawab -- </option>
                                    <?php if(isset($ddsubject)) : ?>
                                        <?php if(is_array($ddsubject)) : ?>
                                            <?php foreach($ddsubject as $key) : ?>
                                                <option value="<?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?>"> <?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> <?= (isset($key['nama'])) ? $key['nama'] : '' ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">NRP</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control select2" name="mahasiswa" id="mahasiswa" style="width:100%;">
                                    <option value="" disabled selected>-- Search Mahasiswa yang telah mendaftar --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 "></label>
                            <div class="col-md-9 col-sm-9">
                                <div class="container border" id="detail_calon">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Tanggal Diterima</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" required>
                            </div>
                        </div>

                        <div class="form-group row" id="divstatus">
                            <label class="control-label col-md-3 col-sm-3 ">Status</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                    <label>
                                        <input type="checkbox" class="toggle-switch" name="status" id="status" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9">
                                <!-- <button type="button" class="btn btn-danger">Cancel</button> -->
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="button" class="btn btn-success" id="btnsubmit" onclick="addupdate()"><a href="#data_table" style="color: white;">Submit</a></button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /x_content -->
            </div> <!-- /x_panel -->
        </div> <!-- /col-md -->

        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
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
                    <!-- <a class="btn btn-sm bg-green" href="<?php echo base_url("asisten/adds"); ?>">Tambah</a> -->
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-asisten" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>id</th>
                                        <th>Mahasiswa</th>
                                        <th>tipe</th>
                                        <th>status</th>
                                        <th>Tanggal Diterima</th>
                                        <!-- <th>periode pendaftaran</th> -->
                                    </tr>
                                </thead>
                                <tbody id="data_asisten"></tbody>
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
    var baru = 0;
    // view();
    $(document).ready(function() {	
        $('#ddsubject').select2();
        $('#mahasiswa').select2();
        view();

        $('#ddsubject').prop('disabled', true);
        
        $('#tipe').on("change", function() {
            // alert($("#tipe").val());
            // alert('mahasiswa val : ' + $('#mahasiswa').val());
            if($('#tipe').val() == 'dosen'){
                $('#ddsubject').prop('disabled', true);
            }
            else if($('#tipe').val() == 'tetap'){
                $('#ddsubject').prop('disabled', false);
            }
        });

        $.post(baseurl + "calon_asisten_dosen/getdaftarasdos", {},
        function(result) {
            var arr = JSON.parse(result);
            for(var i=0; i<arr.length; i++){
                $('#mahasiswa').append('<option value="'+ arr[i]['NRP'] +'">'+ arr[i]['NRP'] + ' - ' + arr[i]['nama'] +'</option>');
            }
        });

        $('#mahasiswa').on("change", function() {
            // alert($("#tipe").val());
            // alert('mahasiswa val : ' + $('#mahasiswa').val());
            $.post(baseurl + "calon_asisten_dosen/getbynrp", {
                nrp: $('#mahasiswa').val(),
            },
            function(result) {
                // alert("result onchange mhs : "+ result);
                var arr = JSON.parse(result);

                // alert(arr[0]['upload_berkas']);
                var kal = '';
                kal +='Berkas :  Open a berkas file, <a target="_blank" href="<?= base_url() ?>/assets/berkas/' + arr[0]['upload_berkas'] + '">' + arr[0]['upload_berkas'] + '</a> <br>';
                kal +='Gender :  ' + arr[0]['gender'] + '<br>';
                kal +='Alamat :  ' + arr[0]['alamat'] + '<br>';
                kal +='NO HP :  ' + arr[0]['no_hp'] + '<br>';
                kal +='LINE ID :  ' + arr[0]['line_id'] + '<br>';
                kal +='Motivasi :  ' + arr[0]['motivasi'] + '<br>';
                kal +='Komitmen :  ' + arr[0]['komitmen'] + '<br>';
                kal +='Kelebihan :  ' + arr[0]['kelebihan'] + '<br>';
                kal +='Kekurangan :  ' + arr[0]['kekurangan'] + '<br>';
                kal +='Pengalaman :  ' + arr[0]['pengalaman'] + '<br>';


                $("#detail_calon").html(kal);
            });
        });
    });


    function addupdate(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#id').val());
        // alert(baseurl + "laboratorium/" + $('#mode').val());
        if($('#mahasiswa').val() == "" || $('#tipe').val() == "" || $('#tanggal_diterima').val() == ""){
            $('#div_alert').css('display', 'block');
        }
        else{
            $.post(baseurl + "asisten/" + $('#mode').val(), {
                id: $('#id').val(),
                nrp: $('#mahasiswa').val(),
                kode_mk: $('#ddsubject').val(),
                tipe: $('#tipe').val(),
                tanggal_diterima: $('#tanggal_diterima').val(),
                status: $('#status').is(':checked'),
            },
            function(result) {
                alert(result);
                if(result == 'success'){
                    view();
                    
                    $('#id').val("");
                    $('#mahasiswa').val("").trigger('change');
                    $('#ddsubject').val("").trigger('change');
                    $('#tipe').val("");
                    $('#tanggal_diterima').val("");
                    $("#status").prop("checked", false);
                    $('#div_alert').css('display', 'none');

                    if($('#mode').val() == 'update'){
                        $('#action_title').html("Add");
                        $('#mode').val('add');
                    }
                    $("#detail_calon").html("");
                }
                else{
                    // alert(result);
                }
            });
        }
    }

    function getdetail(){
        // alert("masuk");

        // alert($("#tipe").val());

        // $.post(baseurl + "asisten/getdetail", {
        //     nrp: $('#nrp').val(),
        // },
        // function(result) {
        //      // if(asisten_dosen) -> getvalue()

        //     // if asisten tetap -> get value angkatan
        // });
       
    }

    function updates($id){
        // alert($kodelab)
        $.post(baseurl + "asisten/updates", {
            id : $id,
        },function(result){
            // alert(result);

            var arr = JSON.parse(result);
            
            // alert(arr['detil'][0]['NRP']);
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            // $('#kodelab').prop("readonly", true);
            // $('#kodelab').val(arr['detil'][0]['kode_lab']);
            $('#id').val(arr['detil'][0]['id']);

            $('#mahasiswa').val(arr['detil'][0]['NRP']).trigger('change');
            $('#ddsubject').val(arr['detil'][0]['kode_mk']).trigger('change');
            $('#tipe').val(arr['detil'][0]['tipe']);
            $('#tanggal_diterima').val(arr['detil'][0]['tanggal_diterima']);

            if(arr['detil'][0]['status'] == 1){
                $("#status").prop("checked", true);
            }
            else{
                $("#status").prop("checked", false);
            }

            $('#mode').val('update');
        });
    }

    function view(){
        $.post(baseurl + "asisten/getallopen", {

        },
        function(result) {
            // alert(result);
            var arr = JSON.parse(result);
            var kal = "";
            
            for(var i = 0; i < arr.length; i++){
                kal += '<tr>';
                kal += '<td>';
                    kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                    // kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['id'] +'</td>';
                kal += '<td>'+ arr[i]['NRP'] + ' - ' + arr[i]['nama_mahasiswa'] +'</td>';
                kal += '<td>'+ arr[i]['tipe'] +'</td>';
                kal += '<td>';
                    kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['tanggal_diterima'] +'</td>';
                // kal += '<td>'
                //     if(arr[i]['semester_pendaftaran_asdos'] == 1){
                //         kal += 'Ganjil ';
                //     }
                //     else {
                //         kal += 'Genap ';
                //     }
                //     kal += arr[i]['tahun_ajaran_pendaftaran_asdos'];
                // kal+= '</td>';
                kal += '</tr>';
            }
            
            
            if(baru > 0){
                $('#datatable-asisten').DataTable().destroy();
            }
            $("#data_asisten").html(kal);
            baru++;

            $("#datatable-asisten").DataTable({
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
            
        });
    }

</script>


