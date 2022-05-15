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
                        <li><a class="collapse-link"><i class="fa fa-chevron-down" id='collapse-add'></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="content-add" style="display: none;">
                    <br />
                    <form class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Tipe</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" id="tipe" onchange="getdetail()">
                                    <option value="">--Choose option--</option>
                                    <option value="dosen">Asisten Dosen</option>
                                    <option value="tetap">Asisten Tetap</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">NRP</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control select2" name="mahasiswa" id="mahasiswa" style="width:100%;">
                                    <option value="" disabled selected>-- Search Mahasiswa --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 "></label>
                            <div class="col-md-9 col-sm-9">
                                <div class="container border">
                                nama
                                id_pendaftaran asisten
                                data lengkap
                                daftar tanggal brp
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
                                        <th>periode pendaftaran</th>
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

        $('#mahasiswa').select2();
        view();

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
            $.post(baseurl + "asisten/getdetail", {
                nrp: $('#mahasiswa').val(),
            },
            function(result) {
                // alert("result onchange mhs : "+ result);

                // if(asisten_dosen) -> getvalue()

                // if asisten tetap -> get value angkatan
            });
        });
    });


    function addupdate(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#id').val());
        // alert(baseurl + "laboratorium/" + $('#mode').val());
        $.post(baseurl + "asisten/" + $('#mode').val(), {
            id: $('#id').val(),
            nrp: $('#mahasiswa').val(),
            tipe: $('#tipe').val(),
            tanggal_diterima: $('#tanggal_diterima').val(),
            status: $('#status').is(':checked'),
        },
        function(result) {
            alert("resulttt: " + result);
            if(result == 'success'){
                view();
                
                $('#id').val("");
                $('#mahasiswa').val("").trigger('change');
                $('#tipe').val("");
                $('#tanggal_diterima').val("");
                $("#status").prop("checked", false);

                if($('#mode').val() == 'update'){
                    $('#action_title').html("Add");
                    $('#mode').val('add');
                }
            }
            else{
                // alert(result);
            }
        });
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
            alert(result);

            var arr = JSON.parse(result);
            
            alert(arr['detil'][0]['NRP']);
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            // $('#kodelab').prop("readonly", true);
            // $('#kodelab').val(arr['detil'][0]['kode_lab']);
            $('#id').val(arr['detil'][0]['id']);

            $('#mahasiswa').val(arr['detil'][0]['NRP']).trigger('change');
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
                    kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['id'] +'</td>';
                kal += '<td>'+ arr[i]['NRP'] + ' - ' + arr[i]['nama_mahasiswa'] +'</td>';
                kal += '<td>'+ arr[i]['tipe'] +'</td>';
                kal += '<td>';
                    kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['tanggal_diterima'] +'</td>';
                kal += '<td>'
                    if(arr[i]['semester_pendaftaran_asdos'] == 1){
                        kal += 'Ganjil ';
                    }
                    else {
                        kal += 'Genap ';
                    }
                    kal += arr[i]['tahun_ajaran_pendaftaran_asdos'];
                kal+= '</td>';
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


