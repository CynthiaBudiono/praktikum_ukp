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

                        <input type="hidden" class="form-control" name="id" id="id" required value="<?= (isset($detil[0]['id'])) ? $detil[0]['id'] : '' ?>">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Tipe</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" id="selecttipeasisten" onchange="getdetail()">
                                    <option value="">--Choose option--</option>
                                    <option value="asisten_dosen">Asisten Dosen</option>
                                    <option value="asisten_tetap">Asisten Tetap</option>
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
                                        <input type="checkbox" name="status" id="status" class="toggle-switch" checked/>
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
    // view();
    $(document).ready(function() {	

        $('#mahasiswa').select2();
        view();

        $.post(baseurl + "mahasiswa/getallactive", {},
        function(result) {
            var arr = JSON.parse(result);
            for(var i=0; i<arr.length; i++){
                $('#mahasiswa').append('<option value="'+ arr[i]['NRP'] +'">'+ arr[i]['NRP'] + ' - ' + arr[i]['nama'] +'</option>');
            }
        });

        $('#mahasiswa').on("change", function() {
            alert($("#selecttipeasisten").val());
            alert('mahasiswa val : ' + $('#mahasiswa').val());
            $.post(baseurl + "asisten/getdetail", {
                nrp: $('#mahasiswa').val(),
            },
            function(result) {
                alert("result onchange mhs : "+ result);

                // if(asisten_dosen) -> getvalue()

                // if asisten tetap -> get value angkatan
            });
        });
    });


    function getdetail(){
        alert("masuk");

        // alert($("#selecttipeasisten").val());

        // $.post(baseurl + "asisten/getdetail", {
        //     nrp: $('#nrp').val(),
        // },
        // function(result) {
        //      // if(asisten_dosen) -> getvalue()

        //     // if asisten tetap -> get value angkatan
        // });
       
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
            
            $("#data_asisten").html(kal);
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


