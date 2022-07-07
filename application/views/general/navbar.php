<!-- <style>
  .navbar-bg{z-index:889;height:70px}
  .navbar-bg{content:" ";position:absolute;top:0;left:0;width:100%;height:115px;background-color:#6777ef;z-index:-1}
</style> -->
<style>
  .nav_menu{
    background-color: #1d81be; 
    /* #82b19b;  */
    /* GreenColor */
    /* background-color: #82b19b;  */
    /* BlueColor */
  }

  #menu_toggle{
    color: #f2f2f2;
  }

  a.user-profile{
    color: #000 !important;
  }
  .btn-action{
    font-size: 12px;
  }

  .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

</style>
<!-- top navigation -->
<!-- <div class="navbar-bg"></div> -->
<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <!-- <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <img src="<?= base_url() ?>/assets/images/user.png" alt=""><?= $this->session->userdata('logged_name');?>
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="<?= base_url('profile') ?>"> Profile</a>
              <a class="dropdown-item"  href="<?= base_url('auth/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </div>
          </li>
          <li class="nav-item">
              <h6 style="margin-top:5px; margin-bottom:0px; margin-right: 15px;"><?= isset($semester) ? $semester : "-" ?> <?= isset($tahun_ajaran) ? $tahun_ajaran : "-" ?></h6>
          </li>
        </ul>
      </nav> -->
  </div>
</div>
<!-- /top navigation -->