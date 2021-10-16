<nav class="navbar navbar-expand-lg navbar-dark navbar-floating">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="<?=base_url('assets/images/fav-white.png')?>" alt="" width="40">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-auto mt-3 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="<?=base_url()?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              foreach ($kategori as $kat) {
                echo '<a class="dropdown-item" href="'.base_url('category/'.strtolower($kat->nama_kategori)).'">'.ucfirst($kat->nama_kategori).'</a>';
              }
            ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('new')?>">What's New</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('about')?>">About</a>
        </li>
      </ul>
      <div class="ml-auto my-2 my-lg-0">
      <?php if(!session()->has('penulis')){ ?>
        <a href="<?=base_url('penulis/register')?>">
          <button class="btn btn-primary rounded-pill">Sign Up</button>
        </a>
    <?php } ?>
      </div>
    </div>
  </div>
</nav>