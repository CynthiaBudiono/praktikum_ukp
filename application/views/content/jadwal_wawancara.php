<style>
    
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

        <div class="col-md-12 col-sm-12" id="addupdatearea">
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
                        <form action="<?php if(isset($detil[0]['id'])) if($detil[0]['id'] != "" || $detil[0]['id'] != NULL) echo (base_url('jadwal_wawancara/update')); else echo (base_url('jadwal_wawancara/add')); ?>" method="post" class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen Wawancara</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control select2" name="dosen" id="dosen" style="width:100%;">
                                        <option value="" disabled selected>Search dosen</option>
                                    </select>
                                    <div id="dosen_area" style="display:none;">
                                        tabel jadwal dosennnnnnnnn dan info lainnya
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Calon Asisten Dosen</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control select2" name="calon" id="calon" style="width:100%;">
                                        <option value="" disabled selected>Search calon</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Tanggal</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="datetime-local" class="form-control" id="tanggal_wawancara" name="tanggal_wawancara" required>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Status</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="">
                                        <label>
                                            <input type="checkbox" class="toggle-switch" name="status" id="status" checked>
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Keterangan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                <textarea id="keterangan" name="keterangan" rows="5"></textarea>
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
                </div>
            <!-- </div> -->
        </div>

        <!-- VIEW NOW-->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title" id="data_table_now">
                    <h2>Data period now</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-jadwal_wawancara_now" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Calon Asisten Dosen</th>
                                        <th>Pewawancara (Dosen)</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="data_jadwal_wawancara_now">
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VIEW -->
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title" id="data_table">
                    <h2>Data</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <!-- <div>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("jadwal_wawancara/adds"); ?>">Tambah</a>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-jadwal_wawancara" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Calon Asisten Dosen</th>
                                        <th>Pewawancara (Dosen)</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="data_jadwal_wawancara">
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
    // view();
    $(document).ready(function() {
        $('#keterangan').trumbowyg();	
        // alert("masukkkkkkkk ready");	
        view()
        viewperiodnow()
        $('#dosen').select2();
        $('#calon').select2();

        $.post(baseurl + "dosen/getdosen", {},
        function(result) {
            var arr = JSON.parse(result);
            var dosen = []
            for(var i=0; i<arr.length; i++){
                $('#dosen').append('<option value="'+ arr[i]['NIP'] +'">'+ arr[i]['nama'] +'</option>');
            }
            // Selector input yang akan menampilkan autocomplete.
            // $( '#dosen').autocomplete({
            //     lookup: dosen,
            //     onSelect: function (suggestion){
            //         var nip = ($( '#dosen').val()).split(" - ");
            //         // get jadwal dosen, jadwal berhalangan
            //         alert(suggestion.data);
            //         $('#id_dosen').val(nip[0]);
            //         $('#dosen_area').css('display', 'block');

            //     }
            // });
        });

        $.post(baseurl + "calon_asisten_dosen/getbelumketerima", {},
        function(result) {
            // alert(result);
            if(result != ""){
                var arr = JSON.parse(result);
                var calon = []
                for(var i=0; i<arr.length; i++){
                    $('#calon').append('<option value="'+ arr[i]['id'] +'">'+ arr[i]['nama'] +'</option>');
                }
                // Selector input yang akan menampilkan autocomplete.
                // $( '#calon_asdos').autocomplete({
                //     lookup: calon,
                //     onSelect: function (suggestion){
                //         $('#id_calon').val(suggestion.data);
                //         // var nrp = ($( '#calon_asdos').val()).split(" - ");
                //         // // get jadwal dosen, jadwal berhalangan
                //         // // alert(nrp[0]);

                //         // //GET ID CALON
                //         // $.post(baseurl + "calon_asisten_dosen/getidbyactiveperiod", {
                //         //     nrp : nrp[0],
                //         // },
                //         // function(result2) {
                //         //     var arr2 = JSON.parse(result2);
                //         //     // alert(arr2[0]['id']);
                            
                //         // });
                        
                //         // $('#calon_area').css('display', 'block');

                //     }
                // });
            }
            else{
                $('#addupdatearea').css('display', 'none');
            }
        });
    });

    function addupdate(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#kodelab').val());
        // alert(baseurl + "jadwal_wawancara/" + $('#mode').val());
        $.post(baseurl + "jadwal_wawancara/" + $('#mode').val(), {
            id_dosen: $('#dosen').val(),
            id_calon: $('#calon').val(),
            tanggal: $('#tanggal_wawancara').val(),
            keterangan: $('#keterangan').val(),
        },
        function(result) {
            // alert(result);
            if(result == 'success'){
                view()
                
                $('#dosen').val("").trigger('change');
                $('#calon').val("").trigger('change');
                $('#tanggal_wawancara').val("");
                
                $('#keterangan').trumbowyg('html', "");
            
                // $("#status").prop("checked", false);

                if($('#mode').val() == 'update'){
                    $('#action_title').html("Add");
                    $('#mode').val('add');
                }
            }
            else{
                alert(result);
            }
        });
    }

    function adds(){
        $('#content-add').css('display', 'block');
            
        // make scroll top
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;

        $('#action_title').html('Add jadwal wawancara');
        $('#mode').val('add');
    }

    function updates($id){
        // alert($kodelab)
        $.post(baseurl + "jadwal_wawancara/updates", {
            id : $id,
        },function(result){
            var arr = JSON.parse(result);
            
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            // alert("CALONN: " + arr['detil'][0]['id_calon_asisten_dosen']);
            $('#dosen').val(arr['detil'][0]['NIP']).trigger('change');
            $('#calon').val(arr['detil'][0]['id_calon_asisten_dosen']).trigger('change');
            // $('#tanggal_wawancara').val(arr['detil'][0]['tanggal']);
            $('#tanggal_wawancara').val(arr['detil'][0]['tanggal'].replace(" ", "T"));
            // $('#keterangan').val(arr['detil'][0]['keterangan']);
            $('#keterangan').trumbowyg('html', arr['detil'][0]['keterangan']);

            // if(arr['detil'][0]['status'] == 1){
            //     $("#status").prop("checked", true);
            // }

            $('#mode').val('update');
        });
    }

    function viewperiodnow(){
        $.post(baseurl + "jadwal_wawancara/getperiodnow", {

        },
        function(result) {
            // alert(result);
            if(result != null){
                var arr = JSON.parse(result);
                var kal = "";
                
                for(var i = 0; i < arr.length; i++){
                    kal += '<tr>';
                    kal += '<td>';
                        kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                        kal += '<button type="button" class="btn btn-sm bg-green btn-action" onclick=confirm("'+ arr[i]['id'] +'")><i class="fa fa-check"></i> Lulus</button>';
                        // kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                    kal += '</td>';
                    kal += '<td>'+ arr[i]['nama_mahasiswa'] +'</td>';
                    kal += '<td>'+ arr[i]['nama_dosen'] +'</td>';
                    kal += '<td>'+ arr[i]['tanggal'] +'</td>';
                    // kal += '<td>';
                    //     kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                    // kal += '</td>';
                    kal += '</tr>';
                }
                
                $("#data_jadwal_wawancara_now").html(kal);
                $("#datatable-jadwal_wawancara_now").DataTable({
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
            
        });
    }

    function view(){
        $.post(baseurl + "jadwal_wawancara/get", {

        },
		function(result) {
            // alert(result);
            if(result != null){

                var arr = JSON.parse(result);
                var kal = "";
                
                for(var i = 0; i < arr.length; i++){
                    kal += '<tr>';
                    kal += '<td>';
                        // kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                        // kal += '<button type="button" class="btn btn-sm bg-green btn-action" onclick=confirm("'+ arr[i]['id'] +'")><i class="fa fa-check"></i> Lulus</button>';
                        // kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                    kal += '</td>';
                    kal += '<td>'+ arr[i]['nama_mahasiswa'] +'</td>';
                    kal += '<td>'+ arr[i]['nama_dosen'] +'</td>';
                    kal += '<td>'+ arr[i]['tanggal'] +'</td>';
                    // kal += '<td>';
                    //     kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                    // kal += '</td>';
                    kal += '</tr>';
                }
                
                $("#data_jadwal_wawancara").html(kal);
                $("#datatable-jadwal_wawancara").DataTable({
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
        });
    }
</script>