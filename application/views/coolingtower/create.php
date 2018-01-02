<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Cooling Tower</li>
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
                        <h3 class="box-title">Cooling Tower</h3>
                        <a href="<?php echo site_url('coolingtower/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_coolingtower" type="text" value="<?php echo set_value('date_coolingtower'); ?>">
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
                                    <input class="form-control timepicker" name="time_coolingtower" type="text" value="<?php echo set_value('time_coolingtower'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Motor Cooling Tower</label>
                                    <select class="form-control" name="motor_cooling">
                                        <option value="">...</option>
                                        <option value="Motor 1">Motor 1</option>
                                        <option value="Motor 2">Motor 2</option>
                                        <option value="Motor 3">Motor 3</option>
                                        <option value="Motor 1 & 2">Motor 1 & 2</option>
                                        <option value="Motor 1 & 3">Motor 1 & 3</option>
                                        <option value="Motor 2 & 3">Motor 2 & 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pump Cooling Tower</label>
                                    <select class="form-control" name="pump_cooling">
                                        <option value="">...</option>
                                        <option value="Pump A">Pump A</option>
                                        <option value="Pump B">Pump B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meter Cooling Tower (m3)</label>
                                    <input class="form-control" name="meter_cooling" value="<?php echo set_value('meter_cooling'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Water Supply Pump</label>
                                    <select class="form-control" name="water_supply">
                                        <option value="">...</option>
                                        <option value="On">On</option>
                                        <option value="Standby">Standby</option>
                                    </select>
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