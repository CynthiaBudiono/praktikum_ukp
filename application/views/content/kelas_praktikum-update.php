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
        
            <input type="hidden" class="form-control" name="idkelasprak" id="idkelasprak" value="<?= (isset($primary)) ? $primary: '' ?>">

            <div class="title_right" style="float:right;">
                <button type="button" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success" id="cekbtnsubmit">Submit</button>
            </div>
 
            <div id="container-form">
                <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><label id="hari-summary"></label> <label id="jam-summary"></label> <label id="durasi-summary"></label> <label id="subject-summary"></label> <label id="kelas_paralel-summary"></label></h2>
                        <div>
                            <ul class="nav navbar-right panel_toolbox">
                                <li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status" id="status" <?php if(isset($detil[0]['status'])) if($detil[0]['status']==1) echo 'checked'; ?>></li>
                                <li name="have_warning" id="have_warning" style="margin: 0px 10px; padding-top: 4px; display:none;"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color:#ee9500;"></i></li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                        </div>
                            
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="datacollapse">

                        <div class="alert alert-dismissible pop-over-style" role="alert" id="div_alert" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <strong>Warning.</strong> <span id="error_msgnip1"></span><span id="error_msgnip2"></span><span id="error_msgnip3"></span>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>
                            <div class="col-md-5 col-sm-5 form-group has-feedback">
                                <select class="subject_input form-control select2" disabled name="subject" id="subject" style="width:100%;">
                                    <option value="" disabled selected>Search subject</option>
                                    <?php if(isset($subject)) : ?>
                                        <?php if(is_array($subject)) : ?>
                                            <?php foreach($subject as $key) : ?>
                                                <?php if($key['kode_mk'] == $detil[0]['kode_mk']) : ?>
                                                    <option value="<?= $key['kode_mk'] ?>" selected ><?= $key['nama'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $key['kode_mk'] ?>"><?= $key['nama'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </select>

                               <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <div class="col-md-6 col-sm-6">
                                    <input type="radio" id="radiopraktikum" name="tipe" value="praktikum" <?php if(isset($detil[0]['tipe'])) if($detil[0]['tipe']=="praktikum") echo 'checked'; ?>>
                                    <label for="radiopraktikum">Praktikum</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <input type="radio" id="radioresponsi" name="tipe" value="responsi" <?php if(isset($detil[0]['tipe'])) if($detil[0]['tipe']=="responsi") echo 'checked'; ?>>
                                    <label for="radioresponsi">Responsi</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Kelas Paralel</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <!-- <select class="kelas_paralel_input form-control select2" disabled name="kelas_paralel" id="kelas_paralel" style="width:100%;">
                                    <option value="" disabled selected>-- Pilih Paralel --</option>
                                    <?= (isset($detil[0]['kelas_paralel'])) ? $detil[0]['kelas_paralel'] : '' ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                </select> -->
                                <input type="text" id="kelas_paralel" name="kelas_paralel" disabled placeholder="ex. A" class="kelas_paralel_input form-control" required="required" maxlength="1" value="<?= (isset($detil[0]['kelas_paralel'])) ? $detil[0]['kelas_paralel'] : '' ?>">
                                <span class="fa fa-gavel form-control-feedback right" aria-hidden="true"></span>
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
                            <label class="col-form-label col-md-3 col-sm-3 ">Hari / Jam</label>
                            <div class="col-md-9 col-sm-9 form-group has-feedback">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-left: 10px;">
                                    <select class="hari_input select2_single form-control has-feedback-left" name ="hari" id="hari" tabindex="-1" required="required">
                                        <option>--choose hari--</option>
                                        <option value="Senin" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Senin') echo 'selected'; ?>>Senin</option>
                                        <option value="Selasa" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Selasa') echo 'selected'; ?>>Selasa</option>
                                        <option value="Rabu" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Rabu') echo 'selected'; ?>>Rabu</option>
                                        <option value="Kamis" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Kamis') echo 'selected'; ?>>Kamis</option>
                                        <option value="Jumat" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Jumat') echo 'selected'; ?>>Jumat</option>
                                        <option value="Sabtu" <?php if(isset($detil[0]['hari'])) if($detil[0]['hari']=='Sabtu') echo 'selected'; ?>>Sabtu</option>
                                    </select>
                                    <span class="fa fa-sun-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-6 col-sm-6" style="padding-right: 10px;">
                                        <div class="input-group date" id="timepicker">
                                            <input type="text" required="required" name ="jam" id="jam" class="jam_input form-control" value="<?= (isset($detil[0]['jam'])) ? $detil[0]['jam'] : '' ?>"/>
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
                                <input class="durasi_input form-control" type="number" class="number" name="durasi" id="durasi" min="1" max="300" required="required" placeholder="menit" value="<?= (isset($detil[0]['durasi'])) ? $detil[0]['durasi'] : '' ?>">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Pengajar</label>
                            <div class="col-md-9 col-sm-9 form-group" style="padding: 0px;">
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip1")' name="nip1" id="nip1" required="required" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 1</option>
                                        <?php if(isset($pengajar)) : ?>
                                            <?php if(is_array($pengajar)) : ?>
                                                <?php foreach($pengajar as $key) : ?>
                                                    <?php if($key['id_pengajar'] == $detil[0]['NIP1']) : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>" selected ><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>"><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                  
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip2")' name="nip2" id="nip2" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 2</option>
                                        <?php if(isset($pengajar)) : ?>
                                            <?php if(is_array($pengajar)) : ?>
                                                <?php foreach($pengajar as $key) : ?>
                                                    <?php if($key['id_pengajar'] == $detil[0]['NIP2']) : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>" selected ><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>"><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                            
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control select2" onchange='getjadwalpengajar("nip3")' name="nip3" id="nip3" style="width:100%;">
                                        <option value="" disabled selected>Search pengajar 3</option>
                                        <?php if(isset($pengajar)) : ?>
                                            <?php if(is_array($pengajar)) : ?>
                                                <?php foreach($pengajar as $key) : ?>
                                                    <?php if($key['id_pengajar'] == $detil[0]['NIP3']) : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>" selected ><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $key['id_pengajar'] ?>"><?= $key['id_pengajar'] ?> ~ <?= $key['nama'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
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
        // $("#subject").prop("disabled", true);
        $('#laboratorium').select2();
        $('#nip1').select2();
        $('#nip2').select2();
        $('#nip3').select2();

        getjadwalpengajar("nip1");
        getjadwalpengajar("nip2");
        getjadwalpengajar("nip3");

        // alert($('#subject').val());
        $.post(baseurl + "subject/get", {
            kode_mk: $('#subject').val(),
        },
        function(result) {
            var arr = JSON.parse(result);
            if(arr[0]['status_praktikum'] == 1){
                // alert('masuk status praktikum');
                $("#radiopraktikum").prop("disabled", false);
            }
            if(arr[0]['status_responsi'] == 1){
                // alert("masuk status responsi");
                $("#radioresponsi").prop("disabled", false);
            }
            
        });

        $('#timepicker').datetimepicker({
            format: 'H:mm'
        });

        // $('.subject_input').on("change paste keyup select", function() {
        //     // var id= this.id;
        //     // var row= id.substr(7,10);
        //     $('#subject-summary').html($('#subject option:selected').text());
        // });

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
            getjadwalpengajar("nip1");
            getjadwalpengajar("nip2");
            getjadwalpengajar("nip3");
        });
        
        $('.hari_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(4,10);
            $('#hari-summary').html($('#hari').val());
            // getjadwalpengajar();
            getjadwalpengajar("nip1");
            getjadwalpengajar("nip2");
            getjadwalpengajar("nip3");
        });

        $('.jam_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(3,10);
            $('#jam-summary').html($('#jam').val());
            // getjadwalpengajar();
            getjadwalpengajar("nip1");
            getjadwalpengajar("nip2");
            getjadwalpengajar("nip3");
        });
    });

    function getjadwalpengajar(idinput){
        // alert(row + " " + $idinput);
        // alert('#'+ idinput + " " + $('#hari').val()+ " " + $('#jam').val() + " " +$('#durasi').val());

        $.post(baseurl + "jadwal_berhalangan/getnabrakpengajar", {
            pengajar: $('#'+ idinput).val(),
            hari: $('#hari').val(),
            jam: $('#jam').val(),
            durasi: $('#durasi').val(),
        },
        function(result) {
            // alert(result);
            // console.log("AAAAAAA " + result);
            // var cek = result;
            if(result == 'yes'){
                // alert("MASUKKKKKK YES");
                $('#have_warning').css('display', 'block');
                $('#error_msg' + idinput).html("Jadwal "+ $('#'+ idinput).val() +" Berhalangan. ");
                $('#div_alert').css('display', 'block');

            }
            else if(result == 'no'){
                // alert("MASUK NO");
                $('#error_msg' + idinput).html("");
            }

            if($('#error_msgnip1').html() == "" && $('#error_msgnip2').html() == "" && $('#error_msgnip3').html() == ""){
                $('#have_warning').css('display', 'none');
                $('#div_alert').css('display', 'none');
            }
        });
    }

</script>