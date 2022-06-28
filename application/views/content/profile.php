<style>
    .fa-files-o{
        color: #1d81be;
    }

    blockquote{
        word-break: break-word;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>
        </div>
    
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small>Activity report</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <img class="img-responsive avatar-view" src="<?= base_url() ?>/assets/images/user.png" alt="Avatar" title="Change the avatar" style="width:100%">
                            </div>
                            </div>
                            <h3><?= $this->session->userdata('logged_name');?></h3>

                            <ul class="list-unstyled user_data">
                                <?php if($this->session->userdata('from_table') == "user"){ ?>
                                    <li><i class="fa fa-male user-profile-icon"></i>&nbsp;&nbsp;&nbsp;<?php if((isset($profile[0]['level']))){ if($profile[0]['level'] == 1) echo "admin"; else echo "kepala laboratorium";} ?></li>
                                    <li><i class="fa fa-envelope user-profile-icon"></i>&nbsp; <?= (isset($profile[0]['email'])) ? $profile[0]['email'] : '-' ?></li>
                                    <li><i class="fa fa-flask user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['nama_laboratorium'])) ? $profile[0]['nama_laboratorium'] : '-' ?></li>
                                    <li><i class="fa fa-sign-in user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['last_login'])) ? $profile[0]['last_login'] : '-' ?></li>
                                <?php } elseif($this->session->userdata('from_table') == "mahasiswa"){ ?>
                                    <li><i class="fa fa-male user-profile-icon"></i>&nbsp;&nbsp;&nbsp;<?= (isset($profile[0]['NRP'])) ? $profile[0]['NRP'] : '-' ?> ~ <?= (isset($profile[0]['nama'])) ? $profile[0]['nama'] : '-' ?></li>
                                    <li><i class="fa fa-envelope user-profile-icon"></i>&nbsp; <?= (isset($profile[0]['email'])) ? $profile[0]['email'] : '-' ?></li>
                                    <li><i class="fa fa-flag user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['ips'])) ? $profile[0]['ips'] : '-' ?></li>
                                    <li><i class="fa fa-flag-o user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['ipk'])) ? $profile[0]['ipk'] : '-' ?></li>
                                    <li><i class="fa fa-sign-in user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['last_login'])) ? $profile[0]['last_login'] : '-' ?></li>
                                <?php } elseif($this->session->userdata('from_table') == "asisten"){ ?>
                                    <li><i class="fa fa-id-badge user-profile-icon"></i>&nbsp; asisten <?= (isset($profile[0]['tipe'])) ? $profile[0]['tipe'] : '-' ?></li>
                                    <li><i class="fa fa-male user-profile-icon"></i>&nbsp;&nbsp;&nbsp;<?= (isset($profile[0]['NRP'])) ? $profile[0]['NRP'] : '-' ?> ~ <?= (isset($profile[0]['nama'])) ? $profile[0]['nama'] : '-' ?></li>
                                    <li><i class="fa fa-envelope user-profile-icon"></i>&nbsp; <?= (isset($profile[0]['email'])) ? $profile[0]['email'] : '-' ?></li>
                                    <li><i class="fa fa-flag user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['ips'])) ? $profile[0]['ips'] : '-' ?></li>
                                    <li><i class="fa fa-flag-o user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['ipk'])) ? $profile[0]['ipk'] : '-' ?></li>
                                    <li><i class="fa fa-sign-in user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['last_login'])) ? $profile[0]['last_login'] : '-' ?></li>
                                <?php } elseif($this->session->userdata('from_table') == "dosen"){ ?>
                                    <li><i class="fa fa-id-badge user-profile-icon"></i>&nbsp; Dosen</li>
                                    <li><i class="fa fa-male user-profile-icon"></i>&nbsp;&nbsp;&nbsp;<?= (isset($profile[0]['NIP'])) ? $profile[0]['NIP'] : '-' ?> ~ <?= (isset($profile[0]['nama'])) ? $profile[0]['nama'] : '-' ?></li>
                                    <li><i class="fa fa-envelope user-profile-icon"></i>&nbsp; <?= (isset($profile[0]['email'])) ? $profile[0]['email'] : '-' ?></li>
                                    <li><i class="fa fa-sign-in user-profile-icon"></i>&nbsp;&nbsp; <?= (isset($profile[0]['last_login'])) ? $profile[0]['last_login'] : '-' ?></li>
                                <?php } ?>

                            </ul>

                            <!-- <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit m-right-xs"></i>change password</a> -->
                        </div>
                        <div class="col-md-9 col-sm-9 ">

                            <div class="profile_title">
                                <div class="col-md-6">
                                    <h2>User Activity Report</h2>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="mydate" class="pull-right">
                                    <!-- <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED;">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div> -->
                                </div>
                            </div>

                            <div>
                                <!-- start recent activity -->
                                <ul class="messages" id='recent_activities'>
                                </ul>
                                <!-- end recent activity -->
                            </div>
                        </div>
                    </div> <!-- /x_content -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <input type="text" id="reportrange"> -->
<!-- /page content -->

<!-- <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">

    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <h6>Masukkan password lama dan password baru yang dikehendaki</h6>
		<input type="password" id="old_password" class="form-control" name="old_password" placeholder="Password Lama" required />
        <br>
        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Password Baru" required />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn bg-green">Simpan</button>
    </div>

    </div>
</div>
</div> -->
<!-- /modals -->

<script type="text/javascript">

    var baseurl = "<?php echo base_url(); ?>";
    var usertype = "<?php echo $this->session->userdata('user_type'); ?>"; 
    // DATERANGEPICKER
    $(function() {

    var start = moment().subtract(1, 'days');
    var end = moment();

    function cb(start, end) {
        // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        // alert(start.format('YYYY-MM-DD'));
        $.post(baseurl + "profile/getactivitiesbydate", {
            start_date : start.format('YYYY-MM-DD'),
            end_date : end.format('YYYY-MM-DD')
        },
        function(result) {
            // console.log(result);
            var arr = JSON.parse(result);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var kal = "";
            // alert(arr.length);
            if(arr.length>=1){
                for(var i = 0; i < arr.length; i++){
                    kal += '<li>';
                        kal += '<div class="row">';
                            kal += '<div class="col-md-10">';
                                kal += '<div class="message_wrapper">';
                                    kal += '<h4 class="heading">'+ arr[i]['table_name'] +'  <small> ~ '+ arr[i]['action'] +'</small></h4>';
                                    if(usertype != 'mahasiswa' && usertype != 'asisten_dosen'){
                                        kal += '<blockquote class="message">'+ arr[i]['keterangan'] +'</blockquote>';
                                    }
                                    kal += '<br />';
                                kal += '</div>';
                            kal += '</div>';
                            kal += '<div class="col-md-2">';
                                kal += '<div class="message_date text-center">';
                                    kal += '<h4 class="date text-info">'+ new Date(arr[i]['created']).getDate() +'</h4>';
                                    kal += '<span class="date text-info">'+ months[new Date(arr[i]['created']).getMonth()] +'</span>';
                                    kal += '<p class="month">'+ new Date(arr[i]['created']).getHours() + ":" + new Date(arr[i]['created']).getMinutes()+ ":" + new Date(arr[i]['created']).getSeconds() +'</p>';
                                kal += '</div>';
                            kal += '</div>';
                        kal += '</div>';
                    kal += '</li>';
                }
            }
            else{
                kal = '<br><div class="row">';
                    kal += '<div class="col-md-12 col-sm-12">';
                        kal += '<div class="card text-center shadow p-3 mb-5 rounded" style="width:100%">';
                            kal += '<h3><i class="fa fa-files-o fa-4x" aria-hidden="true"></i></h3>';
                            kal += '<h4 style="margin-bottom: 0; font-weight:bold;">Nothing to show</h4>';
                        kal += '</div>';
                    kal += '</div>';
                kal += '</div>';
            }

            $("#recent_activities").html(kal);
            
        });
    }

    // $('#reportrange').daterangepicker({
    //     startDate: start,
    //     endDate: end,
    //     maxDate: end,
    //     ranges: {
    //     'Today': [moment(), moment()],
    //     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //     'This Month': [moment().startOf('month'), moment().endOf('month')],
    //     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, cb);

    // cb(start, end);

    $('#mydate').daterangepicker({
        startDate: start,
        endDate: end,
        maxDate: end,
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    });
    

</script>