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
    #radioadmin:checked:checked ~ .radioadmin,
    #radiokelab:checked:checked ~ .radiokelab{
        border-color: #1d81be;
        background: #1d81be;
    }
    #radioadmin:checked:checked ~ .radioadmin .dot,
    #radiokelab:checked:checked ~ .radiokelab .dot{
        background: url(<?php echo base_url('assets/icons/checkmark.svg');?>);
    }
    #radioadmin:checked:checked ~ .radioadmin .dot::before,
    #radiokelab:checked:checked ~ .radiokelab .dot::before{
        opacity: 1;
        transform: scale(1);
    }
    .wrapper-radio .option span{
        font-size: 12px;
        color: #808080;
    }
    #radioadmin:checked:checked ~ .radioadmin span,
    #radiokelab:checked:checked ~ .radiokelab span{
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
                        <form action="<?php if(isset($detil[0]['id'])) if($detil[0]['id'] != "" || $detil[0]['id'] != NULL) echo (base_url('user/update')); else echo (base_url('user/add')); ?>" method="post" class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Group</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="wrapper-radio">
                                        <input type="radio" checked value="admin" id="radioadmin" name="tipe">
                                        <input type="radio" value="kepala_lab" id="radiokelab" name="tipe">
                                        <label for="radioadmin" class="option radioadmin">
                                            <div class="dot"></div>
                                            <span>Admin</span>
                                            </label>
                                        <label for="radiokelab" class="option radiokelab">
                                            <div class="dot"></div>
                                            <span>Kepala Lab</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Username</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="ex. xxx" required value="<?= (isset($detil[0]['username'])) ? $detil[0]['username'] : '' ?>" <?= (isset($detil[0]['username'])) ? 'readonly="readonly"' : '' ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Password</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="min 4 char" required value="<?= (isset($detil[0]['password'])) ? $detil[0]['password'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Email</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="xxx@gmail.com" required value="<?= (isset($detil[0]['email'])) ? $detil[0]['email'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Dosen <small>menjadi Kepala lab</small></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control select2" name="dosen" id="dosen" required="required" style="width:100%;">
                                        <option value="" disabled selected>Search dosen</option>
                                        <?php if(isset($dosen)) : ?>
                                            <?php if(is_array($dosen)) : ?>
                                                <?php foreach($dosen as $key) : ?>
                                                    <?php if($key['NIP'] == $detil[0]['NIP1']) : ?>
                                                        <option value="<?= $key['NIP'] ?>" selected ><?= $key['nama'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $key['NIP'] ?>"><?= $key['nama'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Laboratorium</label>
                                <div class="col-md-9 col-sm-9 form-group has-feedback">
                                    <select class="form-control select2" name="laboratorium" id="laboratorium" style="width:100%;">
                                        <option value="" disabled selected>Search lab</option>
                                        <?php if(isset($laboratorium)) : ?>
                                            <?php if(is_array($laboratorium)) : ?>
                                                <?php foreach($laboratorium as $key) : ?>
                                                    <?php if($key['kode_lab'] == $detil[0]['kode_lab']) : ?>
                                                        <option value="<?= $key['kode_lab'] ?>" selected ><?= $key['nama'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $key['kode_lab'] ?>"><?= $key['nama'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>

                                    <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="form-group row">
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("user/adds"); ?>">Tambah</a>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-user" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Dosen</th>
                                        <th>Lab</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="data_user">
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
    var baru = 0;
    // view();
    $(document).ready(function() {	
        // alert("masukkkkkkkk ready");	

        $('#dosen').select2();
        $('#laboratorium').select2();

        $("#dosen").prop("disabled", true);
        $("#laboratorium").prop("disabled", true);
        $("#password").prop("disabled", false);


        $('input[type=radio][name=tipe]').change(function() {
            if (this.value == 'admin') {
                $("#username").prop("disabled", false);
                $("#password").prop("disabled", false);

                $("#dosen").prop("disabled", true);
                $("#laboratorium").prop("disabled", true);
            }
            else if (this.value == 'kepala_lab') {
                $("#username").prop("disabled", true);
                $("#password").prop("disabled", true);

                $("#dosen").prop("disabled", false);
                $("#laboratorium").prop("disabled", false);
            }
        });

        view();
    });

    function addupdate(){
        // alert('masuk func' + $('#mode').val());
        // alert($('#kodelab').val());
        // alert(baseurl + "user/" + $('#mode').val());
        var level = 0;
        if($("#radioadmin").is(':checked')){
            level = 1;
        }
        else{
            level = 2;
        }
        $.post(baseurl + "user/" + $('#mode').val(), {
            id: $('#id').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            email: $('#email').val(),
            level: level,
            // id_user_group: $('#quota').val(),
            NIP: $('#dosen').val(),
            kode_lab: $('#laboratorium').val(),
            status: $('#status').is(':checked'),
        },
        function(result) {
            // alert(result);
            if(result == 'success'){
                view();
                
                $('#id').val("");
                $('#username').val("");
                $('#password').val("");
                $('#email').val("");
                $("#radioadmin").prop("checked", true);
                $('#dosen').val("").trigger('change');
                $('#laboratorium').val("").trigger('change');

                $("#status").prop("checked", false);

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

        $('#action_title').html('Add user');
        $('#mode').val('add');
    }

    function updates($id){
        $.post(baseurl + "user/updates", {
            id : $id,
        },function(result){
            var arr = JSON.parse(result);
            
            $('#content-add').css('display', 'block');
            
            // make scroll top
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            $('#action_title').html(arr['title']);

            $('#id').val(arr['detil'][0]['id']);
            $('#username').val(arr['detil'][0]['username']);
            $('#password').val(arr['detil'][0]['password']);
            $('#email').val(arr['detil'][0]['email']);

            if(arr['detil'][0]['level'] == 1){
                $("#radioadmin").prop("checked", true);
            }
            else if(arr['detil'][0]['level'] == 2){
                $("#radiokelab").prop("checked", true);
            }
            $('#level').val(arr['detil'][0]['level']);
            $('#dosen').val(arr['detil'][0]['dosen']).trigger('change');
            $('#laboratorium').val(arr['detil'][0]['id']).trigger('change');

            if(arr['detil'][0]['status'] == 1){
                $("#status").prop("checked", true);
            }

            $('#mode').val('update');
        });
    }

    function view(){
        $.post(baseurl + "user/get", {

        },
		function(result) {
            // alert(result);
            var arr = JSON.parse(result);
            var kal = "";
            
            for(var i = 0; i < arr.length; i++){
                kal += '<tr>';
                kal += '<td>';
                    kal += '<button type="button" class="btn btn-sm btn-info btn-action" onclick=updates("'+ arr[i]['id'] +'")><i class="fa fa-pencil"></i> Edit</button>';
                    // kal += '<button type="button" class="btn btn-sm btn-danger btn-action" onclick=delete("'+ arr[i]['kode_lab'] +'")><i class="fa fa-trash-o"></i> Delete</button>';
                kal += '</td>';
                kal += '<td>'+ arr[i]['username'] +'</td>';
                kal += '<td>'+ arr[i]['email'] +'</td>';
                kal += '<td>'; 
                    if(arr[i]['level'] == 1){ kal += 'Admin';} else { kal += 'Kepala Lab';}
                kal += '</td>';
                kal += '<td>';
                    kal += (arr[i]['NIP'] != 0 ) ? arr[i]['NIP'] + " ~ " + arr[i]['nama_dosen'] : '';
                kal += '</td>';
                kal += '<td>';
                    kal += (arr[i]['kode_lab'] != null) ?  arr[i]['kode_lab'] : '';
                kal += '</td>';
                kal += '<td>';
                    kal += (arr[i]['status'] == 1) ? '<span class="badge bg-green">active</span>' : '<span class="badge bg-danger">non active</span>';
                kal += '</td>';
                kal += '</tr>';
            }
            
            if(baru > 0){
                $('#datatable-user').DataTable().destroy();
            }
            $("#data_user").html(kal);
            baru++;
            $("#datatable-user").DataTable({
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