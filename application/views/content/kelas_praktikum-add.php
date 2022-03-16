<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?></h3>
            </div>
        </div>
        <!-- <div class="row"> -->
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo 'Update'; }} else {echo 'Add'; } ?> <small>Untuk Periode- <?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <button type="button" onclick="addrow()" class="btn btn-sm bg-green">Tambah</button>

                        <form action="<?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo (base_url('kelas_praktikum/update'));}} else { echo (base_url('kelas_praktikum/add')); } ?>" method="post" class="form-horizontal form-label-left">
                        
                            <!-- <input type="hidden" class="form-control" name="idusergroup" id="idusergroup" value="<?= (isset($detil[0]['id'])) ? $detil[0]['id'] : '' ?>"> -->

                            <div class="card-box table-responsive"> 
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>Lab</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Durasi</th>
                                            <th>Terisi</th>
                                            <th>NIP1</th>
                                            <th>NIP2</th>
                                            <th>NIP3</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_jadwal">
                                        <tr>
                                            <td><input type="text" id="subject" name="subject" placeholder="MatKul" class="form-control" required="required"></td>
                                            <td><input type="text" name="laboratorium" id="laboratorium" placeholder="lab" class="form-control" required="required"/></td>
                                            <td>
                                                <select class="select2_single form-control" tabindex="-1" required="required">
                                                    <option>--choose hari--</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group date" id="myDatepicker3">
                                                    <input type="text" required="required" class="form-control"/>
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><input class="form-control" type="number" class="number" name="durasi" id="durasi" min="1" max="300" required="required" placeholder="menit"></td>
                                            <td><input class="form-control" type="number" class="number" name="terisi" id="terisi" min="1" max="300" required="required" placeholder="orang"></td>
                                            <td><input type="text" name="nip1" id="nip1" placeholder="pengajar" required="required" class="form-control" /></td>
                                            <td><input type="text" name="nip2" id="nip2" placeholder="pengajar" class="form-control" /></td>
                                            <td><input type="text" name="nip3" id="nip3" placeholder="pengajar" class="form-control" /></td>
                                            <td><input type="checkbox" name="status" id="status" class="js-switch" checked/></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9">
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div> <!-- /x_content -->
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

$(document).ready(function() {

    // Data yang ditamilkan pada autocomplete.
    $.post(baseurl + "subject/gethavepraktikum", {
    },
    function(result) {
        var arr = JSON.parse(result);
        var subject = []
        for(var i=0; i<arr.length; i++){
            subject.push({value: arr[i]['nama'], data: arr[i]['kode_mk']})
        }
        // Selector input yang akan menampilkan autocomplete.
        $( "#subject" ).autocomplete({
            lookup: subject
        });
    });
        

    $.post(baseurl + "laboratorium/getactivelab", {
    },
    function(result) {
        // alert(result);
        var arr = JSON.parse(result);
        var lab = []
        for(var i=0; i<arr.length; i++){
            lab.push({value: arr[i]['nama'], data: arr[i]['kode_lab']})
        }
        // Selector input yang akan menampilkan autocomplete.
        $( "#laboratorium" ).autocomplete({
            lookup: lab
        });
    });

    $.post(baseurl + "dosen/getactivepengajar", { //DOSEN & Asisten Dosen
    },
    function(result) {
        // alert(result);
        var arr = JSON.parse(result);
        var pengajar = []
        for(var i=0; i<arr.length; i++){
            pengajar.push({value: arr[i]['nama'], data: arr[i]['NIP']})
        }
        // Selector input yang akan menampilkan autocomplete.
        $( "#nip1" ).autocomplete({
            lookup: pengajar
        });
        $( "#nip2" ).autocomplete({
            lookup: pengajar
        });
        $( "#nip3" ).autocomplete({
            lookup: pengajar
        });
    });

    }) // end Document Ready

   $(function () {
        $('#myDatepicker3').datetimepicker({
            format: 'H:mm'
        });
    });

    function addrow(){
        var kal ='';

        kal +='<tr>';
            kal +='<td><input type="text" id="subject" name="subject" placeholder="MatKul" class="form-control" required="required"></td>';
            kal +='<td><input type="text" name="laboratorium" id="laboratorium" placeholder="lab" class="form-control" required="required"/></td>';
            kal +='<td>';
                kal +='<select class="select2_single form-control" tabindex="-1" required="required">';
                    kal +='<option>--choose hari--</option>';
                    kal +='<option value="Senin">Senin</option>';
                    kal +='<option value="Selasa">Selasa</option>';
                    kal +='<option value="Rabu">Rabu</option>';
                    kal +='<option value="Kamis">Kamis</option>';
                    kal +='<option value="Jumat">Jumat</option>';
                    kal +='<option value="Sabtu">Sabtu</option>';
                kal +='</select>';
            kal +='</td>';
            kal +='<td>';
                kal +='<div class="input-group date" id="myDatepicker3">';
                    kal +='<input type="text" required="required" class="form-control"/>';
                    kal +='<span class="input-group-addon">';
                    kal +='<span class="fa fa-calendar"></span>';
                    kal +='</span>';
                kal +='</div>';
            kal +='</td>';
            kal +='<td><input class="form-control" type="number" class="number" name="durasi" id="durasi" min="1" max="300" required="required" placeholder="menit"></td>';
            kal +='<td><input class="form-control" type="number" class="number" name="terisi" id="terisi" min="1" max="300" required="required" placeholder="orang"></td>';
            kal +='<td><input type="text" name="nip1" id="nip1" placeholder="pengajar" required="required" class="form-control" /></td>';
            kal +='<td><input type="text" name="nip2" id="nip2" placeholder="pengajar" class="form-control" /></td>';
            kal +='<td><input type="text" name="nip3" id="nip3" placeholder="pengajar" class="form-control" /></td>';
            kal +='<td><input type="checkbox" name="status" id="status" class="js-switch" checked/></td>';
        kal +='</tr>';

        $('#table_jadwal').append(kal);
    }

</script>