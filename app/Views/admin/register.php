<?php echo view('templates/admin_header.php');?>
    
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
            <?php if(!empty(session()->getFlashdata('failed'))){ ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo session()->getFlashdata('failed');?>
            </div> 
            <?php } ?>
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?php echo base_url('assets/images/logo.png')?>">
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('admin/save_register');?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg <?php if ($validation->hasError('nama_admin')) echo 'is-invalid'; ?>" id="nama_admin" name="nama_admin" placeholder="Nama" value="<?php echo old('nama_admin');?>">
                    <div class="text-danger">
                      <?php if ($validation->hasError('nama_admin')) echo $validation->getError('nama_admin'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg <?php if ($validation->hasError('email')) echo 'is-invalid'; ?>" id="email" name="email" placeholder="Email" value="<?php echo old('email');?>">
                    <div class="text-danger">
                      <?php if ($validation->hasError('email')) echo $validation->getError('email'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg <?php if ($validation->hasError('password')) echo 'is-invalid'; ?>" id="password"  name="password" placeholder="Password">
                    <div class="text-danger">
                      <?php if ($validation->hasError('password')) echo $validation->getError('password'); ?>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="submit">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="<?php echo base_url('admin')?>" class="text-primary">Login</a>
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
<?php echo view('templates/admin_footer.php');?>