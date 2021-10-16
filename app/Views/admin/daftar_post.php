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
                      Daftar Post<i class="mdi mdi-format-list-numbered ml-3"></i></h4>
                      <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('admin/daftar_post');?>">
                          <div class="add-items d-flex col-md-8">
                              <select class="form-control" name="kat_post" onchange="getKategori(this.value)">
                                <option value="all">Semua kategori (<?=count($postt)?>)</option>
                                <?php
                                  foreach($count_post as $count){ 
                                    echo '<option value="'.$count->idkategori.'">'.ucfirst($count->nama_kategori).' ('.$count->frekuensi.')</option>';
                                  }
                                ?>
                              </select>
                              <button class="add btn btn-gradient-primary font-weight-bold" id="add-task" type="submit">GO</button>
                              <a href="<?=base_url('admin/rekap_pdf')?>" id="pdf">
                                  <button class="add btn btn-gradient-info font-weight-bold">PDF<i class="mdi mdi-file-pdf ml-2"></i></button>
                              </a>
                          </div>
                      </form>
                      <hr>
                    <br>
                    <span class="badge badge-success">
                      <?php
                        if (isset($kategori)){
                          echo 'Kategori : '.ucfirst($kategori->nama_kategori);
                        } else{
                          echo 'Kategori : Semua kategori';
                        }
                      ?>
                    </span>
                    <br><br>
                    <div class="table-responsive">
                      <table class="table" id="data">
                        <thead>
                          <tr>
                            <th> No </th>
                            <th> ID Post <i class="mdi mdi-sort"></i></th>
                            <th> Kategori <i class="mdi mdi-sort"></i></th>
                            <th> Judul <i class="mdi mdi-sort"></i></th>
                            <th> Penulis <i class="mdi mdi-sort"></i></th>
                            <th> Tanggal Post <i class="mdi mdi-sort"></i></th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($post as $row) {
                          echo '<tr>';
                          echo '<td>'.$i.'</td>';
                          echo '<td>'.$row->idpost.'</td>';
                          echo '<td>'.ucfirst($row->nama_kategori).'</td>';
                          echo '<td>'.ucfirst($row->judul).'</td>';
                          echo '<td>'.ucfirst($row->nama_penulis).'</td>';
                          echo '<td>'.substr($row->tgl_insert,0,10).'</td>';
                          echo '<td><a class="btn btn-warning btn-sm" href="'.base_url('admin/detail_post/').'/'.$row->idpost.'">Detail</a>&nbsp;&nbsp; 
                            </td>';
                          echo '</tr>';
                          $i++;
                          ?>
                          
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