<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
            </div>
        </div>

        <div class="clearfix"></div>

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
                    <a class="btn btn-sm bg-green" href="<?php echo base_url("calon_asisten_dosen/adds"); ?>">Tambah</a>
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
                                        <th>Mahasiswa</th>
                                        <th>created</th>
                                        <th>updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($calon_asisten_dosen)) : ?>
                                    <?php if(is_array($calon_asisten_dosen)) : ?>
                                        <?php foreach($calon_asisten_dosen as $key) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('calon_asisten_dosen/getdetail/'); ?><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?>" class="btn btn-primary btn-sm btn-action"><i class="fa fa-eye"></i> View </a>
                                                <a href="<?php echo base_url("calon_asisten_dosen/updates/"); echo base64_encode($key['id']);?>" class="btn btn-info btn-sm btn-action"><i class="fa fa-pencil"></i> Edit </a>
                                                <!-- <a href="#" class="btn btn-danger btn-sm btn-action"><i class="fa fa-trash-o"></i> Delete </a> -->
                                                <?php if(isset($key['asisten'])){ if($key['asisten'] == "tidak_ada"){?>
                                                    <a href="#" onclick=confirm(<?= (isset($key['id'])) ? $key['id'] : '' ?>) class="btn btn-success btn-sm btn-action"><i class="fa fa-check"></i> Confirm </a>
                                                <?php } }?>
                                            </td>
                                            <td><?= (isset($key['id'])) ? $key['id'] : '' ?></td>
                                            <td><?= (isset($key['NRP'])) ? $key['NRP'] : '' ?> <?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                                            <td><?= (isset($key['created'])) ? $key['created'] : '' ?></td>
                                            <td><?= (isset($key['updated'])) ? $key['updated'] : '' ?></td>
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

$(document).ready(function() {
});

function confirm($id){
    // alert($id);
    
    $.post(baseurl + "asisten/addfromcalon", {
        id_calon_asisten_dosen: $id,
    },
    function(result) {
        // alert(result);
        if(result == 'success'){
            // view();

            var url = "<?= base_url('asisten') ?>";
            window.location = url;
        }
        else{
            alert(result);
        }
    });
}
</script>