<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user"></i> User</a></li>
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
                        <!-- <a href="<?php //echo site_url('user/search');?>" class="btn btn-primary" style="float: right;">Back</a>                     -->
                        <?php echo form_open_multipart('user/update/'.$editdata->id); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input class="form-control" name="fullname" value="<?php echo $editdata->fullname; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" value="<?php echo $editdata->username; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level">
                                        <option value="">...</option>
                                        <option value="Admin" <?php echo ($editdata->level == "Admin") ? "selected" : "" ?>>Admin</option>
                                        <option value="Member" <?php echo ($editdata->level == "Member") ? "selected" : "" ?>>Member</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input class="form-control" name="photo" type="file">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" value="" type="password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>