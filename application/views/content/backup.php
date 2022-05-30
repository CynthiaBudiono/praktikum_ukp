<style>
  .btn-action{
    font-size: 12px;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= isset($title) ? $title : "-" ?> <!-- <small>Informatika</small> --></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 ">
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
        <div>
          <form action="<?= (base_url('backup/dobackup')); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <button type="submit" class="btn btn-sm bg-green">Back UP!</button>
          </form>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php if(isset($user_history)) : ?>
                      <?php if(is_array($user_history)) : ?>
                          <?php foreach($user_history as $key) : ?>
                            <tr>
                              <td><?= (isset($key['created'])) ? $key['created'] : '' ?></td>
                            </tr>
                          <?php endforeach; ?>
                      <?php endif; ?>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!--  /x_content -->
      </div>
    </div>
  </div>
</div>
<!-- /page content -->