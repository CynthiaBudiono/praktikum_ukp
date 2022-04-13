<style>
.bg-blue{
  background-color: #82b6d9;
  border: 1px solid black !important;
}
.bg-red{
  background-color: #ef8677;
  border: 1px solid black !important;
}
.badge{
  padding: 8px;
  font-size: 12px;
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

            <span class="badge bg-blue">Kuliah</span>
            <span class="badge bg-green">Bisa</span>
            <span class="badge bg-red">Berhalangan</span>

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
        <div id="detail_kelas">

            <!-- <div class="col-md-12 col-sm-12 ">
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
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable_ambil_praktikum" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
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
                                    <tbody id="data_ambil_praktikum">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

$(document).ready(function() {
    view();
});
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

function view(){
    $.post(baseurl + "ambil_praktikum/getclassgroup", {

    },
    function(result) {
        alert(result);
        // $("#detail_kelas").html(result);
        var arr = JSON.parse(result);
        
        var html = "";
       
        // for(var i = 0; i < arr.length; i++){
        //     var kal = "";

        //     alert("LENGTH mahasiswa/kelas : " + arr[i].length);
        //     kal += '<div class="col-md-12 col-sm-12 ">';
        //         kal += '<div class="x_panel">';
        //             kal += '<div class="x_title">';
        //                 kal += '<h2>'+ arr[i][0]['tipe'] + ' ' + arr[i][0]['kode_mk'] + ' - ' + arr[i][0]['nama_subject'] + '</h2>';
        //                 kal += '<ul class="nav navbar-right panel_toolbox">';
        //                     // kal += '<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>';
        //                     // kal += '<li><a class="close-link"><i class="fa fa-close"></i></a></li>';
        //                     kal +='<li><a data-toggle="collapse" href="#datacollapse' + i + '" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-up"></i></a></li>';
        //                 kal += '</ul>';
        //                 kal += '<div class="clearfix"></div>';
        //             kal += '</div>';
        //             kal += '<div id="list_jadwal' + i + '"></div>';
        //             // kal += '<a class="btn btn-sm bg-green" href="<?php //echo base_url("ambil_praktikum/adds"); ?>">Tambah</a>

        //             //JADWAL PRAKTIKUM = jp
        //             $.post(baseurl + "kelas_praktikum/getjadwalforambilprak", {
        //                 kode_mk: arr[i][0]['kode_mk'],
        //                 tipe: arr[i][0]['tipe'],
        //             },
        //             function(result_jadwal) {
        //                 alert("JADWAAL" + result_jadwal);

        //                 if(result_jadwal != null){
        //                     var arr_jadwal = JSON.parse(result_jadwal);
        //                     var kal_jadwal = '';

        //                     kal_jadwal += '<div class="x_content">';

        //                         kal_jadwal += '<table class="table table-striped">';
        //                             kal_jadwal += '<thead>';
        //                             kal_jadwal += '<tr>';
        //                                 kal_jadwal += '<th>kelas paralel</th>';
        //                                 kal_jadwal += '<th>hari</th>';
        //                                 kal_jadwal += '<th>jam</th>';
        //                                 kal_jadwal += '<th>terisi</th>';
        //                             kal_jadwal += '</tr>';
        //                             kal_jadwal += '</thead>';
        //                             kal_jadwal += '<tbody>';

        //                             for(var jp = 0; jp < arr_jadwal.length; jp++){
        //                                 kal_jadwal += '<tr>';
        //                                 kal_jadwal += '<th>' + arr_jadwal[jp]['kelas_paralel']+ '</th>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['hari']+ '</td>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['jam']+ '</td>';
        //                                 kal_jadwal += '<td>' + arr_jadwal[jp]['terisi']+ '</td>';
        //                                 kal_jadwal += '</tr>';
        //                             }
        //                             kal_jadwal += '</tbody>';
        //                         kal_jadwal += '</table>';
        //                     kal_jadwal += '</div>';
                            
        //                     $("#list_jadwal" + i).html(kal_jadwal);
        //                 }
                        
        //             });


        //             // kal += '';
        //             kal += '<div class="x_content collapse show" id="datacollapse' + i + '">';
        //                 kal += '<div class="row">';
        //                     kal += '<div class="col-sm-12">';
        //                         kal += '<div class="card-box table-responsive">';
        //                             kal += '<table id="datatable_ambil_praktikum' + i + '" class="table table-striped table-bordered" style="width:100%">';
        //                             kal += '<thead>';
        //                                 kal += '<tr>';
        //                                     kal += '<th>NRP</th>';
        //                                     kal += '<th>IPK</th>';
        //                                     kal += '<th>pil1</th>';
        //                                     kal += '<th>pil2</th>';
        //                                     kal += '<th>pil3</th>';
        //                                     kal += '<th>pil4</th>';
        //                                     kal += '<th>terpilih</th>';
        //                                 kal += '</tr>';
        //                             kal += '</thead>';
        //                             kal += '<tbody id="data_ambil_praktikum' + i + '">';

        //                                 for(var j = 0; j < arr[i].length; j++){

        //                                     kal += '<tr>';
        //                                         kal += '<td>'+ arr[i][j]['NRP'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['ipk'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil1'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil2'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil3'] +'</td>';
        //                                         kal += '<td>'+ arr[i][j]['pil4'] +'</td>';
        //                                         kal += '<td>';
        //                                             kal += '<div>' + arr[i][j]['terpilih'];
        //                                             kal +='<label style="float:right;">';
        //                                                 kal +='<select class="select2_single" name ="ddtahun_ajaran" id="ddtahun_ajaran" tabindex="-1">';
        //                                                     kal += '<option value=""></option></select>';
        //                                                 kal += '</label>';
        //                                             kal += '</div>';
        //                                         kal += '</td>';
        //                                     kal += '</tr>';
        //                                 }
                                        
        //                             kal += '</tbody>';
        //                             kal += '</table>';
        //                         kal += '</div>';
        //                     kal += '</div>';
        //                 kal += '</div>';
        //             kal += '</div>';
        //         kal += '</div>';
        //     kal += '</div>';

        //     $("#data_ambil_praktikum"+ i).html(kal);
        //     $("#datatable_ambil_praktikum" + i).DataTable({
        //         dom: "Blfrtip",
        //         buttons: [
        //             {
        //                 extend: "copy",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "csv",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "excel",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "pdfHtml5",
        //                 className: "btn-sm"
        //             },
        //             {
        //                 extend: "print",
        //                 className: "btn-sm"
        //             },
        //         ],
        //         responsive: true
        //     });
        //     html += kal;
        // }
        // $("#detail_kelas").html(html);
    });
}


</script>