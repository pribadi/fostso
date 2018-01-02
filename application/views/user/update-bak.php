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
            <?php 
                if (!empty($error)) {
                    echo $error;
                }
             ?>
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
                                        <!-- <h3 class="profile-username text-center"><?php //echo $data->fullname; ?></h3> -->
                                    <?php if (empty($image)): ?>
                                        <img class="profile-user-img img-responsive" src="<?php echo base_url('assets/img/no-image.png'); ?>" alt="User profile picture">
                                    <?php else: ?>
                                        <img class="profile-user-img img-responsive" src="<?php echo base_url('assets/upload/user/'.$editdata->photo.''); ?>" alt="User profile picture">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if($this->session->userdata('level')=='Admin'): ?>
                                        <a href="<?php echo site_url('user/search'); ?>" class="btn btn-primary btn-block"><b>Back</b></a>
                                    <?php endif; ?>
                                    <div class="box-body box-profile">
                                        <?php echo form_open_multipart('user/update/' . $editdata->id); ?> 
                                        <form role="form">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">About Me</h3>
                                            </div>
                                            <br>          
                                            <strong><i class="fa fa-chevron-right margin-r-5"></i> Fullname</strong>
                                            <input class="form-control" name="fullname" type="text" value="<?php echo $editdata->fullname; ?>">
                                            <hr>
                                            <strong><i class="fa fa-chevron-right margin-r-5"></i> Username</strong>
                                            <input class="form-control" name="username" type="text" value="<?php echo $editdata->username; ?>">
                                            <hr>
                                            <strong><i class="fa fa-chevron-right margin-r-5"></i> Level</strong>
                                            <?php if($this->session->userdata('level')=='Admin'): ?>
                                                <select name="level" class="form-control">
                                                    <option value="">...</option>
                                                    <option value="Admin" <?php echo ($editdata->level == "Admin") ? "selected" : "" ?>>Admin</option>
                                                    <option value="Member" <?php echo ($editdata->level == "Member") ? "selected" : "" ?>>Member</option>
                                                </select>
                                            <?php else: ?>
                                                <input class="form-control" type="text" name="" value="Member" disabled="disabled">
                                                <input type="hidden" name="level" value="Member">
                                            <?php endif; ?>
                                            <hr>
                                            <strong><i class="fa fa-chevron-right margin-r-5"></i> Photo</strong>
                                            <input class="form-control" name="photo" type="file" value="">
                                            <hr>
                                            <strong><i class="fa fa-chevron-right margin-r-5"></i> Password</strong>
                                            <input class="form-control" name="password" type="password" value="">
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                                        </form>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>