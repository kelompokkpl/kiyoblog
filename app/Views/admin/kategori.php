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
                </span>Data Kategori</h3>
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
                    <h4 class="card-title">Tambah Kategori<i class="mdi mdi-database-plus ml-3"></i></h4>
                      <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('admin/kategori/save');?>">
                          <div class="add-items d-flex col-md-7">
                              <input type="text" class="form-control todo-list-input" placeholder="Masukkan nama kategori" name="nama_kategori" minlength="3" maxlength="30" required value="<?php echo old('nama_kategori');?>">
                              <button class="add btn btn-gradient-primary font-weight-bold" id="add-task" type="submit">Add</button>
                              <button class="btn btn-secondary font-weight-bold" type="reset">Reset</button>
                          </div>
                      </form>
                    <hr>
                    <h4 class="card-title mt-4 mb-4">
                      Daftar Kategori<i class="mdi mdi-format-list-numbered ml-3"></i></h4>
                    <div class="table-responsive">
                      <table class="table" id="data">
                        <thead>
                          <tr>
                            <th> No </th>
                            <th> ID Kategori <i class="mdi mdi-sort"></i></th>
                            <th> Nama Kategori <i class="mdi mdi-sort"></i></th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($kategori as $row) {
                          echo '<tr>';
                          echo '<td>'.$i.'</td>';
                          echo '<td>'.$row->idkategori.'</td>';
                          echo '<td>'.ucfirst($row->nama_kategori).'</td>';
                          echo '<td><a class="btn btn-warning btn-sm" href="'.base_url('admin/kategori/update').'/'.$row->idkategori.'">Edit</a>&nbsp;&nbsp; 
                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#konfirmDelete'.$row->idkategori.'">Delete</a>
                            </td>';
                          echo '</tr>';
                          $i++;
                          ?>
                          
                          <!-- Modal Confirm Delete -->
                          <div class="modal fade" id="konfirmDelete<?=$row->idkategori?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Kiyoblog's system says</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  You really wanna delete data <b>'<?=$row->nama_kategori?>'</b>?
                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo base_url('admin/kategori/delete/'.$row->idkategori) ?>"  class="btn btn-secondary">Yes</a>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                </div>
                              </div>
                            </div>

                          <?php } //end of foreach ?>
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