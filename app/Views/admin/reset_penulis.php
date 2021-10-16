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
                </span>Reset Password Penulis</h3>
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
                    <h4 class="card-title mt-2 mb-4">
                      Daftar Request Reset Password Penulis</h4>
                      <hr>
                    <div class="table-responsive">
                      <table class="table" id="data">
                        <thead>
                          <tr>
                            <th> No </th>
                            <th> ID Request <i class="mdi mdi-sort"></i></th>
                            <th> Waktu Request <i class="mdi mdi-sort"></i></th>
                            <th> Email Penulis <i class="mdi mdi-sort"></i></th>
                            <th> Status <i class="mdi mdi-sort"></i></th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($request as $row) {
                          echo '<tr>';
                          echo '<td>'.$i.'</td>';
                          echo '<td>'.$row->idrequest.'</td>';
                          echo '<td>'.$row->tgl.'</td>';
                          echo '<td>'.$row->email.'</td>';
                          if($row->status == 'request'){
                            echo '<td><label class="badge badge-gradient-danger">'.ucfirst($row->status).'</label></td>';
                            echo '<td><a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#konfirmReset'.$row->idrequest.'" title="Kirim email pemulihan password">Reset<i class="mdi mdi-backup-restore ml-2"></i></a>';
                            ?>
                            <a href="#" data-toggle="modal" data-target="#konfDel<?=$row->idrequest?>" title="Delete Request">
                            <button class="btn btn-inverse-danger btn-sm">
                              <i class="mdi mdi-delete-forever"></i>
                            </button>
                            </a> 
                            </td>
                          </tr>
                          <!-- Modal Confirm Reset -->
                          <div class="modal fade" id="konfirmReset<?=$row->idrequest?>" tabindex="-1" role="dialog" aria-labelledby="konfResetlabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="konfResetlabel">Kiyoblog's system says</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Bila Anda mereset password, maka sistem akan mengirim email berisi password baru kepada penulis. <br>Yakin reset password?
                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo base_url('admin/reset_penulis/send/'.$row->idrequest.'/'.$row->email) ?>"  class="btn btn-success">Yes</a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                </div>
                              </div>
                            </div>

                             <!-- Modal Confirm Delete -->
                          <div class="modal fade" id="konfDel<?=$row->idrequest?>" tabindex="10" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Kiyoblog's system says</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">Yakin delete request?
                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo base_url('ReqReset/delete/'.$row->idrequest) ?>"  class="btn btn-danger">Yes</a>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                </div>
                              </div>
                            </div>

                          <?php
                          } else{
                            echo '<td><label class="badge badge-gradient-success">'.ucfirst($row->status).'</label></td>';
                            echo '<td><button class="btn btn-secondary btn-sm" title="Request sudah ter-handle">Reset<i class="mdi mdi-backup-restore ml-2"></i></button></td>';
                            }
                          $i++;
                           } //end of foreach ?>
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