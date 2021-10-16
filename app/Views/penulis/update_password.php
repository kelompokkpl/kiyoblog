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
                Change Password<i class="mdi mdi mdi-account ml-3"></i>
              </h4>
                <div class="table-responsive">
                  <table class="table">
                    <form method="POST" action="<?=base_url('penulis/updatePassword')?>">
                      <input type="hidden" name="idpenulis" value="<?=$penulis->idpenulis?>">
                      <tbody>
                        <tr>  
                          <th>Password Lama</th>
                          <td><input type="password" name="old_password" class="form-control <?php if ($validation->hasError('nama_penulis')) echo 'is-invalid'; ?>" minlength="5" maxlength="100" required>
                          <div class="text-danger mt-1">
                            <?php if ($validation->hasError('old_password')) echo $validation->getError('old_password'); ?>
                          </div>
                          </td>
                        </tr>
                        <tr>  
                          <th>Password Baru </th>
                          <td><input type="password" name="new_password" class="form-control <?php if ($validation->hasError('new_password')) echo 'is-invalid'; ?>" minlength="5" maxlength="100" required>
                          <div class="text-danger mt-1">
                            <?php if ($validation->hasError('new_password')) echo $validation->getError('new_password'); ?>
                          </div>
                          </td>
                        </tr>
                        <tr>  
                          <td colspan="2">
                            <button type="submit" class="btn btn-primary mt-2" name="submit">
                              Change
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

    </div>

<?php 
  echo view('templates/penulis_footer.php');
?>