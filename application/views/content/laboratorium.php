<style>
    
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
                            <li><a class="collapse-link"><i class="fa fa-chevron-down" id='collapse-add'></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="content-add" style="display: none;">
                        <br />
                        <form action="<?php if(isset($detil[0]['kode_lab'])) if($detil[0]['kode_lab'] != "" || $detil[0]['kode_lab'] != NULL) echo (base_url('laboratorium/update')); else echo (base_url('laboratorium/add')); ?>" method="post" class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Kode Lab</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="kodelab" id="kodelab" placeholder="ex. JK" required value="<?= (isset($detil[0]['kode_lab'])) ? $detil[0]['kode_lab'] : '' ?>" <?= (isset($detil[0]['kode_lab'])) ? 'readonly="readonly"' : '' ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="ex. Jaringan Komputer" required value="<?= (isset($detil[0]['nama'])) ? $detil[0]['nama'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Quota Maksimum</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" name="quota" id="quota" placeholder="quota max" min=1 required value="<?= (isset($detil[0]['quota_max'])) ? $detil[0]['quota_max'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Status</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="">
                                        <label>
                                            <input type="checkbox" name="status" id="status" class="js-switch"/>
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
                </div>
            <!-- </div> -->
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("laboratorium/adds"); ?>">Tambah</a>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-laboratorium" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Kode lab</th>
                                        <th>Nama</th>
                                        <th>Quota</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="data_laboratorium">
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
        // alert("masukkkkkkkk ready");	
        view()
    });

    function addupdate(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#kodelab').val());
        // alert(baseurl + "laboratorium/" + $('#mode').val());
        $.post(baseurl + "laboratorium/" + $('#mode').val(), {
            kodelab: $('#kodelab').val(),
            nama: $('#nama').val(),
            quota: $('#quota').val(),
            status: $('#status').is(':checked'),
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

    function adds(){
        $('#content-add').css('display', 'block');
            
        // make scroll top
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;

        $('#action_title').html('Add Laboratorium');
        $('#mode').val('add');
    }

    function updates($kodelab){
        // alert($kodelab)
        $.post(baseurl + "laboratorium/updates", {
            kode_lab : $kodelab,
        },function(result){
            var arr = JSON.parse(result);
            
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            $('#kodelab').prop("readonly", true);
            $('#kodelab').val(arr['detil'][0]['kode_lab']);

            $('#nama').val(arr['detil'][0]['nama']);

            $('#quota').val(arr['detil'][0]['quota_max']);

            if(arr['detil'][0]['status'] == 1){
                $("#status").prop("checked", true);
            }

            $('#mode').val('update');
        });
    }

    function view(){
        $.post(baseurl + "laboratorium/get", {

        },
		function(result) {
            // alert(result);
            var arr = JSON.parse(result);
            var kal = "";
            
            for(var i = 0; i < arr.length; i++){
                kal += '<tr>';
                kal += '<td>';
                    kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['kode_lab'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                    kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['kode_lab'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['kode_lab'] +'</td>';
                kal += '<td>'+ arr[i]['nama'] +'</td>';
                kal += '<td>'+ arr[i]['quota_max'] +'</td>';
                kal += '<td>';
                    kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                kal += '</td>';
                kal += '</tr>';
            }
            
            $("#data_laboratorium").html(kal);
            $("#datatable-laboratorium").DataTable({
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