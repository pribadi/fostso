<?php 
    $dataUser = $this->db->get_Where('user', array('id'=>$this->session->userdata('id')))->result_array(); 
    $image = $dataUser[0]['photo'];
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if (empty($image)): ?>
                    <img src="<?php echo base_url('assets/img/no-image.png'); ?>" class="img-circle" alt="User Image" />
                <?php else: ?>
                    <img src="<?php echo base_url('assets/upload/'.$image.''); ?>" class="img-circle" alt="User Image" />
                <?php endif; ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('fullname'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- <li class="treeview"> -->
            <li class="active treeview">
                <a href="<?php echo site_url('/');?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview menu-open">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Checklist</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Electrical
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span> 
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="<?php echo site_url('/lvmdp/search');?>"><i class="fa fa-circle-o"></i> LVMDP</a></li>
                            <li><a href="<?php echo site_url('/cosa/search');?>"><i class="fa fa-circle-o"></i> COS A</a></li>
                            <li><a href="<?php echo site_url('/mdpa/search');?>"><i class="fa fa-circle-o"></i> MDP A</a></li>
                            <li><a href="<?php echo site_url('/distributiona/search');?>"><i class="fa fa-circle-o"></i> Distribution A</a></li>
                            <li><a href="<?php echo site_url('/rectifier1/search');?>"><i class="fa fa-circle-o"></i> Rectifier 1</a></li>
                            <li><a href="<?php echo site_url('/rectifier2/search');?>"><i class="fa fa-circle-o"></i> Rectifier 2</a></li>
                            <li><a href="<?php echo site_url('/rectifier3/search');?>"><i class="fa fa-circle-o"></i> Rectifier 3</a></li>
                            <li><a href="<?php echo site_url('/upsa/search');?>"><i class="fa fa-circle-o"></i> UPS</a></li>
                            <li><a href="<?php echo site_url('/mechanicala/search');?>"><i class="fa fa-circle-o"></i> Mechanical A</a></li>
                            <li><a href="<?php echo site_url('/mechanicalb/search');?>"><i class="fa fa-circle-o"></i> Mechanical B</a></li>
                            <li><a href="<?php echo site_url('/pcoolingtowera/search');?>"><i class="fa fa-circle-o"></i> Cooling Tower A</a></li>
                            <li><a href="<?php echo site_url('/pcoolingtowerb/search');?>"><i class="fa fa-circle-o"></i> Cooling Tower B</a></li>
                            
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> CRAC
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span> 
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="<?php echo site_url('/batteryacrac1/search');?>"><i class="fa fa-circle-o"></i> Battery A 1</a></li>
                            <li><a href="<?php echo site_url('/batteryacrac2/search');?>"><i class="fa fa-circle-o"></i> Battery A 2</a></li>
                            <li><a href="<?php echo site_url('/batterybcrac1/search');?>"><i class="fa fa-circle-o"></i> Battery B 1</a></li>
                            <li><a href="<?php echo site_url('/dccrac1/search');?>"><i class="fa fa-circle-o"></i> Data Center 1</a></li>
                            <li><a href="<?php echo site_url('/dccrac2/search');?>"><i class="fa fa-circle-o"></i> Data Center 2</a></li>
                            <li><a href="<?php echo site_url('/dccrac3/search');?>"><i class="fa fa-circle-o"></i> Data Center 3</a></li>
                            <li><a href="<?php echo site_url('/dccrac4/search');?>"><i class="fa fa-circle-o"></i> Data Center 4</a></li>
                            <li><a href="<?php echo site_url('/poweracrac1/search');?>"><i class="fa fa-circle-o"></i> Power A 1</a></li>
                            <li><a href="<?php echo site_url('/poweracrac2/search');?>"><i class="fa fa-circle-o"></i> Power A 2</a></li>
                            <li><a href="<?php echo site_url('/powerbcrac1/search');?>"><i class="fa fa-circle-o"></i> Power B 1</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('/coolingtower/search');?>"><i class="fa fa-circle-o"></i> Cooling Tower</a></li>
                    <li><a href="<?php echo site_url('/genset/search');?>"><i class="fa fa-circle-o"></i> Genset</a></li>
                    <!-- <li><a href="<?php //echo site_url('/wiring/search');?>"><i class="fa fa-circle-o"></i> Wiring Room</a></li> -->
                    <li><a href="<?php echo site_url('/issue/search');?>"><i class="fa fa-circle-o"></i> Issue</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="<?php echo site_url('guestbook/search');?>">
                    <i class="fa fa-book"></i> <span>Guest Book</span>
                </a>
            </li>
            <li class="active treeview">
                <a href="<?php echo site_url('logactivity/search');?>">
                    <i class="fa fa-eye"></i> <span>Log Activity</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-o"></i> <span>Inventory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('/inventory/searchtrafo'); ?>"><i class="fa fa-circle-o"></i> Trafo</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchgenset'); ?>"><i class="fa fa-circle-o"></i> Genset</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchpanel'); ?>"><i class="fa fa-circle-o"></i> Panel</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchups'); ?>"><i class="fa fa-circle-o"></i> UPS</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchfm200'); ?>"><i class="fa fa-circle-o"></i> FM 200</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchcctv'); ?>"><i class="fa fa-circle-o"></i> CCTV</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchaccess'); ?>"><i class="fa fa-circle-o"></i> Access Control</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchapar'); ?>"><i class="fa fa-circle-o"></i> Apar</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchcoolingtower'); ?>"><i class="fa fa-circle-o"></i> Cooling Tower</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchcrac'); ?>"><i class="fa fa-circle-o"></i> CRAC</a></li>
                    <li><a href="<?php echo site_url('/inventory/searchcable'); ?>"><i class="fa fa-circle-o"></i> Cable</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <?php
                    if ($this->session->userdata('level')=="Admin"){
                        echo "<a href='" . site_url('/user/search') ."'><i class='fa fa-user fa-fw'></i> <span>User</span></a>";
                    }
                ?>
            </li>
            <li class="header">REPORT</li>
            <li><a href="<?php echo site_url('/report/checklist'); ?>"><i class="fa fa-circle-o text-info"></i> Checklist</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Healthy</a></li>
            <li><a href="<?php echo site_url('/report/search'); ?>"><i class="fa fa-circle-o text-info"></i> Monthly</a></li>
            <li><a href="<?php echo site_url('/inventory/map'); ?>"><i class="fa fa-circle-o text-info"></i> Map</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
