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
        border-color: #82b19b;
        background: #82b19b;
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
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>

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
                            <form class="form-horizontal form-label-left">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="full-name">Full Name <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="full_name" name="full_name" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="alamat">Alamat <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="alamat" name="alamat" required="required" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lineid" class="col-form-label col-md-3 col-sm-3 label-align">line ID<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="lineid" name="lineid" class="form-control col" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                    <div class="col-md-6 col-sm-6 ">
                                    <div class="wrapper-radio">
                                        <input type="radio" <?php if(isset($gender)) if($gender=='Pria') echo 'checked'; ?> value="Pria" id="radioPria" name="gender">
                                        <input type="radio" <?php if(isset($gender)) if($gender=='Wanita') echo 'checked'; ?> value="Wanita" id="radioWanita" name="gender">
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
                                        <textarea id="motivasi" name="motivasi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kelebihan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="kelebihan" name="kelebihan" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Kekurangan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="kekurangan" name="kekurangan" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Pengalaman<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea id="pengalaman" name="pengalaman" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div id="step-2">
                            <h2 class="StepTitle">Upload Berkas</h2>
                            1. Transkrip Lokal & KHS Terbaru
                            2. KTP 
                            3. Surat Lamaran
                            4. Curriculum Vitae (disertai dengan foto)
                            Semuanya jadikan satu file dengan format .pdf
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
    </div>
</div>