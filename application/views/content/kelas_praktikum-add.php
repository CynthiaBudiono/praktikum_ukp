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

            <div id="container-form">
            <?php //if(isset($kelas_praktikum)) : ?>
                <?php //if(is_array($kelas_praktikum)) : ?>
                    <?php //foreach($kelas_praktikum as $key) : ?>
                
                        <!-- <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><label id="hari-summary"></label> <label id="jam-summary"></label> <label id="durasi-summary"></label> <label id="subject-summary"></label> <label id="kelas_paralel-summary"></label></h2>
                                    <div>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status" id="status" checked></li>
                                            <li style="margin: 0px 10px; padding-top: 4px;"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color:#ee9500;"></i></li>
                                            <li style="margin: 0px 10px; padding-top: 4px;"><i class="fa fa-trash color-red fa-2x" aria-hidden="true"></i></li>
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="alert alert-dismissible pop-over-style" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <strong>Warning.</strong> <span id="error_msg">check yo self, you're not looking too good.</span> 
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>
                                        <div class="col-md-9 col-sm-9 form-group has-feedback">
                                            <input type="text" id="subject" name="subject" placeholder="MatKul" class="form-control" required="required">
                                            <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 ">Kelas Paralel</label>
                                        <div class="col-md-9 col-sm-9 form-group has-feedback">
                                            <input type="text" id="kelas_paralel" name="kelas_paralel" placeholder="ex. A" class="form-control" required="required" maxlength="1">
                                            <span class="fa fa-gavel form-control-feedback right" aria-hidden="true"></span>
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
                                                <select class="select2_single form-control has-feedback-left" name ="hari" id="hari" tabindex="-1" required="required">
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
                                                <div class="input-group date" id="timepicker">
                                                    <input type="text" required="required" name ="jam" id="jam" class="form-control"/>
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
                        </div> -->
                    <?php //endforeach; ?>
                <?php //endif; ?>
            <?php //endif; ?>
            </div> <!-- /conteiner-form -->
        </form>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";
var row = 0;
$(document).ready(function() {
    addrow();
    // $("#status").prop("checked", false);

    // $( "#subject" ).on( 
    // "autocompletechange", 
    // function( event, ui ) {
    //     alert("AAAA");
    //     $('#subject-summary').html($('#subject').val());
    // });

    // $('#subject').change(function() {
    //     alert("masuk");
    //     $('#text-summary').html($('#subject').val());
    // });

    }) // end Document Ready

