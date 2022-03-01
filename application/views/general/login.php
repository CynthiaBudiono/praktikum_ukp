<body class="login">
    <div>
      <!-- <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a> -->

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php UPLOAD_URL ?>dashboard" method="post" id="login_form">
              <h1>Login Form</h1>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Username" required="required">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <input type="password" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Password" required="required">
                <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
              </div>
            
              <div>
                <div class="col-md-12 col-sm-12">
                  <button type="submit" class="btn btn-success form-control">Login</button>
                  <!-- <a class="btn btn-default submit" href="<?= UPLOAD_URL ?>dashboard">Log in</a> -->
                </div>
                <div class="col-md-12 col-sm-12">
                  <a href="#">Lost your password?</a>
                </div>
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>