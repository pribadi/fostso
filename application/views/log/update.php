<div class="row">
    <div class="col-lg-12">
        <?php if(validation_errors()): ?>
        
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php //echo $this->session->flashdata('info'); ?>
                <?php echo validation_errors(); ?>
            </div>

        <?php endif; ?>
        <h1 class="page-header">Log Activity</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Basic Form Elements -->
                <a href="<?php echo site_url('log/search');?>" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body">

                <div class="row">      
                    <?php echo form_open_multipart('log/update/'.$editdata->id); ?>
	                    <form role="form">
	                        <div class="col-lg-6">
	                            <div class="form-group">
	                                <label>Date</label>
	                                <input class="form-control datepicker" name="date_log" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_log)); ?>">
	                                <!-- <p class="help-block">Example block-level help text here.</p> -->
	                            </div>
	                            <div class="form-group">
                                <label>Shift</label>
	                                <select name="shift" class="form-control">
	                                    <option value="">...</option>
	                                    <option value="Pagi" <?= ($editdata->shift == "Pagi") ? "selected" : "" ?>>Pagi (08:00 - 20:00 WIB)</option>
	                                    <option value="Malam" <?= ($editdata->shift == "Malam") ? "selected" : "" ?>>Malam (20:00 - 08:00 WIB)</option>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label>Activity</label>
	                                <textarea class="form-control" name="activity" rows="3"><?php echo $editdata->activity; ?></textarea>
	                            </div>
	                            <div class="form-group">
	                                <label>Floor</label>
	                                <input class="form-control" name="floor" value="<?php echo $editdata->floor; ?>">
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                                <input class="form-control" name="pic" type="hidden" value="<?php echo $this->session->userdata("fullname"); ?>">
	                            <div class="form-group">
	                                <label>Time</label>
	                                <input class="form-control timepicker" name="time_log" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_log)); ?>">
	                            </div>
	                            <div class="form-group">
	                                <label>Status</label>
	                                <input class="form-control" name="status" value="<?php echo $editdata->status; ?>">
	                            </div>
	                            <div class="form-group">
	                                <label>Documentation</label>
	                                <input class="form-control" name="doc" type="file">
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
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>