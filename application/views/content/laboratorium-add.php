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
                        <h2>Add</h2>
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
                        <form action="<?php if(isset($detil[0]['kode_lab'])) if($detil[0]['kode_lab'] != "" || $detil[0]['kode_lab'] != NULL) echo (base_url('laboratorium/update')); else echo (base_url('laboratorium/add')); ?>" method="post" class="form-horizontal form-label-left">
                        
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Kode Lab</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="kodelab" id="kodelab" placeholder="ex. JK" required value="<?= (isset($detil[0]['kode_lab'])) ? $detil[0]['kode_lab'] : '' ?>" <?= (isset($detil[0]['kode_lab'])) ? 'disabled' : '' ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="ex. Jaringan Komputer" required value="<?= (isset($detil[0]['nama'])) ? $detil[0]['nama'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Quota Maksimum</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" name="quota" id="quota" placeholder="quota max" min=1 required value="<?= (isset($detil[0]['quota_max'])) ? $detil[0]['quota_max'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Status</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="">
                                        <label>
                                            <input type="checkbox" name="status" id="status" class="js-switch" <?php if(isset($detil[0]['status'])) if($detil[0]['status']==1) echo 'checked'; ?>/>
                                        </label>
                                    </div>
                                </div>
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