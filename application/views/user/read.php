<?php 
    $dataUser = $this->db->get_Where('user', array('id'=>$this->session->userdata('id')))->result_array(); 
    $image = $dataUser[0]['photo'];
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user"></i> User</a></li>
            </ol>
            <?php if(validation_errors()): ?>
            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Failed!</h4>
                        <?php echo validation_errors(); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="col-md-6">
                                    <?php if (empty($image)): ?>
                                        <img class="profile-user-img img-responsive" src="<?php echo base_url('assets/img/no-image.png'); ?>" alt="User profile picture">
                                    <?php else: ?>
                                        <img class="profile-user-img img-responsive" src="<?php echo base_url('assets/upload/user/'.$data->photo.''); ?>" alt="User profile picture">
                                    <?php endif; ?>
                                        <!-- <h3 class="profile-username text-center"><?php //echo $data->fullname; ?></h3> -->
                                </div>
                                <div class="col-md-6">
                                    <?php if($this->session->userdata('level')=='Admin'): ?>
                                        <a href="<?php echo site_url('user/search'); ?>" class="btn btn-primary btn-block"><b>Back</b></a>
                                    <?php endif; ?>
                                    <form role="form">
                                    <div class="box-body box-profile">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">About Me</h3>
                                        </div>
                                        <br>          
                                        <strong><i class="fa fa-chevron-right margin-r-5"></i> Fullname</strong>
                                        <p class="text-muted"><?php echo $data->fullname; ?></p>
                                        <hr>
                                        <strong><i class="fa fa-chevron-right margin-r-5"></i> Username</strong>
                                        <p class="text-muted"><?php echo $data->username; ?></p>
                                        <hr>
                                        <strong><i class="fa fa-chevron-right margin-r-5"></i> Level</strong>
                                        <p class="text-muted"><?php echo $data->level; ?></p>
                                        <hr>
                                        <!-- <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                                        <p class="text-muted"></p>
                                        <input class="form-control" name="password" type="password" value="">
                                        <hr>
                                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                                        <p>
                                            <span class="label label-danger">UI Design</span>
                                            <span class="label label-success">Coding</span>
                                            <span class="label label-info">Javascript</span>
                                            <span class="label label-warning">PHP</span>
                                            <span class="label label-primary">Node.js</span>
                                        </p>
                                        <hr>
                                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
                                    </div>
                                    <a href="<?php echo site_url('user/update/'.$data->id); ?>" class="btn btn-primary btn-block"><b>Update</b></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>