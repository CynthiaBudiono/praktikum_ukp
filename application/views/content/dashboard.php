<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
  <?php if(isset($berita)) : ?>
    <?php if(is_array($berita)) : ?>
        <?php foreach($berita as $key) : ?>
          <div class="col-md-3 col-sm-3">
            <div class="card border-green mb-3" style="max-width: 18rem;">
              <div class="card-header bg-green">
                <?= (isset($key['title'])) ? $key['title'] : '' ?> 
                <?php if(isset($key['link']))
                  if($key['link'] != ''){ ?><label style="float:right; margin-bottom:0px;"><a href="<?= $key['link']?> "><i class="fa fa-arrow-right" aria-hidden="true"></i></a></label><?php } ?>
              </div>
              <div class="card-body" style="color: black; min-height: 132px;">
                <?= (isset($key['keterangan'])) ? $key['keterangan'] : '' ?>
              </div>
            </div>
          </div>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endif; ?>
  </div>

  <?php if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'kepala_lab' || $this->session->userdata('user_type') == 'asisten_tetap'){ ?>
    <!-- top tiles -->
    <div class="row" style="display: inline-block; width:100%;" >
    <div class="tile_count">
      <div class="col-md-5 col-sm-8  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Mahasiswa Terdaftar</span>
        <div class="count"><?= (isset($count_mahasiswa_daftar)) ? $count_mahasiswa_daftar : '' ?></div>
        <span class="count_bottom"><?php 
          if(isset($count_mahasiswa_daftar) && isset($count_mahasiswa_ikut_praktikum)){ if($count_mahasiswa_daftar != 0 && $count_mahasiswa_ikut_praktikum != 0){ $percent = (($count_mahasiswa_daftar/$count_mahasiswa_ikut_praktikum)*100); if($percent < 75){ echo '<i class="red">'.$percent.'%</i>'; } else{echo '<i class="green">'.$percent.'%</i>';}} else{ echo '<i class="green">0%</i>';}} ?>
          
          From <?= (isset($count_mahasiswa_ikut_praktikum)) ? $count_mahasiswa_ikut_praktikum : '' ?></span>
      </div>
      <!-- <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Lab JK</span>
        <div class="count green">12</div>
        <span class="count_bottom">Quota <i class="green">20 </i> mahasiswa</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i>  Lab SI</span>
        <div class="count green">25</div>
        <span class="count_bottom">Quota <i class="green">30 </i> mahasiswa</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i>  Lab MM</span>
        <div class="count red">18</div>
        <span class="count_bottom">Quota 18 mahasiswa</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i>  Lab PG</span>
        <div class="count">0</div>
        <span class="count_bottom">Quota 23 mahasiswa</span>
      </div> -->
    </div>
  </div><!-- /top tiles -->
  <?php } else if($this->session->userdata('user_type') == 'mahasiswa' || $this->session->userdata('user_type') == 'asisten_dosen'){ ?> <!-- MAHASISWA --> <!-- VIEW KELAS PRAK/MAHASISWA --> 
    <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Kelas Praktikum</h2><small>/semester</small>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                          <th>Hari</th>
                          <th>Jam</th>
                          <th>Mata Kuliah</th>
                          <th>LAB</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($kelas_praktikum_mahasiswa)) : ?>
                        <?php if(is_array($kelas_praktikum_mahasiswa)) : ?>
                            <?php foreach($kelas_praktikum_mahasiswa as $key) : ?>
                            <tr>
                              <td><?= (isset($key['hariterpilih'])) ? $key['hariterpilih'] : '' ?></td>
                              <td><?= (isset($key['jamterpilih'])) ? $key['jamterpilih'] : '' ?></td>
                              <td><?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?></td>
                              <td><?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                    </table>
                </div>
            </div>
          </div> 
        </div> <!-- /x-content -->
      </div>
    </div>
  </div>
  <?php } ?> <!-- /USER TYPE MAHASISWA -->
  
  <br />

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2 style="max-width:max-content;">Recent Activities Laboratorium</h2><small>/day</small>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
            <?php if(isset($recent_activities_lab)) : ?>
              <?php if(is_array($recent_activities_lab)) : ?>
                <?php foreach($recent_activities_lab as $key) : ?>
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                        <?= (isset($key['kode_mk'])) ? $key['kode_mk'] : '' ?> ~ <?= (isset($key['nama_subject'])) ? $key['nama_subject'] : '' ?> <?= (isset($key['kelas_paralel'])) ? $key['kelas_paralel'] : '' ?> (<?= (isset($key['kode_lab'])) ? $key['kode_lab'] : '' ?>)
                        </h2>
                        <div class="byline">
                          <span>
                            <?php if($key['nama_dosen1'] != NULL){ echo $key['nama_dosen1']; } elseif($key['nama_mahasiswa1'] != NULL) {echo $key['nama_mahasiswa1']; }?> &nbsp&nbsp-
                            <?php if($key['nama_dosen2'] != NULL){ echo $key['nama_dosen2']; } elseif($key['nama_mahasiswa2'] != NULL) {echo $key['nama_mahasiswa2']; }?> &nbsp&nbsp-
                            <?php if($key['nama_dosen3'] != NULL){ echo $key['nama_dosen3']; } elseif($key['nama_mahasiswa3'] != NULL) {echo $key['nama_mahasiswa3']; }?>
                          </span>
                        </div>
                        <p class="excerpt"> <?= (isset($key['hari'])) ? $key['hari'] : '' ?>, <?php echo date('d-m-Y');?> <?= (isset($key['jam'])) ? $key['jam'] : '' ?>-<?= (isset($key['durasi'])) ? date('H:i:s', strtotime($key['jam']. ' +'.$key['durasi'].' minutes')) : '' ?></p>
                      </div>
                    </div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            <?php endif; ?>
              
              <!-- <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                        Sistem Operasi B
                    </h2>
                    <div class="byline">
                      <span>Ruangan - Pengajar</span>
                    </div>
                    <p class="excerpt"> hari, tanggal - jam</p>
                  </div>
                </div>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->