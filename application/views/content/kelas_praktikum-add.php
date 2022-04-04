<style>
.pop-over-style{
    background-color: #fef7ea;
    border: 1px solid #ed9500;
}

.pop-over-style i{
    padding: 6px;
    color: white;
    background-color: #ee9500;
    border-radius: 8px;
    box-shadow: 2px 2px #fceacd;
    margin-right: 10px;
}
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= isset($title) ? $title : "-" ?><small> Untuk Periode- <?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></small></h3>
            </div>
        </div>
        <input type="hidden" id="mode" name="mode" value="<?= isset($mode) ? $mode : "-"?>">
    

<div class="container">
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-4 col-md-offset-3">
			<h3>Import Data</h3>
			<?php if(!empty($this->session->flashdata('status'))){ ?>
			<div class="alert alert-info" role="alert"><?= $this->session->flashdata('status'); ?></div>
			<?php } ?>
			<form action="<?= base_url('ImportController/import_excel'); ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Pilih File Excel</label>
					<input type="file" name="fileExcel">
				</div>
				<div>
					<button class='btn btn-success' type="submit">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			    		Import		
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
			<h3>Daftar Data</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Jurusan</th>
							<th>Angkatan</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							foreach ($list_data as $row) {
						 ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['jurusan'] ?></td>
							<td><?= $row['angkatan'] ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</div>

        <form action="<?php if(isset($mode)) { if($mode == 'update'){ echo (base_url('kelas_praktikum/update'));}} else { echo (base_url('kelas_praktikum/add')); } ?>" method="post" class="form-horizontal form-label-left">
        
            <div class="title_right" style="float:right;">
                <button type="button" onclick="summary()" class="btn bg-yellow">Summary</button>
                <button type="button" onclick="addrow()" class="btn bg-green">Tambah</button>
                <button type="button" class="btn btn-danger">Cancel</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

            <div class="ui floating search dropdown button">
                <span class="text">Search Dropdown</span>
                <div class="menu">
                    <div class="item" value="AAAAAAAA">Arabic</div>
                    <div class="item" value="BBBBBBBB">Chinese</div>
                    <div class="item">Danish</div>
                    <div class="item">Dutch</div>
                    <div class="item">English</div>
                    <div class="item">French</div>
                    <div class="item">German</div>
                    <div class="item">Greek</div>
                    <div class="item">Hungarian</div>
                    <div class="item">Italian</div>
                    <div class="item">Japanese</div>
                    <div class="item">Korean</div>
                    <div class="item">Lithuanian</div>
                    <div class="item">Persian</div>
                    <div class="item">Polish</div>
                    <div class="item">Portuguese</div>
                    <div class="item">Russian</div>
                    <div class="item">Spanish</div>
                    <div class="item">Swedish</div>
                    <div class="item">Turkish</div>
                    <div class="item">Vietnamese</div>
                </div>
            </div>
 
            <div id="container-form">
            <input type="hidden" id="total_row" name="total_row">

            
            </div> <!-- /conteiner-form -->
        </form>
    </div>
</div>

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";
var row = 0;
$(document).ready(function() {
    $('.ui.dropdown').dropdown();
    alert($('.ui.dropdown').val());
    // alert($('#mode').val());
    if($('#mode').val() == 'add'){
        addrow();
    }
    else if($('#mode').val() == 'update'){
        $.post(baseurl + "kelas_praktikum/getperiodnow", {},
        function(result) {
            // alert(result);
           
            var arr = JSON.parse(result);
            for(var i = 0; i < arr.length; i++){
                addrow();
                alert((i+1) + " " + arr[i]['hari']);
                // $("#hari-summary1").val(arr[i]['hari']);
                $("#hari-summary"+(i+1)).html(arr[i]['hari']);
                $("#jam-summary"+(i+1)).html(arr[i]['jam']);
                $("#durasi-summary"+(i+1)).html(arr[i]['durasi']);
                $("#subject-summary"+(i+1)).html(arr[i]['nama_subject']);
                $("#kelas_paralel-summary"+(i+1)).html(arr[i]['kelas_paralel']);

                // if(arr[i]['status'] == 1){
                //     $("#status"+(i+1)).prop("checked", true);
                // }
                // else{
                //     $("#status"+(i+1)).prop("checked", true);
                // }
                

            }
        });
    }


    // $("#status").prop("checked", false);

    // $( "#subject" ).on( 
    // "autocompletechange", 
    // function( event, ui ) {
    //     alert("AAAA");
    //     $('#subject-summary').html($('#subject').val());
    // });

    // $('#subject').change(function() {
    //     alert("masuk");
    //     $('#text-summary').html($('#subject').val());
    // });

    }) // end Document Ready

//    $(function () {
//         $('#timepicker').datetimepicker({
//             format: 'H:mm'
//         });
//     });

    var toggle = 'close';
    function summary(){
        if(toggle == 'open'){
            $('.x_content').css('display', 'block');
            $( ".fa-chevron-down" ).removeClass( "fa-chevron-down" ).addClass( "fa-chevron-up" );
            toggle = 'close';
        }
        else{
            $('.x_content').css('display', 'none');
            $( ".fa-chevron-up" ).removeClass( "fa-chevron-up" ).addClass( "fa-chevron-down" );
            toggle = 'open';
        }
    }

    function confirmdelete(el, index) {
        // alert("masuk confirmdelete");
        if (window.confirm("Menghapus Item ini?")) {

            var element = el.parentNode.parentNode.parentNode.parentNode;

            element = element.parentNode;

            element.remove();
            $('#status_row'+ index).val("nonactive");
        } 
        else {
        }
    }

    function getjadwalpengajar($row, $idinput){
        // alert(row + " " + $idinput);
        alert('#'+ idinput + row);
        // alert($('#id_nip1'+ row).val());
        // alert($('#nip1'+ row).val());
        // hari: "senin",
        // jam: "12:00",
        // durasi: "180"
        $.post(baseurl + "jadwal_berhalangan/getbypengajar", {
            pengajar: $('#'+ idinput + row).val(),

        },
        function(result) {
            
            // console.log("AAAAAAA " + result);
            
            if(result != 0){
                // alert("aaaaaaaa" + result);
                var arr = JSON.parse(result);

                $('#have_warning' + row).css('display', 'block');
                if(arr[0]['role'] == 'mahasiswa'){
                    $('#error_msg' + row).html("jadwal "+ arr[0]['nama_mahasiswa'] +" berhalangan");
                }
                else if(arr[0]['role'] == 'dosen'){
                    $('#error_msg' + row).html("jadwal "+ arr[0]['nama_dosen'] +" berhalangan");
                }
                $('#div_alert' + row).css('display', 'block');
            }
        });
    }

    function addrow(){
        row +=1;
        var kal ='';

        kal +='<div class="col-md-12 col-sm-12">';
            kal +='<div class="x_panel">';
                kal +='<div class="x_title">';
                    kal +='<h2><label id="hari-summary' + row + '"></label> <label id="jam-summary' + row + '"></label> <label id="durasi-summary' + row + '"></label> <label id="subject-summary' + row + '"></label> <label id="kelas_paralel-summary' + row + '"></label></h2>';
                    kal +='<div>';
                        kal +='<ul class="nav navbar-right panel_toolbox">';
                            kal +='<li style="margin-right: 6px; padding-top: 6px;"><input type="checkbox" class="toggle-switch" name="status' + row + '" id="status' + row + '" checked></li>';
                            kal +='<li name="have_warning' + row + '" id="have_warning' + row + '" style="margin: 0px 10px; padding-top: 4px; display:none;"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color:#ee9500;"></i></li>';
                            kal +='<li style="margin: 0px 10px; padding-top: 4px;"><i class="fa fa-trash color-red fa-2x" onclick=confirmdelete(this,' + row + ') aria-hidden="true"></i></li>';
                            kal +='<li><a data-toggle="collapse" href="#datacollapse' + row + '" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-chevron-up"></i></a></li>';
                        kal +='</ul>';
                    kal +='</div>';
                        
                    kal +='<div class="clearfix"></div>';
                kal +='</div>';
                kal +='<div class="x_content collapse" id="datacollapse' + row + '">';
                    kal +='<div class="alert alert-dismissible pop-over-style" role="alert" id="div_alert' + row + '" style="display:none;">';
                        kal +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>';
                        kal +='</button>';
                        kal +='<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                        kal +='<strong>Warning.</strong> <span id="error_msg' + row + '">check yo self, youre not looking too good.</span>';
                    kal +='</div>';
                    kal +='<input type="hidden" id="status_row' + row + '" name="status_row' + row + '" value="active">';
                
                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Matakuliah</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" id="subject' + row + '" name="subject' + row + '" placeholder="MatKul" class="subject_input form-control" required="required">';
                            kal +='<input type="hidden" id="id_subject' + row + '" name="id_subject' + row + '" class="form-control">';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Kelas Paralel</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" id="kelas_paralel' + row + '" name="kelas_paralel' + row + '" placeholder="ex. A" class="kelas_paralel_input form-control" required="required" maxlength="1">';
                            kal +='<span class="fa fa-gavel form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Laboratorium</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input type="text" name="laboratorium' + row + '" id="laboratorium' + row + '" placeholder="lab" class="laboratorium_input form-control" required="required"/>';
                            kal +='<input type="hidden" name="id_laboratorium' + row + '" id="id_laboratorium' + row + '" class="form-control"/>';
                            kal +='<span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';
                        
                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Hari / Jam</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<div class="row">';
                                kal +='<div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-left: 10px;">';
                                kal +='<select class="hari_input select2_single form-control has-feedback-left" name ="hari' + row + '" id="hari' + row + '" tabindex="-1" required="required">';
                                    kal +='<option>--choose hari--</option>';
                                    kal +='<option value="Senin">Senin</option>';
                                    kal +='<option value="Selasa">Selasa</option>';
                                    kal +='<option value="Rabu">Rabu</option>';
                                    kal +='<option value="Kamis">Kamis</option>';
                                    kal +='<option value="Jumat">Jumat</option>';
                                    kal +='<option value="Sabtu">Sabtu</option>';
                                kal +='</select>';
                                kal +='<span class="fa fa-sun-o form-control-feedback left" aria-hidden="true"></span>';
                                kal +='</div>';

                                kal +='<div class="col-md-6 col-sm-6" style="padding-right: 10px;">';
                                    kal +='<div class="input-group date" id="timepicker' + row + '">';
                                        kal +='<input type="text" required="required" name ="jam' + row + '" id="jam' + row + '" class="jam_input form-control"/>';
                                        kal +='<span class="input-group-addon">';
                                            kal +='<span class="fa fa-calendar"></span>';
                                        kal +='</span>';
                                    kal +='</div>';
                                kal +='</div>';
                            kal +='</div>';
                        kal +='</div>';
                    kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Durasi</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                            kal +='<input class="durasi_input form-control" type="number" class="number" name="durasi' + row + '" id="durasi' + row + '" min="1" max="300" required="required" placeholder="menit">';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';

                    // kal +='<div class="form-group row">';
                    //     kal +='<label class="col-form-label col-md-3 col-sm-3 ">Terisi</label>';
                    //     kal +='<div class="col-md-9 col-sm-9 form-group has-feedback">';
                    //         kal +='<input class="form-control" type="number" class="number" name="terisi' + row + '" id="terisi' + row + '" min="1" max="300" required="required" placeholder="orang">';
                    //         kal +='<span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>';
                    //     kal +='</div>';
                    // kal +='</div>';

                    kal +='<div class="form-group row">';
                        kal +='<label class="col-form-label col-md-3 col-sm-3 ">Pengajar</label>';
                        kal +='<div class="col-md-9 col-sm-9 form-group" style="padding: 0px;">';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip1' + row + '" id="nip1' + row + '" placeholder="pengajar1" required="required" class="form-control" />';
                                kal +='<input type="hidden" name="id_nip1' + row + '" id="id_nip1' + row + '" class="form-control" />';
                            kal +='</div>';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip2' + row + '" id="nip2' + row + '" placeholder="pengajar2" class="form-control" />'; 
                                kal +='<input type="hidden" name="id_nip2' + row + '" id="id_nip2' + row + '" class="form-control" />';                                   
                            kal +='</div>';
                            kal +='<div class="col-md-4 col-sm-6">';
                                kal +='<input type="text" name="nip3' + row + '" id="nip3' + row + '" placeholder="pengajar3" class="form-control has-feedback-right" />';
                                kal +='<input type="hidden" name="id_nip3' + row + '" id="id_nip3' + row + '" class="form-control" />';
                            kal +='</div>';
                            kal +='<span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>';
                        kal +='</div>';
                    kal +='</div>';
                kal +='</div>';
            kal +='</div>';
        kal +='</div>';

        $('#container-form').append(kal);
        
        $('#total_row').val(row);
        // Data yang ditamilkan pada autocomplete.
        $.post(baseurl + "subject/gethavepraktikum", {},
        function(result) {
            var arr = JSON.parse(result);
            var subject = []
            for(var i=0; i<arr.length; i++){
                subject.push({value: arr[i]['nama'], data: arr[i]['kode_mk']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#subject' + row ).autocomplete({
                lookup: subject,
                onSelect: function(suggestion){
                    // alert(suggestion.data);
                    // return suggestion.data;
                    $('#id_subject' + row).val(suggestion.data);
                }
            });
        });

        $.post(baseurl + "laboratorium/getactivelab", {},
        function(result) {
            var arr = JSON.parse(result);
            var lab = []
            for(var i=0; i<arr.length; i++){
                lab.push({value: arr[i]['nama'], data: arr[i]['kode_lab']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#laboratorium' + row ).autocomplete({
                lookup: lab,
                onSelect: function(suggestion){
                    // alert(suggestion.data);
                    // return suggestion.data;
                    $('#id_laboratorium' + row).val(suggestion.data);
                }
            });
        });

        $.post(baseurl + "dosen/getactivepengajar", {}, //DOSEN & Asisten Dosen
        function(result) {
            var arr = JSON.parse(result);
            var pengajar = [];
            for(var i=0; i<arr.length; i++){
                pengajar.push({value: arr[i]['nama'], data: arr[i]['NIP']})
            }
            // Selector input yang akan menampilkan autocomplete.
            $( '#nip1' + row ).autocomplete({
                lookup: pengajar,
                onSelect: function(suggestion){
                    // alert(suggestion.data);
                    // return suggestion.data;
                    $('#id_nip1' + row).val(suggestion.data);
                }
            });
            $( '#nip2' + row ).autocomplete({
                lookup: pengajar,
                onSelect: function(suggestion){
                    // return suggestion.data;
                    $('#id_nip2' + row).val(suggestion.data);
                }
            });
            $( '#nip3' + row ).autocomplete({
                lookup: pengajar,
                onSelect: function(suggestion){
                    // return suggestion.data;
                    $('#id_nip3' + row).val(suggestion.data);
                }
            });
        });

        $('#timepicker'+ row).datetimepicker({
            format: 'H:mm'
        });

        $('.subject_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(7,10);
            $('#subject-summary'+ row).html($('#subject'+ row).val());
        });

        $('.kelas_paralel_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(13,10);
            $('#kelas_paralel-summary'+ row).html("(" + $('#kelas_paralel'+ row).val().toUpperCase() + ")");
        });

        $('.durasi_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(6,10);
            $('#durasi-summary'+ row).html("(" + $('#durasi'+ row).val() + " menit) ");
            // getjadwalpengajar();
        });
        
        $('.hari_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(4,10);
            $('#hari-summary'+ row).html($('#hari'+ row).val());
            // getjadwalpengajar();
        });

        $('.jam_input').on("change paste keyup select", function() {
            var id= this.id;
            var row= id.substr(3,10);
            $('#jam-summary'+ row).html($('#jam'+ row).val());
            // getjadwalpengajar();
        });
        
        

        $('#nip1'+ row).on("change paste keyup select", function() {
            getjadwalpengajar(row, 'nip1');
        });

    }

</script>