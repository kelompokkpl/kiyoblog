<?php
  echo view('templates/penulis_header.php');
  echo view('templates/penulis_menu.php');
?>

 <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
              Add Post
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
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
                <div class="card">
                  <div class="card-body">
                  <form action="<?=base_url('post/savePost')?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="tgl_insert" value="<?= date('Y-m-d h:i:s')?>">
                    <input type="hidden" name="idpenulis" value="<?=$penulis->idpenulis?>">
                    <label class="label">Judul Postingan</label>
                    <input type="text" name="judul" class="form-control <?php if ($validation->hasError('judul')) echo 'is-invalid'; ?>" placeholder="Judul Postingan"  value="<?php echo old('judul');?>">
                    <div class="text-danger mt-1">
                      <?php if ($validation->hasError('judul')) echo $validation->getError('judul'); ?>
                    </div>
                    <label class="label mt-2">Kategori</label>
                    <select class="form-control mb-3" name="idkategori" value="<?php echo old('idkategori');?>">
                        <?php
                          foreach($kategori as $kat){ 
                            echo '<option value="'.$kat->idkategori.'">'.ucfirst($kat->nama_kategori).'</option>';
                          }
                        ?>
                    </select>
                    <textarea cols="10" id="konten" name="konten" rows="15" data-sample-short required></textarea>
                    <script>
                      CKEDITOR.replace('konten', {
                        extraPlugins: 'editorplaceholder',
                        editorplaceholder: 'Start typing here...'
                      });
                    </script>
                    <label class="label mt-4">Foto</label>
                    <input type="file" name="foto" class="btn btn-inverse-primary btn-block form-file-input mb-4" value="<?php echo old('foto');?>" required>
                    <div class="text-danger mt-1">
                      <?php if ($validation->hasError('foto')) echo $validation->getError('foto'); ?>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#konfirmPost">Posting</button>
                    <button type="reset" class="btn btn-danger">Reset</button>

                    <!-- Modal -->
                    <div class="modal fade" id="konfirmPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kiyoblog's system says</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            You really wanna post?
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->

<?php 
  echo view('templates/penulis_footer.php');
?>