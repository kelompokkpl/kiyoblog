<?php echo view('templates/penulis_header.php');?>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <h4>Success!</h4>
                <h6 class="font-weight-light">Just wait and check your email. We'll process your request :)</h6> <br><br>
                <h6 class="font-weight-light text-small">Ready to login? <a class="text-primary" href="<?=base_url('penulis')?>">Yes, i wanna login right now.<a></h6> 
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