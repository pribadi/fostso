<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-book"></i> Guest Book</a></li>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Guest Book</h3>
                        <a href="<?php echo site_url('guestbook/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_guestbook" type="text" value="<?php echo set_value('date_guestbook'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Guest Name</label>
                                    <input class="form-control" name="guest_name" value="<?php echo set_value('guest_name'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" value="<?php echo set_value('phone'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Company</label>
                                    <input class="form-control" name="company" value="<?php echo set_value('company'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Activity</label>
                                    <textarea class="form-control" name="activity" rows="3"><?php echo set_value('activity'); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>SIK</label>
                                    <input class="form-control" name="sik" value="<?php echo set_value('sik'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>PIC Tsel</label>
                                    <input class="form-control" name="pic_tsel" value="<?php echo set_value('pic_tsel'); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Laptop</label>
                                    <input class="form-control" name="laptop" value="<?php echo set_value('laptop'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>In</label>
                                    <input class="form-control timepicker" name="guest_in" type="text" value="<?php echo set_value('guest_in'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Out</label>
                                    <input class="form-control timepicker" name="guest_out" type="text" value="<?php echo set_value('guest_out'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Floor</label>
                                    <input class="form-control" name="floor" value="<?php echo set_value('floor'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Visitor</label>
                                    <input class="form-control" name="visitor" value="<?php echo set_value('visitor'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Acces</label>
                                    <input class="form-control" name="acces" value="<?php echo set_value('acces'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>NDA</label>
                                    <input class="form-control" name="nda" value="<?php echo set_value('nda'); ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>