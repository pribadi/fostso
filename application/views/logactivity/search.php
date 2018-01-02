<?php
    if ($this->session->userdata('username')=="") {
        redirect('auth');
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FOS - TSO</title>

        <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico')?>" type="image/x-icon">

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/js/plugins/morris/morris.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/datepicker/css/jquery.datetimepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

<body class="skin-blue">
    <div class="wrapper">
        <?php $this->load->view('top_navbar'); ?>
        
        <?php $this->load->view('side_navbar'); ?>

        <?php 
            $dataUser = $this->db->get_Where('user', array('id'=>$this->session->userdata('id')))->result_array(); 
            $image = $dataUser[0]['photo'];
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-eye"></i> Log Activity</a></li>
                        
                    </ol>
                    <?php if($this->session->flashdata('info')): ?>
                        <div class="box-body">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                    <?php echo $this->session->flashdata('info'); ?>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Log Activity</h3>
                                <a href="<?php echo site_url('logactivity/create'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                            </div>

                            <?php if($data): ?>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Activity</th>
                                            <th>Issue</th>
                                            <th>Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $v): ?>
                                            <tr>
                                                <td><?php echo date("Y/m/d", strtotime($v['datetime_log'])); ?></td>
                                                <td><?php echo date("H:i", strtotime($v['datetime_log'])); ?></td>
                                                <td><?php echo $v['activity']; ?></td>
                                                <td><?php echo $v['issue']; ?></td>
                                                <td><?php echo $v['remark']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('logactivity/update/' . $v['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                    <a href="<?php echo site_url('logactivity/delete/' . $v['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /#page-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2016-2017 <a href="#">FOS - TSO</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/AdminLTE/app.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/datepicker/js/jquery.datetimepicker.full.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/plugins/chartjs/Chart.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php //echo base_url('assets/js/AdminLTE/dashboard2.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/AdminLTE/adminlte.min.js'); ?>" type="text/javascript"></script>

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

        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
          })
    </script>

</body>
</html>







