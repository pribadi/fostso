<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">CRAC</li>
                <li class="active">Power A 1</li>
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
                        <h3 class="box-title">Power A 1</h3>
                        <a href="<?php echo site_url('poweracrac1/search');?>" class="btn btn-primary" style="float: right;">Back</a>                    
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_poweracrac1" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_poweracrac1)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Shift</label>
                                    <select class="form-control" name="shift">
                                        <option value="">...</option>
                                        <option value="Pagi" <?php echo ($editdata->shift == "Pagi") ? "selected" : "" ?>>Pagi</option>
                                        <option value="Malam" <?php echo ($editdata->shift == "Malam") ? "selected" : "" ?>>Malam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Time</label>
                                    <input class="form-control timepicker" name="time_poweracrac1" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_poweracrac1)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Temperature</label>
                                    <input class="form-control" name="temperature" value="<?php echo $editdata->temperature; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Humidity</label>
                                    <input class="form-control" name="humidity" value="<?php echo $editdata->humidity; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alarm Condition</label>
                                    <input class="form-control" name="alarm_condition" value="<?php echo $editdata->alarm_condition; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input class="form-control" name="remark" value="<?php echo $editdata->remark; ?>">
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