//    $(function () {
//         $('#timepicker').datetimepicker({
//             format: 'H:mm'
//         });
//     });

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

    function confirmdelete(el, index) {

        if (window.confirm("Menghapus Item ini?")) {

            var element = el.parentNode.parentNode.parentNode.parentNode;

            element = element.parentNode;

            // alert(element);

            element.remove();
        } 
        else {
        }
    }

    function getjadwalpengajar($row, $idinput){
        // alert(row);
        // alert($('#nip1'+ row).val());
        // hari: "senin",
        // jam: "12:00",
        // durasi: "180"
        $.post(baseurl + "jadwal_berhalangan/getbypengajar", {
            pengajar: "c14180210",
        },
        function(result) {
            alert("AAAAAAA " + result);
            // var arr = JSON.parse(result);
            // var lab = []
            // for(var i=0; i<arr.length; i++){
            //     lab.push({value: arr[i]['nama'], data: arr[i]['kode_lab']})
            // }
            // if(result !=0){
            //     $('#have_warning' + row).css('display', 'block');
            //     if(arr[0]['role'] == 'mahasiswa'){
            //         $('#error_msg' + row).html("jadwal "+ arr[0]['nama_mahasiswa'] +" berhalangan");
            //     }
            //     else if(arr[0]['role'] == 'dosen'){
            //         $('#error_msg' + row).html("jadwal "+ arr[0]['nama_dosen'] +" berhalangan");
            //     }
            //     $('#div_alert' + row).css('display', 'block');
            // }
        });
    }

    function addrow(){
        row +=1;
        var kal ='';

        kal +='<div class="col-md-12 col-sm-12">';
            kal +='<div class="x_panel">';
                kal +='<div class="x_title">';
                    kal +='<h2><label id="hari-summary' + row + '"></label> <label id="jam-summary' + row + '"></label> <label id="durasi-summary' + row + '"></label> <label id="subject-summary' + row + '"></label> <label id="kelas_paralel-summary' + row + '"></label></h2>';
                    kal +='<div>';
                        kal +='<ul class="nav navbar-right panel_toolbox">';
                            kal +='<li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status' + row + '" id="status' + row + '" checked></li>';
                            kal +='<li name="have_warning' + row + '" id="have_warning' + row + '" style="margin: 0px 10px; padding-top: 4px; display:none;"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color:#ee9500;"></i></li>';
                            kal +='<li style="margin: 0px 10px; padding-top: 4px;"><i class="fa fa-trash color-red fa-2x" onclick=confirmdelete(this, ' + row + ') aria-hidden="true"></i></li>';
                            kal +='<li><a data-toggle="collapse" href="#datacollapse' + row + '" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-up"></i></a></li>';
                        kal +='</ul>';
                    kal +='</div>';
                        
                    kal +='<div class="clearfix"></div>';
                kal +='</div>';
                kal +='<div class="x_content collapse" id="datacollapse' + row + '">';
                    kal +='<div class="alert alert-dismissible pop-over-style" role="alert" id="div_alert' + row + '" style="display:none;">';
                        kal +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>';
                        kal +='</button>';
                        kal +='<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                        kal +='<strong>Warning.</strong> <span id="error_msg' + row + '">check yo self, youre not looking too good.</span>';
                    kal +='</div>';
                    // kal +='<input type="hidden" id="number_row' + row + '" name="number_row' + row + '" value="' + row + '">';
                
                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" id="subject' + row + '" name="subject' + row + '" placeholder="MatKul" class="form-control" required="required">';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Kelas Paralel</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" id="kelas_paralel' + row + '" name="kelas_paralel' + row + '" placeholder="ex. A" class="form-control" required="required" maxlength="1">';
                            kal +='<span class="fa fa-gavel form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Laboratorium</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" name="laboratorium' + row + '" id="laboratorium' + row + '" placeholder="lab" class="form-control" required="required"/>';
                            kal +='<span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';
                        
                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Hari / Jam</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<div class="row">';
                                kal +='<div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-left: 10px;">';
                                kal +='<select class="select2_single form-control has-feedback-left" name ="hari' + row + '" id="hari' + row + '" tabindex="-1" required="required">';
                                    kal +='<option>--choose hari--</option>';
                                    kal +='<option value="Senin">Senin</option>';
                                    kal +='<option value="Selasa">Selasa</option>';
                                    kal +='<option value="Rabu">Rabu</option>';
                                    kal +='<option value="Kamis">Kamis</option>';
                                    kal +='<option value="Jumat">Jumat</option>';
                                    kal +='<option value="Sabtu">Sabtu</option>';
                                kal +='</select>';
                                kal +='<span class="fa fa-sun-o form-control-feedback left" aria-hidden="true"></span>';
                                kal +='</div>';

                                kal +='<div class="col-md-6 col-sm-6" style="padding-right: 10px;">';
                                    kal +='<div class="input-group date" id="timepicker' + row + '">';
                                        kal +='<input type="text" required="required" name ="jam' + row + '" id="jam' + row + '" class="form-control"/>';
                                        kal +='<span class="input-group-addon">';
                                            kal +='<span class="fa fa-calendar"></span>';
                                        kal +='</span>';
                                    kal +='</div>';
                                kal +='</div>';
                            kal +='</div>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Durasi</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input class="form-control" type="number" class="number" name="durasi' + row + '" id="durasi' + row + '" min="1" max="300" required="required" placeholder="menit">';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    // kal +='<div class="form-group row">';
                    //     kal +='<label class="col-form-label col-md-3 col-sm-3 ">Terisi</label>';
                    //     kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                    //         kal +='<input class="form-control" type="number" class="number" name="terisi' + row + '" id="terisi' + row + '" min="1" max="300" required="required" placeholder="orang">';
                    //         kal +='<span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>';
                    //     kal +='</div>';
                    // kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Pengajar</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group" style="padding: 0px;">';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip1' + row + '" id="nip1' + row + '" placeholder="pengajar1" required="required" class="form-control" />';
                            kal +='</div>';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip2' + row + '" id="nip2' + row + '" placeholder="pengajar2" class="form-control" />';                                    
                            kal +='</div>';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip3' + row + '" id="nip3' + row + '" placeholder="pengajar3" class="form-control has-feedback-right" />';
                            kal +='</div>';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';
                kal +='</div>';
            kal +='</div>';
        kal +='</div>';

        $('#container-form').append(kal);
        

        // Data yang ditamilkan pada autocomplete.
        $.post(baseurl + "subject/gethavepraktikum", {},
        function(result) {
            var arr = JSON.parse(result);
            var subject = []
            for(var i=0; i<arr.length; i++){
                subject.push({value: arr[i]['nama'], data: arr[i]['kode_mk']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#subject' + row ).autocomplete({
                lookup: subject,
            });
        });

        $.post(baseurl + "laboratorium/getactivelab", {},
        function(result) {
            var arr = JSON.parse(result);
            var lab = []
            for(var i=0; i<arr.length; i++){
                lab.push({value: arr[i]['nama'], data: arr[i]['kode_lab']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#laboratorium' + row ).autocomplete({
                lookup: lab
            });
        });

        $.post(baseurl + "dosen/getactivepengajar", {}, //DOSEN & Asisten Dosen
        function(result) {
            var arr = JSON.parse(result);
            var pengajar = []
            for(var i=0; i<arr.length; i++){
                pengajar.push({value: arr[i]['nama'], data: arr[i]['pengajar_id']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#nip1' + row ).autocomplete({
                lookup: pengajar,
                select : function(event, ui) {    //when we select something from the dropdown
                    this.value = ui.item.data;
                    return false;
                },
            });
            $( '#nip2' + row ).autocomplete({
                lookup: pengajar
            });
            $( '#nip3' + row ).autocomplete({
                lookup: pengajar
            });
        });

        $('#timepicker'+ row).datetimepicker({
            format: 'H:mm'
        });


        $('#subject'+ row).on("change paste keyup select", function() {
            $('#subject-summary'+ row).html($('#subject'+ row).val());
        });

        $('#kelas_paralel'+ row).on("change paste keyup select", function() {
            $('#kelas_paralel-summary'+ row).html("(" + $('#kelas_paralel'+ row).val().toUpperCase() + ")");
        });

        $('#durasi'+ row).on("change paste keyup select", function() {
            $('#durasi-summary'+ row).html("(" + $('#durasi'+ row).val() + " menit) ");
            // getjadwalpengajar();
        });
        
        $('#hari'+ row).on("change paste keyup select", function() {
            $('#hari-summary'+ row).html($('#hari'+ row).val());
            // getjadwalpengajar();
        });

        $('#jam'+ row).on("change paste keyup select", function() {
            $('#jam-summary'+ row).html($('#jam'+ row).val());
            // getjadwalpengajar();
        });

        $('#nip1'+ row).on("change paste keyup select", function() {
            getjadwalpengajar(row, 'nip1');
        });

    }

    

</script>