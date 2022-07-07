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
                        <h2><?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo 'Update'; }} else {echo 'Add'; } ?> </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="<?php if(isset($detil[0]['id'])) { if($detil[0]['id'] != "" || $detil[0]['id'] != NULL){ echo (base_url('user_group/update'));}} else { echo (base_url('user_group/add')); } ?>" method="post" class="form-horizontal form-label-left">
                        
                            <input type="hidden" class="form-control" name="idusergroup" id="idusergroup" value="<?= (isset($detil[0]['id'])) ? $detil[0]['id'] : '' ?>">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="ex. admin" required value="<?= (isset($detil[0]['nama'])) ? $detil[0]['nama'] : '' ?>">
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

                            <div class="form-group row">
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