<style>
input[type=checkbox] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  -webkit-tap-highlight-color: transparent;
  cursor: pointer;
}
input[type=checkbox]:focus {
  outline: 0;
}

.toggle-switch {
  height: 25px;
  width: 34px;
  border-radius: 16px;
  display: inline-block;
  position: relative;
  margin: 0;
  border: 2px solid #dfdfdf;
  /* background: linear-gradient(180deg, #2D2F39 0%, #1F2027 100%); */
  transition: all 0.2s ease;
}
.toggle-switch:after {
  content: "";
  position: absolute;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: white;
  box-shadow: 0 1px 2px rgba(44, 44, 44, 0.2);
  /* box-shadow: rgb(223 223 223) 0px 0px 0px 0px inset; */
  /* box-shadow: 0 1px 3px rgb(0 0 0 / 40%); */
  transition: all 0.2s cubic-bezier(0.5, 0.1, 0.75, 1.35);
  /* transition: background-color 0.4s ease 0s, left 0.2s ease 0s; */
}
.toggle-switch:checked {
  border-color: #F4F9F9;
  background: #82b19b;
}
.toggle-switch:checked:after {
  transform: translatex(10px);
}
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?><small>Untuk Periode- <?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></small></h3>
            </div>
        </div>

        <form action="<?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo (base_url('kelas_praktikum/update'));}} else { echo (base_url('kelas_praktikum/add')); } ?>" method="post" class="form-horizontal form-label-left">

            <div class="title_right" style="float:right;">
                <button type="button" onclick="summary()" class="btn bg-yellow">Summary</button>
                <button type="button" onclick="addrow()" class="btn bg-green">Tambah</button>
                <button type="button" class="btn btn-danger">Cancel</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="text-summary"></h2>
                        <div>
                            <ul class="nav navbar-right panel_toolbox">
                                <li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status" id="status" checked></li>
                                <li style="margin: 0px 10px; padding-top: 4px;"><i class="fa fa-trash color-red fa-2x" aria-hidden="true"></i></li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <input type="text" id="subject" name="subject" placeholder="MatKul" class="form-control" required="required">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Laboratorium</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <input type="text" name="laboratorium" id="laboratorium" placeholder="lab" class="form-control" required="required"/>
                                <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Hari / Jam</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <div class="row">
                                <div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-left: 10px;">
                                    <select class="select2_single form-control has-feedback-left" tabindex="-1" required="required">
                                        <option>--choose hari--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                    <span class="fa fa-sun-o form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6" style="padding-right: 10px;">
                                    <div class="input-group date" id="myDatepicker3">
                                        <input type="text" required="required" class="form-control"/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Durasi</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                            <input class="form-control" type="number" class="number" name="durasi" id="durasi" min="1" max="300" required="required" placeholder="menit">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Terisi</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                            <input class="form-control" type="number" class="number" name="terisi" id="terisi" min="1" max="300" required="required" placeholder="orang">
                                <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Pengajar</label>
                            <div class="col-md-9 col-sm-9 form-group" style="padding: 0px;">
                                <div class="col-md-4 col-sm-6">
                                    <input type="text" name="nip1" id="nip1" placeholder="pengajar1" required="required" class="form-control" />
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <input type="text" name="nip2" id="nip2" placeholder="pengajar2" class="form-control" />
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <input type="text" name="nip3" id="nip3" placeholder="pengajar3" class="form-control has-feedback-right" />
                                </div>
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

$(document).ready(function() {
    // $("#status").prop("checked", false);

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
            lookup: subject,
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

        // $('#tags_1').inputTags({
        //     max: 3,
        //     autocomplete: {
        //         values: ['jQuery','JavaScript'],
        //         only: false
        //     }
        // });

    });

    $( "#subject" ).on( 
    "autocompletechange", 
    function( event, ui ) {
        alert("AAAA");
        $('#text-summary').html($('#subject').val());
    });
    
    $('#subject').on("change paste keyup select", function() {
        $('#text-summary').html($('#subject').val());
    });

    // $('#subject').change(function() {
    //     alert("masuk");
    //     $('#text-summary').html($('#subject').val());
    // });

    }) // end Document Ready

   $(function () {
        $('#myDatepicker3').datetimepicker({
            format: 'H:mm'
        });
    });

    var toggle = 'close';
    function summary(){
        if(toggle == 'open'){
            $('.x_content').css('display', 'block');
            $( ".fa-chevron-down" ).removeClass( "fa-chevron-down" ).addClass( "fa-chevron-up" );
            toggle = 'close';
        }
        else{
            $('.x_content').css('display', 'none');
            $( ".fa-chevron-up" ).removeClass( "fa-chevron-up" ).addClass( "fa-chevron-down" );
            toggle = 'open';
        }
        

    }

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