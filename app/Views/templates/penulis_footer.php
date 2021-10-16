<!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="<?=base_url('admin')?>">Kiyoblog</a>. All rights reserved. Template by BoostrapDash</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo base_url('assets/css/bootstrap-4.5.2-dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/chart.js/Chart.min.js');?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
    <script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
    <script src="<?php echo base_url('assets/js/misc.js');?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?php echo base_url('assets/js/dashboard.js');?>"></script>
    <script src="<?php echo base_url('assets/js/todolist.js');?>"></script>
    <!-- End custom js for this page -->

    <script type="text/javascript">
      $(document).ready(function() {
        $('#data').DataTable();
      } );
    </script>

  </body>
</html>