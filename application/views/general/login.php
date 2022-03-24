<style>
  .login_content{
    text-shadow: none;
  }
</style>
<body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <a href="<?= base_url() ?>dashboard"><img src="<?= base_url() ?>/assets/images/<?= isset($logo) ? $logo : "" ?>" alt="..." style="max-width : 100%; max-height 80px;"></a>
            <form action="<?= base_url('auth') ?>" method="post" id="login_form">
              <h1>Login Form</h1>
              <?php if (isset($error_msg)) : ?>
                <div class="x_content bs-example-popovers">
                  <div class="alert alert-danger" role="alert">
                    <?php { echo $error_msg; } ?>
                  </div>
                </div>
              <?php endif; ?>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" name="username" id="username" placeholder="Username" required="required">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <input type="password" class="form-control has-feedback-left" name="password" id="password" placeholder="Password" required="required">
                <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
              </div>
            
              <div>
                <div class="col-md-12 col-sm-12">
                  <button type="submit" class="btn btn-success form-control">Login</button>
                  <!-- <a class="btn btn-default submit" href="<?= UPLOAD_URL ?>dashboard">Log in</a> -->
                </div>
                <!-- <div class="col-md-12 col-sm-12">
                  <a href="#">Lost your password?</a>
                </div> -->
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>