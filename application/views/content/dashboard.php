<!-- page content -->
<div class="right_col" role="main">

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


    <!-- top tiles -->
    <div class="row" style="display: inline-block; width:100%;" >
    <div class="tile_count">
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Mahasiswa Terdaftar</span>
        <div class="count">101</div>
        <span class="count_bottom"><i class="green">50% </i> From 202</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
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
      </div>
    </div>
  </div><!-- /top tiles -->
  <br />

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Recent Activities Laboratorium <small>/day</small></h2>
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
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                        Basis Data A
                    </h2>
                    <div class="byline">
                      <span>Ruangan - Pengajar</span>
                    </div>
                    <p class="excerpt"> hari, tanggal - jam</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                        Basis Data Lanjut A
                    </h2>
                    <div class="byline">
                      <span>Ruangan - Pengajar</span>
                    </div>
                    <p class="excerpt"> hari, tanggal - jam</p>
                  </div>
                </div>
              </li>
              <li>
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
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->