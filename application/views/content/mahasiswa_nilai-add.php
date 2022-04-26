<style>
    p{
        margin-bottom: 0px;
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
        <div class="title_right" style="float:right;">
            <button class="btn btn-md bg-green" onclick=simpan(<?= (isset($primary)) ? $primary : '' ?>,'<?= (isset($mode)) ? $mode : '' ?>') >Simpan</button>
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
                    <!-- <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/adds"); ?>">Tambah Pertemuan</a> -->
                    <!-- <a class="btn btn-sm bg-green" href="<?php echo base_url("kelas_praktikum/addwexcel"); ?>">Tambah w/ Excel</a> -->
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-add" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>Actions</th> -->
                                        <th>Mahasiswa</th>
                                        <th>Absen<br><small>M = masuk, I = ijin, A = alpa</small></th>
                                        <th>Nilai Awal</th>
                                        <th>Nilai Materi</th>
                                        <th>Nilai Tugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($detail_kelas)) : ?>
                                    <?php if(is_array($detail_kelas)) : ?>
                                        <input type="hidden" name="length_kelas" id="length_kelas" value="<?= count($detail_kelas) ?>">
                                        <?php foreach($detail_kelas as $index => $key) : ?>
                                        <tr>
                                            <td id="nrp<?= $index ?>"><?= (isset($key['NRP'])) ? $key['NRP']: '' ?> - <?= (isset($key['nama_mahasiswa'])) ? $key['nama_mahasiswa'] : '' ?></td>
                                            <td>
                                            <?php if(isset($key['status_absensi'])){ ?>
                                                <?php if($key['status_absensi'] == 'M'){ ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio1" value="option1" checked>
                                                    <label class="form-check-label" for="inlineRadio1">M</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2">I</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio3" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3">A</label>
                                                </div>
                                                <?php }else if($key['status_absensi'] == 'I'){ ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">M</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio2" value="option2" checked>
                                                    <label class="form-check-label" for="inlineRadio2">I</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio3" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3">A</label>
                                                </div>
                                                <?php }else if($key['status_absensi'] == 'A'){ ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">M</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2">I</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions<?= $index ?>" id="inlineRadio3" value="option3" checked>
                                                    <label class="form-check-label" for="inlineRadio3">A</label>
                                                </div>
                                            <?php }}?>
                                            </td>
                                            <td><input type="number" class="form-control" name="nilai_awal" id="nilai_awal<?= $index ?>" min="1" max="100" value="<?= (isset($key['nilai_awal'])) ? $key['nilai_awal'] : '' ?>"></td>
                                            <td><input type="number" class="form-control" name="nilai_materi" id="nilai_materi<?= $index ?>" min="1" max="100" value="<?= (isset($key['nilai_materi'])) ? $key['nilai_materi'] : '' ?>"></td>
                                            <td><input type="number" class="form-control" name="nilai_tugas" id="nilai_tugas<?= $index ?>" min="1" max="100" value="<?= (isset($key['nilai_tugas'])) ? $key['nilai_tugas'] : '' ?>"></td>
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

    $(document).ready(function() {
        $('#datatable-add').DataTable( {
            dom: "Blfrtip",
            buttons: [
                {
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });
    });

    function simpan($id, $mode){
        alert("ID " + $id);
        alert("MODE " + $mode);
        alert($("#length_kelas").val());

        var length = $("#length_kelas").val();
        var data_mahasiswa_nilai = new array();

        for(var i = 0; i < length; i++){
            var isiarray = {
                nrp: $("#nrp"+ i).html(),
                status_absensi: $("input[name='inlineRadioOptions'" + i + "]:checked").val(),
                nilai_awal: $("#nilai_awal"+ i).val(),
                nilai_materi: $("#nilai_materi"+ i).val(),
                nilai_tugas: $("#nilai_tugas"+ i).val(),
            };
            alert("isiarray" + isiarray);

            data_mahasiswa_nilai.push(isiarray);
        }

        if($("#mode").val() == 'add') { //add
            $.post(baseurl + "mahasiswa_nilai/add", {
                id_kelas_prak: $id,
                data: data_mahasiswa_nilai
            },
            function(result) {
                alert(result);
            });
        }
        else if ($("#mode").val() == 'update'){ //update
            $.post(baseurl + "mahasiswa_nilai/update", {
                id_kelas_prak: $id,
                data: data_mahasiswa_nilai
            },
            function(result) {
                alert(result);
            });
        }
    }
</script>