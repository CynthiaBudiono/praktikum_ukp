<style>
    .wrapper-radio{
        display: inline-flex;
        padding:4px;
    }
    .wrapper-radio .option{
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        margin: 0 10px;
        border-radius: 5px;
        cursor: pointer;
        padding: 5px 10px;
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
    #radioPria:checked:checked ~ .radioPria,
    #radioWanita:checked:checked ~ .radioWanita{
        border-color: #1d81be;
        background: #1d81be;
    }
    #radioPria:checked:checked ~ .radioPria .dot,
    #radioWanita:checked:checked ~ .radioWanita .dot{
        background: url(<?php echo base_url('assets/icons/checkmark.svg');?>);
    }
    #radioPria:checked:checked ~ .radioPria .dot::before,
    #radioWanita:checked:checked ~ .radioWanita .dot::before{
        opacity: 1;
        transform: scale(1);
    }
    .wrapper-radio .option span{
        font-size: 12px;
        color: #808080;
    }
    #radioPria:checked:checked ~ .radioPria span,
    #radioWanita:checked:checked ~ .radioWanita span{
        color: #fff;
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
        <?php if($bukapendaftaran == "tutup"){?>
            Maaf pendaftaran TUTUP, silahkan menunggu info lanjut pembukaan lowongan 
        <?php } else if($bukapendaftaran == "buka"){?>
        <form action="<?php if(isset($detil[0]['id'])){ 
                                if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ 
                                    echo (base_url('calon_asisten_dosen/update'));
                                }
                            }
                            else {echo (base_url('calon_asisten_dosen/add'));} ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                        
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= isset($title) ? $title : "-" ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Smart Wizard -->
                        <p>Pendaftaran Asisten Dosen periode <?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></p>
                        <?php echo validation_errors('<div class="error">', '</div>'); ?>
                        <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step-1">
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                        Step 1<br />
                                        <small>Registration</small>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                        Step 2<br />
                                        <small>Upload Berkas</small>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                        Step 3<br />
                                        <small>Information</small>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div id="step-1">
                            <!-- <form class="form-horizontal form-label-left" > -->
                            <form action="<?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo (base_url('calon_asisten_dosen/update'));}} else { echo (base_url('calon_asisten_dosen/add')); } ?>" method="post" class="form-horizontal form-label-left">
                        
                                <input type="hidden" class="form-control" name="idcalon" id="idcalon" value="<?= (isset($primary)) ? $primary: '' ?>">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="full-name">NRP <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nrp" name="nrp" required="required" class="form-control" value="<?= (isset($detil[0]['NRP'])) ? $detil[0]['NRP']: '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="alamat">Alamat <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="alamat" name="alamat" required="required" class="form-control " value="<?= (isset($detil[0]['alamat'])) ? $detil[0]['alamat']: '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lineid" class="col-form-label col-md-3 col-sm-3 label-align">No HP<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="tel" pattern="\(\d\d\d\d\)-\d\d\d\d\d\d\d\d" name="nohp" id="nohp" class="form-control col" placeholder="08.." required value="<?= (isset($detil[0]['no_hp'])) ? $detil[0]['no_hp']: '' ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lineid" class="col-form-label col-md-3 col-sm-3 label-align">line ID<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="lineid" name="lineid" class="form-control col" required="required" value="<?= (isset($detil[0]['line_id'])) ? $detil[0]['line_id']: '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <div class="wrapper-radio">
                                        <input type="radio" <?php if(isset($detil[0]['gender'])) if($detil[0]['gender']=='Pria') echo 'checked'; ?> value="Pria" id="radioPria" name="gender">
                                        <input type="radio" <?php if(isset($detil[0]['gender'])) if($detil[0]['gender']=='Wanita') echo 'checked'; ?> value="Wanita" id="radioWanita" name="gender">
                                        <label for="radioPria" class="option radioPria">
                                            <div class="dot"></div>
                                            <span>Pria</span>
                                            </label>
                                        <label for="radioWanita" class="option radioWanita">
                                            <div class="dot"></div>
                                            <span>Wanita</span>
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Motivasi<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="motivasi" name="motivasi" class="form-control"><?= (isset($detil[0]['motivasi'])) ? $detil[0]['motivasi']: '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kelebihan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="kelebihan" name="kelebihan" class="form-control"><?= (isset($detil[0]['kelebihan'])) ? $detil[0]['kelebihan']: '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kekurangan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="kekurangan" name="kekurangan" class="form-control"> <?= (isset($detil[0]['kekurangan'])) ? $detil[0]['kekurangan']: '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Komitmen<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="komitmen" name="komitmen" class="form-control"><?= (isset($detil[0]['komitmen'])) ? $detil[0]['komitmen']: '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Pengalaman<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="pengalaman" name="pengalaman" class="form-control"><?= (isset($detil[0]['pengalaman'])) ? $detil[0]['pengalaman']: '' ?></textarea>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div id="step-2">
                            <h2 class="StepTitle">Upload Berkas</h2>
                            <p> 1. Transkrip Lokal & KHS Terbaru</p>
                            <p> 2. KTP </p>
                            <p> 3. Surat Lamaran </p>
                            <p> 4. Curriculum Vitae (disertai dengan foto) </p>
                            <p> Silahkan dijadikan satu file dengan format .pdf </p>
                            <?php if(isset($detil[0]['upload_berkas'])){ if($detil[0]['upload_berkas'] != ""){?>
                                <div class=""> Open a berkas file, <a target="_blank" href="<?= base_url() ?>/assets/berkas/<?= isset($detil[0]['upload_berkas']) ? $detil[0]['upload_berkas'] : "" ?>"><?= isset($detil[0]['upload_berkas']) ? $detil[0]['upload_berkas'] : "-" ?></a> </div>
                            <?php }}?>
                            <br>
                            <input type="file" id= "berkas" name="berkas" accept="application/pdf" value="<?= (isset($detil[0]['upload_berkas'])) ? $detil[0]['upload_berkas']: '' ?>"/>
                        </div>
                        <div id="step-3">
                            <h2 class="StepTitle">Information</h2>
                            <p>
                                Jadwal wawancara akan dikontak langsung oleh dosen
                            </p>
                            <p>
                                Informasi lebih lanjut silahkan hubungi koordinator
                            </p>
                        </div>
                        </div><!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php }?>
    </div>
</div>