<?php
    if ($this->session->userdata('username')=="") {
        redirect('auth');
    }
 ?>

<?php $this->load->view('head'); ?>

<body class="skin-blue">
    <div class="wrapper">


			<?php $this->load->view('top_navbar'); ?>

			<?php $this->load->view('side_navbar'); ?>

			<?php $this->load->view($content); ?>
        <!-- /#page-wrapper -->

      <footer class="main-footer">
          <div class="pull-right hidden-xs">
              <b>Version</b> 2.0
          </div>
          <strong>Copyright &copy; 2016-2017 <a href="#">FOS - TSO</a>.</strong> All rights reserved.
      </footer>

    </div>
    <!-- /#wrapper -->
  <?php $this->load->view('footer'); ?>
</body>

</html>
