<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('/');?>" class="logo"><b>FOS - </b>TSO</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                <!-- Notifications: style can be found in dropdown.less -->
                <?php $dataIssue = $this->db->get_Where('issue', array('status'=>'Open'))->result_array(); ?>
                
                <?php if ($dataIssue): ?>

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?php echo count($dataIssue); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php echo count($dataIssue); ?> issue</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach ($dataIssue as $v): ?>
                                    <li>
                                        <a href="<?php echo site_url('issue/update/' . $v['id']); ?>">
                                            <i class="fa fa-warning text-yellow"></i> <?php echo $v['issue']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="<?php echo site_url('/issue/search');?>">View all</a></li>
                    </ul>
                </li>

            <?php endif; ?>

            <?php 
                $dataUser = $this->db->get_Where('user', array('id'=>$this->session->userdata('id')))->result_array(); 
                $image = $dataUser[0]['photo'];
            ?>

               
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if (empty($image)): ?>
                            <img src="<?php echo base_url('assets/img/no-image.png'); ?>" class="user-image" alt="User Image"/>
                        <?php else: ?>
                            <img src="<?php echo base_url('assets/upload/'.$image.''); ?>" class="user-image" alt="User Image"/>
                        <?php endif; ?>
                        <span class="hidden-xs"><?php echo $this->session->userdata("fullname"); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (empty($image)): ?>
                                <img src="<?php echo base_url('assets/img/no-image.png'); ?>" class="img-circle" alt="User Image" />
                            <?php else: ?>
                                <img src="<?php echo base_url('assets/upload/'.$image.''); ?>" class="img-circle" alt="User Image" />
                            <?php endif; ?>
                            <p>
                                <?php echo $this->session->userdata("fullname"); ?>
                                <small>Member since Nov. 2017</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo site_url('user/update/' . $this->session->userdata('id')); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url('/auth/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
