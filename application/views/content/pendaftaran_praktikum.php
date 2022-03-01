<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Periode Pendaftaran</h3>
                <div class="col-md-12 col-sm-12">
                    <form action="<?php UPLOAD_URL ?>dashboard" method="post">
                        <div class="control-group">
                            <div class="controls">
                                Pick start - end date
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="reservation-time" id="reservation-time" class="form-control" value="<?= $start_date ?> - <?= $end_date ?>" />
                                </div>

                                PP ke-
                                <input class="form-control" type="number" class='number' name="number" min="1" max="4" required='required'></div>
                                <br>
                                <button type='submit' class="form-control btn btn-primary btn-sm">Buka Pendaftaran</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>