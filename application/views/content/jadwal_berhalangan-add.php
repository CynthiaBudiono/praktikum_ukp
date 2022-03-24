<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= isset($title) ? $title : "-" ?> <small>Informatika</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Jadwal <small><?= isset($getinfo[0]['nama']) ? $getinfo[0]['nama'] : "-" ?></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Jam</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                      </tr>
                    </thead>


                    <tbody id="table_week"> 
                    <?php if(isset($jadwal)) : ?>
                        <?php if(is_array($jadwal)) : ?>
                            <?php foreach($jadwal as $key) : ?>
                                <?php if($key['hari']){?>
                                    
                                <?php }?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                  
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script  type="text/javascript">

var baseurl = "<?php echo base_url(); ?>";

$(document).ready(function() {

  var hours = ['7.30','8.30','9.30','10.30','11.30','12.30','13.30','14.30','15.30','16.30','17.30','18.30','19.30'];
  var kal='';
  for(var i = 0; i < hours.length; i++){
    kal +='<tr>';
      kal +='<td>' + hours[i] + '</td>';
      for(var j = 0; j < 6; j++){
        kal +='<td onclick="berhalangan(this);" style="text-align:center;"><i class="fa fa-times-circle" aria-hidden="true"></i></td>';
      }
    kal +='</tr>';
  }
  
  $("#table_week").html(kal);
  
});

function berhalangan(el){
  alert(el);
  // el.html('<i class="fa fa-check-circle" aria-hidden="true"></i>');
}
</script>