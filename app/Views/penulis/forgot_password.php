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
                <h4>Hello! forgot your password?</h4>
                <h6 class="font-weight-light text-small">Calm down. You can recover your password by requesting a password reset. Fill in your email account, we'll send you a recovery password.</h6>
                <form method="POST" action="ReqReset/addRequest">
                  <input type="hidden" name="tgl" value="<?=date('Y-m-d h:i:s')?>">
                  <input type="email" name="email" class="form-control form-control-lg mt-3 mb-3" placeholder="youremail@email.com" minlength="10" maxlength="30" required autofocus>
                  <button type="submit" class="btn btn-gradient-primary btn-block mb-4">Request</button>
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