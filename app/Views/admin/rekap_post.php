<?php
  echo view('templates/admin_header.php');
  echo view('templates/admin_menu.php');
?>

<script type="text/javascript">
  function getKategori(val){
      url = '<?=base_url('admin/rekap_pdf');?>' + '/' + val
      pdf = document.getElementById('pdf').href = url
  }
</script>

 <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span>Data Post</h3>
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
                      Rekap Post<i class="mdi mdi-format-list-numbered ml-3"></i></h4>
                    <div class="table-responsive">
                      <table class="table" id="data">
                        <thead>
                          <tr>
                            <th> No </th>
                            <th> ID Kategori <i class="mdi mdi-sort"></i></th>
                            <th> Nama Kategori <i class="mdi mdi-sort"></i></th>
                            <th> Jumlah Postingan <i class="mdi mdi-sort"></i></th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($count_post as $row) {
                          echo '<tr>';
                          echo '<td>'.$i.'</td>';
                          echo '<td>'.$row->idkategori.'</td>';
                          echo '<td>'.ucfirst($row->nama_kategori).'</td>';
                          echo '<td>'.$row->frekuensi.'</td>';
                          if($row->frekuensi>0){
                            echo '<td><a class="btn btn-warning btn-sm" href="'.base_url('admin/daftar_post').'/'.$row->idkategori.'" title="Lihat Detail">Detail</a>&nbsp;&nbsp; 
                            </td>';
                          } else{
                            echo '<td><button class="btn btn-secondary btn-sm" title="Uhh.. Data 0, jadi tidak bisa melihat detail">Detail</button>&nbsp;&nbsp; 
                            </td>';
                          }
                          
                          echo '</tr>';
                          $i++;
                          } //end of foreach 
                          ?>
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