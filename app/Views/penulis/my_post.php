<?php
  echo view('templates/penulis_header.php');
  echo view('templates/penulis_menu.php');
?>

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
                      <form class="pt-3" method="POST" autocomplete="on" action="<?php echo base_url('penulis/my_post');?>">
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
                          echo '<td><a href="'.base_url('article/'.$row->slug).'" title="Kunjungi halaman" target="_blank">'.ucfirst($row->judul).'</a></td>';
                          echo '<td>'.date('d F Y', strtotime($row->tgl_insert)).'</td>';
                          ?>
                          <td>
                            <a href="<?=base_url('penulis/edit_post/').'/'.$row->idpost?>" title="Edit Postingan">
                            <button class="btn btn-inverse-warning btn-icon">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            </a>
                            <a href="<?=base_url('penulis/detail_post/').'/'.$row->idpost?>" title="Detail Postingan">
                            <button class="btn btn-inverse-info btn-icon">
                              <i class="mdi mdi-eye"></i>
                            </button>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#konfirmDel<?=$row->idpost?>" title="Delete Postingan">
                            <button class="btn btn-inverse-danger btn-icon">
                              <i class="mdi mdi-delete-forever"></i>
                            </button>
                            </a>
                          </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="konfirmDel<?=$row->idpost?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kiyoblog's system says</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Everyone can not read this post again if you delete this post. You really wanna delete? 
                              </div>
                              <div class="modal-footer">
                                <a href="<?=base_url('post/delete/'.$row->idpost.'/'.$row->file_gambar)?>" class="btn btn-primary">Yes</button>
                                </a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
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
  echo view('templates/penulis_footer.php');
?>