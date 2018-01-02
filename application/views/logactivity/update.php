<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-eye"></i> Log Activity</a></li>
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
                        <h3 class="box-title">Log Activity</h3>
                        <a href="<?php echo site_url('logactivity/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open_multipart('logactivity/update/'.$editdata->id); ?> 
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_log" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_log)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Time</label>
                                    <input class="form-control timepicker" name="time_log" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_log)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Activity</label>
                                    <input class="form-control" name="activity" type="text" value="<?php echo $editdata->activity; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Issue</label>
                                    <textarea class="form-control" name="issue" rows="3"><?php echo $editdata->issue; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="remark" rows="3"><?php echo $editdata->remark; ?></textarea>
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