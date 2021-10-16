<?php
  echo view('templates/reader_header.php');
  echo view('templates/reader_menu.php');
  session()->set('idpost',$post->idpost);
?>

<main>

  <div class="page-hero-section bg-image hero-mini" style="background-image: url(<?=base_url('assets/reader/img/hero_mini.svg')?>);">
    <div class="hero-caption">
      <div class="container fg-white h-100">
        <div class="row justify-content-center align-items-center text-center h-100">
          <div class="col-lg-6">
            <h3 class="mb-4 fw-medium"><?=$post->judul?></h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Article</li>
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
        <div class="col-lg-8">
          <div class="card-page">
          <h3 class="mb-3"><?=ucfirst($post->judul)?></h3>
            <div class="entry-meta mb-1">
                <div class="meta-item entry-author">
                  <div class="icon" style="width:30px; height: 30px">
                    <img src="<?=base_url('assets/uploads/penulis/'.$post->foto)?>" alt="" class="rounded-circle" style="max-width:30px">
                  </div>
                  by <a href="<?=base_url('writer/'.$post->idpenulis)?>"><?=ucfirst($post->nama_penulis)?></a>
                </div>
                <div class="meta-item">
                  <div class="icon">
                    <span class="mai-pricetags"></span>
                  </div>
                  <a href="<?=base_url('category/'.strtolower($post->nama_kategori))?>"><?=ucfirst($post->nama_kategori)?></a>
                </div>
                <div class="meta-item">
                  <div class="icon">
                    <span class="mai-chatbubble-ellipses"></span>
                  </div><?=$post->frekuensi?> commentars
                </div>
            </div>
            <div class="entry-meta mb-3">
                <?php 
                  if (isset($post->tgl_update)){
                      echo "<div class=meta-item>
                  Last updated on ".date('d M, Y', strtotime($post->tgl_update))."</div>";
                  } else{
                      echo "<div class=meta-item>
                  Created on ".date('d M, Y', strtotime($post->tgl_insert))."</div>";
                  }
                ?>
            </div>
            <div class="text-center mb-5">
              <img src="<?=base_url('assets/uploads/post/'.$post->file_gambar)?>" style="max-width:65%" class="thumbnail" alt="<?=$post->judul?>">
            </div>
            <div>
              <?=$post->isi_post?>
            </div>
        </div>
      </div>  <!-- col-lg-8 -->

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
                    <a href="<?=base_url('writer/'.$post->idpenulis)?>"><span class="icon-person"></span> <?=$recent->nama_penulis?></a>
                    <a href="#"><span class="icon-chat"></span><?=$recent->frekuensi?></a>
                  </div>
                </div>
              </div> <!-- end widget -->
              <?php
                }
              ?>

            </div>

        </div> <!-- end sidebar -->
     <!-- .row -->
    </div>

    <!-- Comments -->
    <div class="row">
      <div class="col-lg-8">
        <div class="mt-5">
          <div class="comment-area">
            <h3 class="mb-5"><?=$post->frekuensi?> Commentars</h3>
            <!-- Comment List -->
            <ul class="comment-list">
              <?php
                if(empty($komentar)){
                  echo '&nbsp;&nbsp;&nbsp;Be the first!<br><br>';
                } else{
                foreach ($komentar as $komen) {
              ?>
              <li class="comment" style="margin-bottom: 0; padding-bottom: 0">
                <div class="vcard bio">
                <img src="<?=base_url('assets/uploads/penulis/avatar.png')?>" alt="avatar">
                </div>
                <div class="comment-body">
                <h3><?=$komen->nama_pengirim?></h3>
                <div class="meta"><?=date('d M, Y', strtotime($komen->tgl))?> at <?=date('h:i', strtotime($komen->tgl))?></div>
                <p><?=$komen->isi?></p>
                </div>
              </li>
              <?php if(session()->has('penulis') && $post->idpenulis == session('idpenulis')){ ?>
              <div style="margin-top: 0;" class="ml-8 mb-4">
                  <a href="#" data-toggle="modal" data-target="<?='#konDel'.$komen->idkomentar?>" title="Delete" style="font-size: 10pt">Delete this comment <span class="mai-trash"> </span></a>
              </div>

               <!-- Modal Confirm Delete -->
                  <div class="modal fade" id="konDel<?=$komen->idkomentar?>" tabindex="10" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Kiyoblog's system says</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">Delete comment?
                            </div>
                            <div class="modal-footer">
                              <button id="delCom" class="btn btn-danger del" value="<?=$komen->idkomentar?>">Yes</a>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                      </div>
                    </div>
            <?php } } } ?>
            </ul> <!-- END .comment-list -->
            <div class="hasil"></div>
            <div class="comment-form-wrap pt-2 col-md-8">
              <h3 class="mb-2">Leave a comment</h3>
              <hr>
              <form method="POST" class="formCom">
                <div class="form-row form-group">
                    <input type="hidden" name="idpost" value="<?=$post->idpost?>"> 
                    <label>Name</label>                    
                    <input type="text" name="name" class="form-control" id="name" minlength="3" maxlength="30" required>  
                  <label>Commentar</label>
                  <textarea name="comment" cols="30" rows="7" class="form-control" minlength="5" maxlength="255" required></textarea>
                  <button type="button" class="btn btn-primary mt-3 addCom">Send</button>
              </form>
            </div>
          </div> <!-- end comment -->
        </div>
      </div>
    </div>
  </div>

</main>

<?php
  echo view('templates/reader_footer.php');
?>