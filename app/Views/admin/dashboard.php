<?php
  echo view('templates/admin_header.php');
  echo view('templates/admin_menu.php');

  $i=0;
  foreach ($kategori as $kat) {
    $array[$i] = $kat->nama_kategori;
    $i++;
  }
  $j=0;
  foreach ($count_post as $count) {
    $frekuensi[$j] = $count->frekuensi * 1;
    $j++;
  }
?>

 <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Hallo <?php echo ucfirst($admin->nama_admin)?> ! Have a nice day :)</p>
                  <a href="#" class="btn download-button purchase-button ml-auto" id="bannerClose">Close</a>
                </span>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard</h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Kategori <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($kategori)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Penulis<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($penulis)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Posting<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=count($post)?></h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Data Post berdasarkan Kategori</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <figure class="highcharts-figure">
                      <div id="dataKategori"></div>
                      <button class="btn btn-primary" id="plain">Plain</button>
                      <button class="btn btn-primary" id="inverted">Inverted</button>
                      <button class="btn btn-primary" id="polar">Polar</button>
                    </figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->

<script type="text/javascript">
  var chart = Highcharts.chart('dataKategori', {

    title: {
        text: 'Post'
    },

    subtitle: {
        text: 'Plain'
    },

    xAxis: {
        categories: <?=json_encode($array);?>
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: <?=json_encode($frekuensi);?>,
        showInLegend: false
    }]

  });


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain'
        }
    });
});

$('#inverted').click(function () {
    chart.update({
        chart: {
            inverted: true,
            polar: false
        },
        subtitle: {
            text: 'Inverted'
        }
    });
});

$('#polar').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: true
        },
        subtitle: {
            text: 'Polar'
        }
    });
});
</script>

<?php 
  echo view('templates/admin_footer.php');
?>