<?php
  echo view('templates/reader_header.php');
  echo view('templates/reader_menu.php');
?>

<main>

  <div class="page-hero-section bg-image hero-mini" style="background-image: url(<?=base_url('assets/reader/img/hero_mini.svg')?>);">
    <div class="hero-caption">
      <div class="container fg-white h-100">
        <div class="row justify-content-center align-items-center text-center h-100">
          <div class="col-lg-6">
            <h3 class="mb-4 fw-medium"><?=ucfirst(session('writer'))?></h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post by Writer</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 py-3">
          <div>
          <h3 class="mb-3"><?=ucfirst(session('writer'))?> | Penulis</h3>
            <div class="entry-meta mb-1">
                <div class="meta-item entry-author">
                  <div class="icon" style="width:30px; height: 30px">
                    <img src="<?=base_url('assets/uploads/penulis/'.$penulis->foto)?>" alt="" class="rounded-circle" style="max-width:30px">
                  </div>
                </div>
                <div class="meta-item">
                  <div>
                    <?=count($post)?> posts
                  </div>
                </div>
            </div>
        </div>

          <?php
            foreach ($post as $p) : 
          ?>
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

            <div class="widget-wrap">
              <h3 class="widget-title">Hot Topic</h3>
              <?php
                foreach ($hots as $hot) {
              ?>
              <div class="blog-widget">
                <div class="blog-img">
                  <img src="<?=base_url('assets/uploads/post/'.$hot->file_gambar)?>" style="max-width: 100px">
                </div>
                <div class="entry-footer">
                  <div class="blog-title mb-2"><a href="<?=base_url('article/'.$hot->slug)?>" style="font-weight: bold"><?=ucfirst($hot->judul)?></a></div>
                  <div class="meta">
                    <a href="#"><span class="icon-calendar"></span> <?=date('M d, Y', strtotime($hot->tgl_insert))?></a>
                    <a href="<?=base_url('writer/'.$hot->idpenulis)?>"><span class="icon-person"></span> <?=$hot->nama_penulis?></a>
                    <a href="#"><span class="icon-chat"></span><?=$hot->frekuensi?></a>
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