<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
            </div>
        </div>

        <div class="title_right" style="float:right;">
            <button type="button" onclick="generate()" class="btn bg-green">Generate Mahasiswa</button>
        </div>
        <br>
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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("ambil_praktikum/adds"); ?>">Tambah</a>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url("ambil_praktikum/updates"); ?>">Edit</a>
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
                                        <th>Mata Kuliah</th>
                                        <th>pil1</th>
                                        <th>pil2</th>
                                        <th>pil3</th>
                                        <th>pil4</th>
                                        <th>tipe</th>
                                        <th>terpilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($ambil_praktikum)) : ?>
                                    <?php if(is_array($ambil_praktikum)) : ?>
                                        <?php foreach($ambil_praktikum as $key) : ?>
                                        <tr>
                                            <td>
                                                <!-- <a href="#" class="btn btn-primary btn-sm btn-action"><i class="fa fa-folder"></i> View </a> -->
                                                <a href="<?php echo base_url("ambil_praktikum/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                            <td><?= (isset($key['id'])) ? $key['id'] : '' ?></td>
                                            <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?></td>
                                            <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> - <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                                            <td><?= (isset($key['pil1'])) ? $key['pil1'] : '' ?></td>
                                            <td><?= (isset($key['pil2'])) ? $key['pil2'] : '' ?></td>
                                            <td><?= (isset($key['pil3'])) ? $key['pil3'] : '' ?></td>
                                            <td><?= (isset($key['pil4'])) ? $key['pil4'] : '' ?></td>
                                            <td><?= (isset($key['tipe'])) ? $key['tipe'] : '' ?></td>
                                            <td><?= (isset($key['terpilih'])) ? $key['terpilih'] : '' ?></td>
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

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

function generate(){
    //Untuk generate mahasiswa yang semester ini seharusnya mengambil praktikum apa saja
    $.post(baseurl + "ambil_praktikum/generateadd", {},
    function(result) {
        alert(result);
        if(result == "sukses"){

        }
        else{
            alert()
        }
    });
}
</script>