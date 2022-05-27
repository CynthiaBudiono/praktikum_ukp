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
                    <form action="" method="post" class="form-horizontal form-label-left">
                    
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                        <input type="hidden" class="form-control" name="id" id="id">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Start - End Date <small>(year/month/date)</small></label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="datetimes" id="datetimes" class="form-control"/>
                                    <!-- <input type="text" name="reservation-time" id="reservation-time" class="form-control" value="<?= $start_date ?> - <?= $end_date ?>" /> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Periode pendaftaran ke-</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <input type="radio" id="pp1" name="ppke" value="1" checked>
                                        <label for="pp1">1</label>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input type="radio" id="pp2" name="ppke" value="2">
                                        <label for="pp2">2</label>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input type="radio" id="pp3" name="ppke" value="3">
                                        <label for="pp3">3</label>
                                    </div>
                                </div>
                                <!-- <input class="form-control" type="number" class='number' name="ppke" id="ppke" min="1" max="4" required='required'>
                                <span id="error_pp" class="color-red"></span> -->
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

                        <!-- <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Keterangan</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                <textarea id="keterangan" name="keterangan" rows="5"></textarea>
                                </div>
                            </div>
                        </div> -->
                            
                        <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9">
                                    <!-- <button type="button" class="btn btn-danger">Cancel</button> -->
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="button" class="btn btn-success" id="btnsubmit" onclick="addupdate()"><a href="#data_table" style="color: white;">Buka Pendaftaran</a></button>
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("pendaftaran_praktikum/adds"); ?>">Tambah</a>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable_pendaftaran_praktikum" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>PP ke-</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran </th>
                                        <!-- <th>Status</th> -->
                                    </tr>
                                </thead>
                                <tbody id="data_pendaftaran_praktikum">
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
$(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(48, 'hour'),
    minDate: moment(),
    timePicker24Hour: true,
    locale: {
      format: 'Y/MM/DD HH:mm'
    }
  });
});
</script>

<script>
    var baseurl = "<?php echo base_url(); ?>";
    // view();
    var baru = 0;
    $(document).ready(function() {	
        // $('#keterangan').trumbowyg();  
        
        view()
    });

    function addupdate(){
        // alert($("input[type='radio'][name='ppke']:checked").val());
        $waktu = ($('#datetimes').val()).split(" - ");
        // alert(tinymce.get("keterangan").getContent());
        // alert($('#keterangan').val());
        // Y-M-DD HH:mm
        // if($('#ppke').val() >=1 && $('#ppke').val() <=4){
            $.post(baseurl + "pendaftaran_praktikum/" + $('#mode').val(), {
                id: $('#id').val(),
                waktu_start : $waktu[0],
                waktu_end: $waktu[1],
                ppke: $("input[type='radio'][name='ppke']:checked").val(),
                // status: $('#status').is(':checked'),
                // keterangan: $('#keterangan').val(),
            },
            function(result) {
                // alert(result);
                if(result == 'success'){
                    view()
                    
                    $('input[name="datetimes"]').daterangepicker({
                        timePicker: true,
                        startDate: moment().startOf('hour'),
                        endDate: moment().startOf('hour').add(48, 'hour'),
                        minDate: moment(),
                        timePicker24Hour: true,
                        locale: {
                        format: 'Y/MM/DD HH:mm'
                        }
                    });
                    
                    $("input[name=ppke][value=1]").prop('checked', true);

                    // $('#keterangan').trumbowyg('html', ""); 

                    if($('#mode').val() == 'update'){
                        $('#action_title').html("Add");
                        $('#mode').val('add');
                    }

                }
                else{
                    alert(result);
                }
            });
        // }
        // else{
            // $('#error_pp').html("periode pendaftaran harus 1-4")
        // }
    }

    function adds(){
        $('#content-add').css('display', 'block');
            
        // make scroll top
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;

        $('#action_title').html('Add pendaftaran praktikum');
        $('#mode').val('add');
    }

    function updates($id){
        // alert($id)
        $.post(baseurl + "pendaftaran_praktikum/updates", {
            id : $id,
        },function(result){
            var arr = JSON.parse(result);
            
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            $('#id').val(arr['detil'][0]['id']);

            // $waktu = moment(arr['detil'][0]['waktu_start'].toString(), 'Y-m-d H:i:s').format("Y/MM/DD HH:mm");

            // alert(arr['detil'][0]['waktu_start'].toString() + " " + arr['detil'][0]['waktu_end'].toString());

            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment(arr['detil'][0]['waktu_start'].toString()),
                endDate: moment(arr['detil'][0]['waktu_end'].toString()),
                minDate: moment(arr['detil'][0]['waktu_start'].toString()),
                timePicker24Hour: true,
                locale: {
                format: 'Y/MM/DD HH:mm'
                }
            });

            $("input[name=ppke][value=" + arr['detil'][0]['PP'] + "]").prop('checked', true);

            // $('#keterangan').trumbowyg('html', arr['detil'][0]['keterangan']); 

            // if(arr['detil'][0]['status'] == 1){
            //     $("#status").prop("checked", true);
            // }

            $('#mode').val('update');
        });
    }

    function view(){
        $.post(baseurl + "pendaftaran_praktikum/get", {

        },
		function(result) {
            // alert(result);
            var arr = JSON.parse(result);
            var kal = "";
            
            for(var i = 0; i < arr.length; i++){
                kal += '<tr>';
                kal += '<td>';
                    // kal += '<button type="button" class="btn btn-sm btn-primary btn-action" onclick=view("'+ arr[i]['id'] +'")><i class="fa fa-eye"></i> View</button>';
                    kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                    // kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['id'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['waktu_start'] +'</td>';
                kal += '<td>'+ arr[i]['waktu_end'] +'</td>';
                kal += '<td>'+ arr[i]['PP'] +'</td>';
                kal += '<td>'+ arr[i]['semester'] +'</td>';
                kal += '<td>'+ arr[i]['tahun_ajaran'] +'</td>';
                // kal += '<td>';
                //     kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                // kal += '</td>';
                kal += '</tr>';
            }
            
            
            if(baru > 0){
                $('#datatable_pendaftaran_praktikum').DataTable().destroy();
            }
            $("#data_pendaftaran_praktikum").html(kal);
            baru++;
            $('#datatable_pendaftaran_praktikum').DataTable( {
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