<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script src="<?php //echo base_url('assets/js/plugins/jQuery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/datepicker/js/jquery.datetimepicker.full.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/js/plugins/chartjs/Chart.min.js'); ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php //echo base_url('assets/js/AdminLTE/dashboard2.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/AdminLTE/adminlte.min.js'); ?>" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/AdminLTE/demo.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datetimepicker({
            timepicker:false,
            format:'d/m/Y'
        });

        $('.timepicker').datetimepicker({
            datepicker:false,
            format:'H:i'
        });

        $('.monthpicker').datetimepicker({
            timepicker:false,
            format:'m/Y'
        });
    });

    function doconfirm()
    {
        job=confirm("Are you sure to delete permanently?");
        if(job!=true)
        {
            return false;
        }
    }
</script>