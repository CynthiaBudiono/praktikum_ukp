<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= UPLOAD_URL ?>dashboard"><img src="<?= UPLOAD_URL ?>/assets/images/logo_informatika.png" alt="..." style="width : 100%"></a>
            </div>

            <div class="clearfix"></div>

            <br>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= UPLOAD_URL ?>/assets/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html" style="float : right">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= UPLOAD_URL ?>dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a><i class="fa fa-home"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= UPLOAD_URL ?>mahasiswa">Mahasiswa</a></li>
                      <li><a href="index2.html">Dosen</a></li>
                      <li><a href="index3.html">Calon Asdos</a></li>
                      <li><a href="index3.html">Laboratorium</a></li>
                      <li><a href="index3.html">Mata Kuliah</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-home"></i> Jadwal <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= UPLOAD_URL ?>pendaftaran_praktikum">Periode Pendaftaran</a></li>
                      <li><a href="index2.html">Periode Rekrutmen</a></li>
                      <li><a href="index3.html">Praktikum</a></li>
                      <li><a href="index3.html">Berhalangan Pengajar</a></li>
                      <li><a href="index3.html">Wawancara Asdos</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-home"></i> Penerimaan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= UPLOAD_URL ?>mahasiswa">Ambil Praktikum</a></li>
                      <li><a href="index2.html">Asdos</a></li>
                      <li><a href="index3.html">Penilaian</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-home"></i> Laporan</span></a></li>
                  <li><a><i class="fa fa-home"></i> Manajemen User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= UPLOAD_URL ?>mahasiswa">Kelompok Akses</a></li>
                      <li><a href="index2.html">User</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-home"></i> Backup Data</span></a></li>
              </div>
              

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>