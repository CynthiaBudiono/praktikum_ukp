<!-- Yearpicker -->
<link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
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
                        <h2><?= isset($title) ? $title : "-" ?></h2>
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
                        <form action="" method="post" class="form-horizontal form-label-left">
                        
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Logo</label>
                                <div class="col-md-9 col-sm-9 ">
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Semester</label>
                                <div id="semester" class="col-md-9 col-sm-9 btn-group" data-toggle="buttons">
                                    <label class="btn btn-info" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="semester" value="1" class="join-btn"> &nbsp; Ganjil &nbsp;
                                    </label>
                                    <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="semester" value="2" class="join-btn"> Genap
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Tahun Ajaran</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="input-group input-daterange" id="tahun_ajaran">
                                        <input type="text" class="form-control" id="start_year" value="<?= $start_year ?>"> <!-- value="<?= $start_year ?>" value="2012-04-05"-->
                                        <div class="input-group-addon">-</div>
                                        <input type="text" class="form-control" id="end_year" value="<?= $end_year ?>"> <!-- value="<?= $end_year ?>" value="2012-04-19" -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Nama Link Footer</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="nama_link_footer" id="nama_link_footer" placeholder=" Informatics..." required value="<?= (isset($detil[0]['nama'])) ? $detil[0]['nama'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Link Footer</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="url" class="form-control" name="link_footer" id="link_footer" placeholder="http.." required value="<?= (isset($detil[0]['nama'])) ? $detil[0]['nama'] : '' ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9">
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

<script>
    $('#tahun_ajaran input').each(function () {
        $(this).datepicker({
            autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $(this).datepicker('clearDates');

        $('#start_year').change( function(){
            $('#end_year').val(new Date($('#start_year').val()+1).getFullYear());
        });
    });
    

  $("#semester").on("click" , function () {
    alert($("input[type='radio']:checked").val());
  })

 </script>