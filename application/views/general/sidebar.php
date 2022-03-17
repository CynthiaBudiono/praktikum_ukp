<style>
  body{
    background-color: white;
    color: black !important;
  }
  .nav_title, .left_col, .main_container{
    background-color: white;
    
  }

  .profile_info h2{
    color: #868e96;
  }
  .nav.side-menu>li>a{
    color: #868e96;
  }
  .nav.side-menu>li>a:hover{
    color: #82b19b !important;
  }
  /* nav.side-menu>li.current-page, .nav.side-menu>li.active {
    box-shadow: 0 4px 8px #acb5f6;;
    border-right: 5px solid #1ABB9C;
  } */

  .nav.side-menu>li.active>a, .nav-sm ul.nav.child_menu{
    background: white;
    text-shadow: none;
  }

  .menu_section h3{
    color: #868e96;
    text-shadow: none;
  }

  .nav.child_menu>li>a{
    color: #868e96;
  }
  .nav>li>a:hover, .nav>li>a:focus {
    color: #82b19b;
    background: #F4F9F9;
  }
  .nav li li.current-page a{
    color: #82b19b;
  }

  .nav.side-menu>li.current-page, .nav.side-menu>li.active, .current-page.fa, .nav-sm .nav.side-menu li.active-sm {
    border-right: 5px solid #82b19b;
    border-radius: 5px;
    color: #82b19b !important;
  }

  .green{
    color : #82b19b !important;
  }

  .bg-green{
    background: #82b19b !important;
    border: 1px solid #82b19b !important;
    color: #fff;
  }

  .bg-danger{
    color: #fff
  }

  .bg-yellow{
    background: #f2cc8e;
  }

  .color-red{
    color: #F47174;
  }

  .nav-md ul.nav.child_menu li:before { /* pentol sidebar */
    background: #3e405b;
    bottom: auto;
    content: "";
    height: 8px;
    left: 23px;
    margin-top: 15px;
    position: absolute;
    right: auto;
    width: 8px;
    z-index: 1;
    border-radius: 50%;
  }
  /* .nav-md ul.nav.child_menu li.current-page {
    background: #82b19b;
    bottom: auto;
    content: "";
    height: 8px;
    left: 23px;
    margin-top: 15px;
    position: absolute;
    right: auto;
    width: 8px;
    z-index: 1;
    border-radius: 50%;
  } */


html{
  scroll-behavior: smooth;
}


  .profile_info i{
    color: #f2cc8e !important;
    margin-top: 6px;
  }

   /* recent activities profile */
   ul.messages li .message_wrapper {
        margin: 0px;
    }

    /* date range picker profile, pendaftaran */
  .daterangepicker td.active, .daterangepicker td.active:hover,
  .daterangepicker .ranges li.active, .daterangepicker .ranges li:hover ,
  .daterangepicker td.active, .daterangepicker td.active:hover {
    background-color: #82b19b;
    border : 1px solid #F4F9F9;
  }

  input[type=file]::file-selector-button {
    border: 2px solid #82b19b;
    padding: .2em .4em;
    border-radius: .2em;
    background-color: #82b19b;
    transition: 1s;
    color: #fff;
    }

    input[type=file]::file-selector-button:hover {
    background-color: #688d7c;
    border: 2px solid #688d7c;
    color: #fff;
    }

    .btn-group{
        display: block;
    }
    .dataTables_length{
        float: left;
    }

</style>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url() ?>dashboard"><img src="<?= base_url() ?>/assets/images/<?= isset($logo) ? $logo : "" ?>" alt="..." style="max-width : 100%; max-height 80px;"></a>
          </div>

          <div class="clearfix"></div>

          <br>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?= base_url() ?>/assets/images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/logout') ?>" style="float : right">
                  <i class="glyphicon glyphicon-off" aria-hidden="true"></i>
              </a>
              <span>Welcome,</span>
              <h2><?= $this->session->userdata('logged_name');?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url('mahasiswa') ?>">Mahasiswa</a></li>
                    <li><a href="<?= base_url('dosen') ?>">Dosen</a></li>
                    <li><a href="<?= base_url('calon_asisten_dosen') ?>">Calon Asdos</a></li>
                    <li><a href="<?= base_url('laboratorium') ?>">Laboratorium</a></li>
                    <li><a href="<?= base_url('subject') ?>">Mata Kuliah</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url('pendaftaran_praktikum') ?>">Periode Pendaftaran</a></li>
                    <li><a href="<?= base_url('pendaftaran_asisten_dosen') ?>">Periode Rekrutmen</a></li>
                    <li><a href="<?= base_url('kelas_praktikum') ?>">Praktikum</a></li>
                    <li><a href="<?= base_url('jadwal_berhalangan') ?>">Berhalangan Pengajar</a></li>
                    <li><a href="<?= base_url('jadwal_wawancara') ?>">Wawancara Asdos</a></li>
                    <li><a href="<?= base_url('mahasiswa_matakuliah') ?>">PRS Mahasiswa</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-flag"></i> Penerimaan <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url('ambil_praktikum') ?>">Ambil Praktikum</a></li>
                    <li><a href="<?= base_url('asisten_dosen') ?>">Asdos</a></li>
                    <li><a href="<?= base_url('mahasiswa_nilai') ?>">Penilaian</a></li>
                  </ul>
                </li>
                <li><a href="<?= base_url('laporan') ?>"><i class="fa fa-archive"></i> Laporan</span></a></li>
                <li><a href="<?= base_url('informasi_umum') ?>"><i class="fa fa-exclamation-circle"></i> Informasi Umum</span></a></li>
                <li><a href="<?= base_url('berita') ?>"><i class="fa fa-bullhorn"></i> Pengumuman</span></a></li>
                <li><a><i class="fa fa-users"></i> Manajemen User <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url('user_group') ?>">Kelompok Akses</a></li>
                    <li><a href="<?= base_url('user') ?>">User</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-floppy-o"></i> Backup Data</span></a></li>
            </div>
            

          </div>
          <!-- /sidebar menu -->
        </div> <!-- /scroll view -->
      </div>