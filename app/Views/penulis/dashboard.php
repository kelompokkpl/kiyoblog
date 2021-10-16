<?php
  echo view('templates/penulis_header.php');
  echo view('templates/penulis_menu.php');
?>

 <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Hallo <?php echo ucfirst($penulis->nama_penulis)?> ! Have a nice day :)</p>
                  <a href="#" class="btn download-button purchase-button ml-auto" id="bannerClose">Close</a>
                </span>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard</h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Kategori Postingan Anda <i class="mdi mdi-collage mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($kat)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Posting<i class="mdi mdi-grease-pencil mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($post)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Komentar Postingan Anda<i class="mdi mdi-comment-text-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($kom)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->

<?php 
  echo view('templates/penulis_footer.php');
?>