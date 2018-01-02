<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">CRAC</li>
                <li class="active">Power B 1</li>
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
                        <h3 class="box-title">Power B 1</h3>
                        <a href="<?php echo site_url('powerbcrac1/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_powerbcrac1" type="text" value="<?php echo set_value('date_powerbcrac1'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Shift</label>
                                    <select class="form-control" name="shift">
                                        <option value="">...</option>
                                        <option value="Pagi" <?php echo set_select('shift', 'Pagi'); ?>>Pagi</option>
                                        <option value="Malam" <?php echo set_select('shift', 'Malam'); ?>>Malam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Time</label>
                                    <input class="form-control timepicker" name="time_powerbcrac1" type="text" value="<?php echo set_value('time_powerbcrac1'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Temperature</label>
                                    <input class="form-control" name="temperature" value="<?php echo set_value('temperature'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Humidity</label>
                                    <input class="form-control" name="humidity" value="<?php echo set_value('humidity'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alarm Condition</label>
                                    <input class="form-control" name="alarm_condition" value="<?php echo set_value('alarm_condition'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input class="form-control" name="remark" value="<?php echo set_value('remark'); ?>">
                                </div>
                                <input class="form-control" name="fs_name" type="hidden" value="<?php echo $this->session->userdata("fullname"); ?>">
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