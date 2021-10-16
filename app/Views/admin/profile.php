<?php
  echo view('templates/admin_header.php');
  echo view('templates/admin_menu.php');
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
      <?php if ($validation->hasError('photo')){ ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $validation->getError('photo');?>
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
                   <img src="<?=base_url("assets/uploads/admin/".$admin->foto);?>" alt="image" class="rounded-circle">
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
                  <?=$admin->nama_admin?>
                </h5>
                <div class="h5 font-weight-300">- Admin -
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card mt-4">
            <div class="card-body">
              <h4 class="card-title mt-3 mb-4">
                My Profile<i class="mdi mdi mdi-account ml-3"></i>
              </h4>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>  
                        <th>ID</th>
                        <td><?=$admin->idadmin?></td>
                      </tr>
                      <tr>  
                        <th>Nama </th>
                        <td><?=ucfirst($admin->nama_admin)?></td>
                      </tr>
                      <tr>  
                        <th>Email</th>
                        <td><?=$admin->email?></td>
                      </tr>
                      <tr>  
                        <td colspan="2">
                          <a href="<?=base_url('admin/edit_profile')?>" class="btn btn-primary mt-2">
                            Edit Profile
                          </a>
                          <a href="<?=base_url('admin/update_password')?>" class="btn btn-info mt-2">
                            Change Password
                          </a>
                        </td>
                      </tr>
                    </tbody>
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
          <form action="<?=base_url('admin/updatePhoto')?>" method="POST" enctype="multipart/form-data">
              <?= csrf_field(); ?>
            <div class="modal-body">
              <input type="hidden" name="idadmin" value="<?=$admin->idadmin?>">
              <input type="hidden" name="old_photo" value="<?=$admin->foto?>">
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
  echo view('templates/admin_footer.php');
?>