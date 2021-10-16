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
                </span>Category</h3>
            </div>  
            <?php if(!empty(session()->getFlashdata('failed'))){ ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo session()->getFlashdata('failed');
                  ?>
                </div> 
            <?php } ?>
            <div class="d-flex align-items-center mx-auto">
            <div class="col-md-5 stretch-card mx-auto">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Category Data</h4>
                    <div>
                      <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('admin/kategori/save'.'/'.$row->idkategori);?>">
                        <div class="form-group">
                          <label>ID Kategori</label>
                          <input type="text" class="form-control"  name="idkategori" value="<?=$row->idkategori?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nama Kategori</label>
                          <input type="text" class="form-control todo-list-input" placeholder="Masukkan nama kategori" name="nama_kategori" minlength="3" maxlength="30" required value="<?=$row->nama_kategori?>">
                        </div>
                        <button class="add btn btn-gradient-primary font-weight-bold" type="submit">Update</button>
                        <a href="<?=base_url('admin/kategori')?>">
                          <button class="add btn btn-secondary font-weight-bold" type="button">Cancel</button>
                        </a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>


<?php
  echo view('templates/admin_footer.php');
?>