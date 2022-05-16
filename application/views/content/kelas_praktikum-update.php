<style>

.select2-selection__arrow b{
    display:none !important;
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
                <h3><?= isset($title) ? $title : "-" ?><small> Untuk Periode- <?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></small></h3>
            </div>
        </div>
    
        <form action="<?php echo (base_url('kelas_praktikum/update')); ?>" method="post" class="form-horizontal form-label-left">
        
            <div class="title_right" style="float:right;">
                <button type="button" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
 
            <div id="container-form">
                <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><label id="hari-summary"></label> <label id="jam-summary"></label> <label id="durasi-summary"></label> <label id="subject-summary"></label> <label id="kelas_paralel-summary"></label></h2>
                        <div>
                            <ul class="nav navbar-right panel_toolbox">
                                <li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status" id="status" checked></li>
                                <li name="have_warning" id="have_warning" style="margin: 0px 10px; padding-top: 4px; display:none;"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color:#ee9500;"></i></li>
                                <li><a data-toggle="collapse" href="#datacollapse" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                        </div>
                            
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content collapse" id="datacollapse">
                        <div class="alert alert-dismissible pop-over-style" role="alert" id="div_alert" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <strong>Warning.</strong> <span id="error_msg">check yo self, youre not looking too good.</span>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <select class="subject_input form-control select2" name="subject" id="subject" style="width:100%;">
                                    <option value="" disabled selected>Search subject</option>
                                </select>

                               <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Kelas Paralel</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <input type="text" id="kelas_paralel" name="kelas_paralel" placeholder="ex. A" class="kelas_paralel_input form-control" required="required" maxlength="1">
                                <span class="fa fa-gavel form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Laboratorium</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <select class="form-control select2" name="laboratorium" id="laboratorium" style="width:100%;">
                                    <option value="" disabled selected>Search lab</option>
                                </select>

                                <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                            
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Hari / Jam</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-left: 10px;">
                                    <select class="hari_input select2_single form-control has-feedback-left" name ="hari" id="hari" tabindex="-1" required="required">
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
                                            <input type="text" required="required" name ="jam" id="jam" class="jam_input form-control"/>
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
                                <input class="durasi_input form-control" type="number" class="number" name="durasi" id="durasi" min="1" max="300" required="required" placeholder="menit">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Pengajar</label>
                            <div class="col-md-9 col-sm-9 form-group" style="padding: 0px;">
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip1")' name="nip1" id="nip1" required="required" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 1</option>
                                    </select>
                                  
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip2")' name="nip2" id="nip2" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 2</option>
                                    </select>
                            
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip3")' name="nip3" id="nip3" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div> <!-- /conteiner-form -->
        </form>
    </div>
</div>

<script  type="text/javascript">

    var baseurl = "<?php echo base_url(); ?>";
    $(document).ready(function() {
        $('#subject').select2();
        $('#laboratorium').select2();
        $('#nip1').select2();
        $('#nip2').select2();
        $('#nip3').select2();

        $.post(baseurl + "subject/gethavepraktikum", {},
        function(result) {
            var arr = JSON.parse(result);
            for(var i=0; i<arr.length; i++){
                $('#subject').append('<option value="'+ arr[i]['kode_mk'] +'">'+ arr[i]['nama'] +'</option>');
            }
        });

        $.post(baseurl + "laboratorium/getactivelab", {},
        function(result) {
            var arr = JSON.parse(result);
            // var lab = []
            for(var i=0; i<arr.length; i++){
                $('#laboratorium').append('<option value="'+ arr[i]['kode_lab'] +'">'+ arr[i]['nama'] +'</option>');
            }
        });

        $.post(baseurl + "dosen/getactivepengajar", {}, //DOSEN & Asisten Dosen
        function(result) {
            var arr = JSON.parse(result);
            for(var i=0; i<arr.length; i++){
                $('#nip1').append('<option value="'+ arr[i]['NIP'] +'">'+ arr[i]['nama'] +'</option>');
                $('#nip2').append('<option value="'+ arr[i]['NIP'] +'">'+ arr[i]['nama'] +'</option>');
                $('#nip3').append('<option value="'+ arr[i]['NIP'] +'">'+ arr[i]['nama'] +'</option>');
            }
        });

        $('#timepicker').datetimepicker({
            format: 'H:mm'
        });

        $('.subject_input').on("change paste keyup select", function() {
            // var id= this.id;
            // var row= id.substr(7,10);
            $('#subject-summary').html($('#subject option:selected').text());
        });

        $('.kelas_paralel_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(13,10);
            $('#kelas_paralel-summary').html("(" + $('#kelas_paralel').val().toUpperCase() + ")");
        });

        $('.durasi_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(6,10);
            $('#durasi-summary').html("(" + $('#durasi').val() + " menit) ");
            // getjadwalpengajar();
        });
        
        $('.hari_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(4,10);
            $('#hari-summary').html($('#hari').val());
            // getjadwalpengajar();
        });

        $('.jam_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(3,10);
            $('#jam-summary').html($('#jam').val());
            // getjadwalpengajar();
        });
    });

    // function getjadwalpengajar(row, idinput){
    //     // alert(row + " " + $idinput);
    //     alert('#'+ idinput + row);
    //     // alert($('#id_nip1'+ row).val());
    //     // alert($('#nip1'+ row).val());
    //     // hari: "senin",
    //     // jam: "12:00",
    //     // durasi: "180"
    //     $.post(baseurl + "jadwal_berhalangan/getbypengajar", {
    //         pengajar: $('#'+ idinput + row).val(),

    //     },
    //     function(result) {
            
    //         // console.log("AAAAAAA " + result);
            
    //         if(result != 0){
    //             // alert("aaaaaaaa" + result);
    //             var arr = JSON.parse(result);

    //             $('#have_warning' + row).css('display', 'block');
    //             if(arr[0]['role'] == 'mahasiswa'){
    //                 $('#error_msg' + row).html("jadwal "+ arr[0]['nama_mahasiswa'] +" berhalangan");
    //             }
    //             else if(arr[0]['role'] == 'dosen'){
    //                 $('#error_msg' + row).html("jadwal "+ arr[0]['nama_dosen'] +" berhalangan");
    //             }
    //             $('#div_alert' + row).css('display', 'block');
    //         }
    //     });
    // }

</script>