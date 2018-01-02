<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">genset</li>
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
                        <h3 class="box-title">genset</h3>
                        <a href="<?php echo site_url('genset/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_genset" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_genset)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Time</label>
                                    <input class="form-control timepicker" name="time_genset" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_genset)); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Start</label>
                                    <input class="form-control" name="start" value="<?php echo $editdata->start; ?>">
                                </div>
                                <div class="form-group form-inline">
                                    <label>Engine Runtime</label>
                                    <div class="form-group">
                                        <input class="form-control" name="runtime_hour" value="<?php echo $editdata->runtime_hour; ?>" placeholder="Hour"> H
                                        <input class="form-control" name="runtime_minute" value="<?php echo $editdata->runtime_minute; ?>" placeholder="Minute"> m
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Battery Voltage</label>
                                    <input class="form-control" name="battery_voltage" value="<?php echo $editdata->battery_voltage; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Solar Harian (L)</label>
                                    <input class="form-control" name="solar_harian" value="<?php echo $editdata->solar_harian; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Solar Cadangan (L)</label>
                                    <input class="form-control" name="solar_cadangan" value="<?php echo $editdata->solar_cadangan; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input class="form-control" name="remark" value="<?php echo $editdata->remark; ?>">
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