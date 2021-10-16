<?php
  echo view('templates/penulis_header.php');
  echo view('templates/penulis_menu.php');
?>

 <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <?php 
        if(!empty(session()->getFlashdata('success'))){ ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo session()->getFlashdata('success');?>
          </div> 
      <?php } ?>
      <?php 
        if(!empty(session()->getFlashdata('failed'))){ ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo session()->getFlashdata('failed');?>
          </div> 
      <?php } ?>
      <div class="row">
        <div class="col-xl-4">
          <div class="card card-profile mt-4">
            <img src="<?=base_url("assets/images/dashboard/bg.svg");?>" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#" data-toggle="modal" data-target="#updatePhoto" title="Update Photo Profile">
                   <img src="<?=base_url("assets/uploads/penulis/".$penulis->foto);?>" alt="image" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4" style="background-color: white">
              <div class="d-flex justify-content-between">
                <!--  -->
              </div>
            </div>
            <div class="card-body pt-0 mt-4">
              <div class="text-center">
                <h5 class="h3">
                  <?=$penulis->nama_penulis?>
                </h5>
                <div class="h5 font-weight-300">- Penulis -
                </div>
                <div><?=$penulis->email?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card mt-4">
            <div class="card-body">
              <h4 class="card-title mt-1 mb-4">
                Edit My Profile<i class="mdi mdi mdi-account ml-3"></i>
              </h4>
                <div class="table-responsive">
                  <table class="table">
                    <form method="POST" action="<?=base_url('penulis/updateProfile')?>">
                      <tbody>
                        <tr>  
                          <th>ID</th>
                          <td><input type="text" name="idpenulis" class="form-control" value="<?=$penulis->idpenulis?>" readonly></td>
                        </tr>
                        <tr>  
                          <th>Nama </th>
                          <td><input type="text" name="nama_penulis" class="form-control <?php if ($validation->hasError('nama_penulis')) echo 'is-invalid'; ?>" value="<?=$penulis->nama_penulis?>" minlength="3" maxlength="50" required>
                          <div class="text-danger mt-1">
                            <?php if ($validation->hasError('nama_penulis')) echo $validation->getError('nama_penulis'); ?>
                          </div>
                          </td>
                        </tr>
                        <tr>  
                          <th>Email</th>
                          <td><input type="email" name="email" class="form-control <?php if ($validation->hasError('email')) echo 'is-invalid'; ?>" value="<?=$penulis->email?>" required>
                            <div class="text-danger mt-1">
                            <?php if ($validation->hasError('nama_penulis')) echo $validation->getError('email'); ?>
                              </div>
                          </td>
                        </tr>
                        <tr>  
                          <th>Alamat </th>
                          <td><textarea name="alamat" class="form-control <?php if ($validation->hasError('Alamat')) echo 'is-invalid'; ?>" minlength="10" maxlength="100" required><?=$penulis->alamat?></textarea>
                          <div class="text-danger mt-1">
                            <?php if ($validation->hasError('alamat')) echo $validation->getError('alamat'); ?>
                          </div>
                          </td>
                        </tr>
                        <tr>  
                          <th>No. Telepon </th>
                          <td><input type="text" name="telp" class="form-control <?php if ($validation->hasError('telp')) echo 'is-invalid'; ?>" value="<?=$penulis->telp?>" minlength="8" maxlength="15" required>
                          <div class="text-danger mt-1">
                            <?php if ($validation->hasError('telp')) echo $validation->getError('telp'); ?>
                          </div>
                          </td>
                        </tr>
                        <tr>  
                          <td colspan="2">
                            <button type="submit" class="btn btn-primary mt-2" name="submit">
                              Update
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </form>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>  <!-- end of row -->

      <!-- Modal Update -->
      <div class="modal fade" id="updatePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Photo Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form action="<?=base_url('penulis/updatePhoto')?>" method="POST" enctype="multipart/form-data">
              <?= csrf_field(); ?>
            <div class="modal-body">
              <input type="hidden" name="idpenulis" value="<?=$penulis->idpenulis?>">
              <input type="hidden" name="old_photo" value="<?=$penulis->foto?>">
              <input type="file" name="photo" class="btn btn-inverse-primary btn-block form-file-input">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Upload</button>
              <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </form>
        </div>
      </div>
      </div>

    </div>

<?php 
  echo view('templates/penulis_footer.php');
?>