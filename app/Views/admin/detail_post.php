<?php
  echo view('templates/admin_header.php');
  echo view('templates/admin_menu.php');
?>

 <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span>Detail Post <i class="mdi mdi mdi-lead-pencil ml-2"></i></h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                      <button class="btn btn-inverse-danger btn-icon mb-5" onClick="javascript:history.go(-1)" title="Kembali"><i class="mdi mdi mdi-keyboard-return"></i></button>
                      <br>
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr>  
                              <th>ID Postingan</th>
                              <td><?=$post->idpost?></td>
                          </tr>
                          <tr>  
                              <th>Judul Postingan</th>
                              <td><?=ucfirst($post->judul)?></td>
                          </tr>
                          <tr>  
                              <th>Kategori</th>
                              <td><?=ucfirst($post->nama_kategori)?></td>
                          </tr>
                          <tr>  
                              <th>Nama Penulis</th>
                              <td><?=ucfirst($post->nama_penulis)?></td>
                          </tr>
                          <tr>  
                              <th>Waktu Posting</th>
                              <td><?=substr($post->tgl_insert,0,10)?>, <?=substr($post->tgl_insert,11)?></td>
                          </tr>
                          <?php if(isset($post->tgl_update)){ ?>
                          <tr>  
                              <th>Waktu Update</th>
                              <td><?=substr($post->tgl_update,0,10)?>, <?=$post->substr($post->tgl_update,11,15)?></td>
                          </tr>
                          <?php  } //end of if ?>
                          <tr>  
                              <th>Jumlah Komentar</th>
                              <td><?=count($komentar)?></td>
                          </tr>
                          <tr>  
                              <td colspan="2"><a href="<?=base_url('article/'.$post->slug)?>" target="_blank">Kunjungi Postingan<i class="mdi mdi-eye ml-2"></i></a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
<?php 
  echo view('templates/admin_footer.php');
?>