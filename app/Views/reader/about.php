<?php
  echo view('templates/reader_header.php');
  echo view('templates/reader_menu.php');
?>

<main class="bg-light">

<div class="page-hero-section bg-image hero-mini" style="background-image: url('<?=base_url('assets/reader/img/hero_mini.svg')?>');">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row justify-content-center align-items-center text-center h-100">
        <div class="col-lg-6">
          <h3 class="mb-4 fw-medium">About Us</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">About</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section pt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card-page">
          <h5 class="fg-primary">Stories</h5>
          <hr>
          <p>Blog ini dibuat untuk memenuhi penugasan membuat blog dinamis di mata kuliah Pemrograman berbasis Platform. Blog ini dibuat menggunakan Codeigniter 4, Bootstrap 4, CKEditor 4, dan library lainnya. </p>          
        </div>
        <div class="card-page mt-3">
          <h5 class="fg-primary">Meet Our Teams</h5>
          <hr>

          <div class="row justify-content-center">
            <div class="col-lg-3 py-3">
              <div class="team-item">
                <div class="team-avatar" style="border: 1px solid grey">
                  <img src="<?=base_url('assets/images/ava/ava1.jpeg')?>" alt="">
                </div>
                <h5 class="team-name">Honey Indarso</h5>
              </div>
            </div>
            <div class="col-lg-3 py-3">
              <div class="team-item">
                <div class="team-avatar" style="border: 1px solid grey">
                  <img src="<?=base_url('assets/images/ava/ava2.png')?>" alt="">
                </div>
                <h5 class="team-name">Mutiara Hardiani Mahe</h5>
              </div>
            </div>
            <div class="col-lg-3 py-3">
              <div class="team-item">
                <div class="team-avatar" style="border: 1px solid grey">
                  <img src="<?=base_url('assets/images/ava/ava3.jpeg')?>" alt="">
                </div>
                <h5 class="team-name">Nur Endah Nobitasari</h5>
              </div>
            </div>
            <div class="col-lg-3 py-3">
              <div class="team-item">
                <div class="team-avatar" style="border: 1px solid grey">
                  <img src="<?=base_url('assets/images/ava/ava4.jpeg')?>" alt="">
                </div>
                <h5 class="team-name">Nururrizqa Adhani</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</main> <!-- .bg-light -->

<?php
  echo view('templates/reader_footer.php');
?>