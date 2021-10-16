<?php
  echo view('templates/reader_header.php');
  echo view('templates/reader_menu.php');
?>

<div class="page-hero-section bg-image hero-home-2" style="background-image: url(<?=base_url('assets/reader/img/bg_hero_2.svg')?>);">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row align-items-center">
        <div class="col-lg-6 wow fadeInUp">
          <div class="badge badge-soft mb-2" style="margin-top: 200px!important">#1 Blog Random 2020</div>
          <h1 class="mb-4 fw-normal">Kiyoblog</h1>
          <p class="mb-4">Blog ringan berisi bacaan
            untuk hiburan sehari-hari para Kiyo's reader<br>si kaum gabut, kaum pembelajar, siapapun itu! </p>
          <a href="<?=base_url('penulis/register')?>" class="btn btn-dark">Start to be Kiyo's Writer!</a>
        </div>
        <div class="col-lg-6 d-none d-lg-block wow zoomIn" style="top:20px !important; padding: 0">
          <div class="img-place mobile-preview floating-animate">
            <img src="<?=base_url('assets/images/fav-white.png')?>" alt="">
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>

<main>
  <div class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 py-3">
          <h3>Hot Topic!</h3>
          <?php foreach ($post as $p) : ?>
            <article class="blog-entry widget-wrap">
              <div class="entry-header">
                <div class="post-thumbnail">
                  <img src="<?=base_url('assets/uploads/post/'.$p->file_gambar)?>" style="width:100%">
                </div>
                <div class="post-date">
                  <h3><?=date('d', strtotime($p->tgl_insert))?></h3>
                  <span><?=date('M', strtotime($p->tgl_insert))?></span>
                  <span></span>
                </div>
              </div>
              <div class="post-title"><b><a href="<?=base_url('article/'.$p->slug)?>" style="font-weight: bold"><?=ucfirst($p->judul)?></a></b></div>
              <div class="entry-meta mb-2">
                <div class="meta-item entry-author">
                  <div class="icon" style="width:30px; height: 30px">
                    <img src="<?=base_url('assets/uploads/penulis/'.$p->foto)?>" alt="" class="rounded-circle" style="max-width:30px">
                  </div>
                  by <a href="<?=base_url('writer/'.$p->idpenulis)?>"><?=ucfirst($p->nama_penulis)?></a>
                </div>
                <div class="meta-item">
                  <div class="icon">
                    <span class="mai-pricetags"></span>
                  </div>
                  Category: 
                  <a href="<?=base_url('category/'.strtolower($p->nama_kategori))?>"><?=ucfirst($p->nama_kategori)?></a>
                </div>
                <div class="meta-item">
                  <div class="icon">
                    <span class="mai-chatbubble-ellipses"></span>
                  </div>
                  <a href="#"><?=$p->frekuensi?></a>
                </div>
              </div>
              <div class="entry-content">
                <?php
                  $konten = explode('</p>', $p->isi_post);
                ?>
                <p><?=$konten[0]?></p>
              </div>
              <a href="<?=base_url('article/'.$p->slug)?>" class="btn btn-primary">Continue Reading</a>
            </article>
          <?php endforeach ?>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4 py-3">
          <div class="widget-wrap">
            <form action="#" class="search-form">
              <h3 class="widget-title">Search</h3>
              <div class="form-group">
                <span class="icon mai-search"></span>
                <input type="text" class="form-control" id="keyword" placeholder="Ketik judul / penulis / kategori">
                <ul id="results" style="position: absolute; list-style: none; background-color: white; width: 100%; z-index: 50"></ul>
                <div style="clear: both;"></div>
              </div>
            </form>
          </div>

            <div class="widget-wrap" style="z-index: 0">
              <h3 class="widget-title">Recent Post</h3>
              <?php
                foreach ($recents as $recent) {
              ?>
              <div class="blog-widget">
                <div class="blog-img">
                  <img src="<?=base_url('assets/uploads/post/'.$recent->file_gambar)?>" alt="">
                </div>
                <div class="entry-footer">
                  <div class="blog-title mb-2"><a href="<?=base_url('article/'.$recent->slug)?>" style="font-weight: bold"><?=ucfirst($recent->judul)?></a></div>
                  <div class="meta">
                    <a href="#"><span class="icon-calendar"></span> <?=date('M d, Y', strtotime($recent->tgl_insert))?></a>
                    <a href="<?=base_url('writer/'.$recent->idpenulis)?>"><span class="icon-person"></span> <?=$recent->nama_penulis?></a>
                    <a href="#"><span class="icon-chat"></span><?=$recent->frekuensi?></a>
                  </div>
                </div>
              </div> <!-- end widget -->
              <?php
                }
              ?>

            </div>

        </div> <!-- end sidebar -->
      </div>
    </div>
  </div>

</main>

<?php
  echo view('templates/reader_footer.php');
?>