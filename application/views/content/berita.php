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

                            <input type="hidden" class="form-control" name="id" id="id" placeholder="ex. JK" required value="<?= (isset($detil[0]['id'])) ? $detil[0]['id'] : '' ?>">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Start - End</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input class="form-control" type="text" name="daterange" id="daterange" value="01/01/2018 - 01/15/2018" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Select</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" id="selecttipe" onchange="isiberita()">
                                        <option value="">--Choose option--</option>
                                        <option value="praktikum">Pendaftaran Praktikum</option>
                                        <option value="rekrutmen">Rekrutmen</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>

                            <div id="divmore">
                            <div class="form-group row" id="divtitle">
                                <label class="control-label col-md-3 col-sm-3 ">Title</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="ex. pembukaan pendaftran" required value="<?= (isset($detil[0]['title'])) ? $detil[0]['title'] : '' ?>">
                                </div>
                            </div>

                            <div id="divmore">
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Link (optional) untuk readmore</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="url" class="form-control" name="link" id="link" placeholder="http.." value="<?= (isset($detil[0]['link'])) ? $detil[0]['link'] : '-' ?>">
                                </div>
                            </div>
                            

                            <div class="form-group row" id="divketerangan">
                                <label class="control-label col-md-3 col-sm-3 ">Keterangan</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="">
                                    <textarea id="keterangan" name="keterangan" rows="15">
                                        <?= isset($detil[0]['keterangan']) ? $detil[0]['keterangan'] : '' ?>
                                    </textarea>
                                    <script>
                                        tinymce.init({
                                        selector: 'textarea',
                                        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                                        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
                                        toolbar_mode: 'floating',
                                        tinycomments_mode: 'embedded',
                                        tinycomments_author: 'Author name',
                                        });
                                    </script>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="divstatus">
                                <label class="control-label col-md-3 col-sm-3 ">Status</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="">
                                        <label>
                                            <input type="checkbox" name="status" id="status" class="js-switch"/>
                                        </label>
                                    </div>
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("berita/adds"); ?>">Tambah</a>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Waktu Start</th>
                                        <th>Waktu End</th>
                                        <th>Title</th>
                                        <th>Keterangan</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="data_berita">
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
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    // startDate: moment().startOf('hour'),
    // endDate: moment().startOf('hour').add(48, 'hour'),
    minDate: moment(),
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

<script>
    var baseurl = "<?php echo base_url(); ?>";
    
    $(document).ready(function() {	
        view()

        $('#divmore').css('display', 'none');
    });

    function isiberita(){
        if($('#selecttipe').val() == ''){
            $('#divmore').css('display', 'none');
        }
        else{
            $('#divmore').css('display', 'block');

            if($('#selecttipe').val() == 'praktikum'){
                $.post(baseurl + "pendaftaran_praktikum/getlastrecord", {
                },
                function(result) {
                    // alert(result);
                    var arr = JSON.parse(result);
                    tinymce.get("keterangan").setContent("<p>Pendaftaran Praktikum (PP) " + arr[0]['PP'] + " dimulai tanggal " + arr[0]['waktu_start']+ " dan berakhir pada tanggal " + arr[0]['waktu_end'] + ".</p>");
                });
               
            }
            else if($('#selecttipe').val() == 'rekrutmen'){
                tinymce.get("keterangan").setContent("<p>rekrutmen!</p>");
            }
            else if($('#selecttipe').val() == 'custom'){
                tinymce.get("keterangan").setContent("<p>custom!</p>");
            }
        }
    }

    function addupdate(){
        alert($('#daterange').val());
        $waktu = ($('#daterange').val()).split(" - ");
        // alert($waktu);
        $.post(baseurl + "berita/" + $('#mode').val(), {
            id: $('#id').val(),
            tanggal_start: $waktu[0],
            tanggal_end: $waktu[1],
            title: $('#title').val(),
            link: $('#link').val(),
            keterangan: tinymce.get("keterangan").getContent(),
            tipe: $('#selecttipe').val(),
            status: $('#status').is(':checked'),
        },
        function(result) {
            // alert("result: " + result);
            if(result == 'success'){
                view()
                
                $('#id').val("");
                $('#title').val("");
                $('#link').val("");
                tinymce.get("keterangan").setContent("");
                $('#selecttipe').val("");
                $("#status").prop("checked", false);

                if($('#mode').val() == 'update'){
                    $('#action_title').html("Add");
                    $('#id').prop("readonly", false);
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

        $('#action_title').html('Add berita');
        $('#mode').val('add');
    }

    function updates($id){
        // alert($id)
        $.post(baseurl + "berita/updates", {
            id : $id,
        },function(result){
            var arr = JSON.parse(result);
            
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            $('#id').val(arr['detil'][0]['id']);

            $('#title').val(arr['detil'][0]['title']);

            $('#link').val(arr['detil'][0]['link']);

            tinymce.get("keterangan").setContent(arr['detil'][0]['title']);

            $('#selecttipe').val(arr['detil'][0]['tipe']);

            if(arr['detil'][0]['status'] == 1){
                $("#status").prop("checked", true);
            }

            $('#mode').val('update');
        });
    }

    function view(){
        $.post(baseurl + "berita/get", {

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
                kal += '<td>'+ arr[i]['tanggal_start'] +'</td>';
                kal += '<td>'+ arr[i]['tanggal_end'] +'</td>';
                kal += '<td>'+ arr[i]['title'] +'</td>';
                kal += '<td>'+ arr[i]['keterangan'] +'</td>';
                kal += '<td>'+ arr[i]['tipe'] +'</td>';
                kal += '<td>';
                    kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                kal += '</td>';
                kal += '</tr>';
            }
            
            $("#data_berita").html(kal);
            
        });
    }
</script>