<?php echo view('templates/penulis_header.php');?>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
            <?php if(!empty(session()->getFlashdata('success'))){ ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo session()->getFlashdata('success');?>
            </div> 
            <?php } ?>
            <?php if(!empty(session()->getFlashdata('failed'))){ ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo session()->getFlashdata('failed');
              ?>
            </div> 
            <?php } ?>
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?php echo base_url('assets/images/logo.png');?>">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('penulis/login');?>">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="submit">LOG IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="<?php echo base_url('penulis/forgot_password'); ?>" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="<?php echo base_url('penulis/register'); ?>" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
<?php echo view('templates/penulis_footer.php');?>