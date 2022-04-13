<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
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
                    <form class="form-horizontal form-label-left">
                        
                        <input type="hidden" class="form-control" name="mode" id="mode" value="add">

                        <input type="hidden" class="form-control" name="id" id="id" required value="<?= (isset($detil[0]['id'])) ? $detil[0]['id'] : '' ?>">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">NRP</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" id="selecttipeasisten" onchange="getdetail()">
                                    <option value="">--Choose option--</option>
                                    <option value="asisten_dosen">Asisten Dosen</option>
                                    <option value="asisten_tetap">Asisten Tetap</option>
                                </select>
                            </div>
                        </div>

                        <div id="divdetail">

                            nama
                            id_pendaftaran asisten
                            data lengkap
                            daftar tanggal brp

                            <!-- <div class="form-group row" id="divketerangan">
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
                            </div> -->

                            
                        </div>

                        <div class="form-group row" id="divstatus">
                            <label class="control-label col-md-3 col-sm-3 ">Status</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                    <label>
                                        <input type="checkbox" name="status" id="status" class="toggle-switch" checked/>
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
            </div> <!-- /x_panel -->
        </div> <!-- /col-md -->

        <!-- <div class="col-md-12 col-sm-12">
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
                    <form class="form-horizontal form-label-left">

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Kode Lab</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" placeholder="ex. JK">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" placeholder="ex. Jaringan Komputer">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Quota Maksimum</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" placeholder="quota max" min=1>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 ">Status</label>
                            <div class="col-md-9 col-sm-9 ">
                                <div class="">
                                    <label>
                                        <input type="checkbox" class="js-switch" checked />
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
                </div>  -->
                <!-- /x_content -->
            <!-- </div>
        </div> -->

        <!-- VIEW -->
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
                <div>
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("asisten/adds"); ?>">Tambah</a>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>id</th>
                                        <th>NRP</th>
                                        <th>nama</th>
                                        <th>status</th>
                                        <th>Tanggal Diterima</th>
                                        <th>keterangan</th>
                                        <th>periode pendaftaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($asisten)) : ?>
                                    <?php if(is_array($asisten)) : ?>
                                        <?php foreach($asisten as $key) : ?>
                                        <tr>
                                            <td>
                                                <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a> -->
                                                <a href="<?php echo base_url("asisten/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                            <td><?= (isset($key['id'])) ? $key['id'] : '' ?></td>
                                            <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?></td>
                                            <td><?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                                            <td>
                                                <?php 
                                                    if(isset($key['status'])) if($key['status']==1) echo '<span class="badge bg-green">active</span>'; else echo '<span class="badge bg-danger">non active</span>';?>
                                            </td>
                                            <td><?= (isset($key['tanggal_diterima'])) ? $key['tanggal_diterima'] : '' ?></td>
                                            <td><?= (isset($key['keterangan'])) ? $key['keterangan'] : '' ?></td>
                                            <td><?php if(isset($key['semester_pendaftaran_asdos'])) if($key['semester_pendaftaran_asdos'] == 1) echo 'Ganjil'; else echo 'Genap';?> <?= (isset($key['tahun_ajaran_pendaftaran_asdos'])) ? $key['tahun_ajaran_pendaftaran_asdos'] : '' ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
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
    // view();
    $(document).ready(function() {	
        // alert("masukkkkkkkk ready");	
        view()
    });


    function getdetail(){
        alert("masuk");

        alert($("#selecttipeasisten").val());

        // if(asisten_dosen) -> getvalue()

        // if asisten tetap -> get value angkatan
    }

    function view(){

    }

</script>


