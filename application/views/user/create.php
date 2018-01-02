<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> User</a></li>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">User</h3>
                        <a href="<?php echo site_url('user/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open_multipart('user/create'); ?> 
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input class="form-control" name="fullname" type="text" value="<?php echo set_value('fullname'); ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" type="text" value="<?php echo set_value('username'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level">
                                        <option value="">...</option>
                                        <option value="Admin" <?php echo set_select('level', 'Admin'); ?>>Admin</option>
                                        <option value="Member" <?php echo set_select('level', 'Member'); ?>>Member</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input class="form-control" name="photo" type="file" value="<?php echo set_value('photo'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" value="<?php echo set_value('password'); ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>