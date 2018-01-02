<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Electrical</li>
                <li class="active">UPS A</li>
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
                        <h3 class="box-title">UPS A</h3>
                        <a href="<?php echo site_url('upsa/search');?>" class="btn btn-primary" style="float: right;">Back</a>               
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="date_upsa" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_upsa)); ?>">
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
                                    <input class="form-control timepicker" name="time_upsa" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_upsa)); ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <legend># Phase To Phase (Volt)</legend>
                                    <div class="form-group">
                                        <label>R-S</label>
                                        <input class="form-control" name="rs" value="<?php echo $editdata->rs; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>S-T</label>
                                        <input class="form-control" name="st" value="<?php echo $editdata->st; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>T-R</label>
                                        <input class="form-control" name="tr" value="<?php echo $editdata->tr; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Freq (Hz)</label>
                                    <input class="form-control" name="freq" value="<?php echo $editdata->freq; ?>">
                                </div>

                                <div class="form-group">
                                    <legend># Current (Amp)</legend>
                                    <div class="form-group">
                                        <label>R</label>
                                        <input class="form-control" name="current_amp_r" value="<?php echo $editdata->current_amp_r; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>S</label>
                                        <input class="form-control" name="current_amp_s" value="<?php echo $editdata->current_amp_s; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>T</label>
                                        <input class="form-control" name="current_amp_t" value="<?php echo $editdata->current_amp_t; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <legend># Current (Amp)</legend>
                                    <div class="form-group">
                                        <label>R</label>
                                        <input class="form-control" name="current_persen_r" value="<?php echo $editdata->current_persen_r; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>S</label>
                                        <input class="form-control" name="current_persen_s" value="<?php echo $editdata->current_persen_s; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>T</label>
                                        <input class="form-control" name="current_persen_t" value="<?php echo $editdata->current_persen_t; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <legend># Load</legend>
                                    <div class="form-group">
                                        <label>Kva</label>
                                        <input class="form-control" name="load_kva" value="<?php echo $editdata->load_kva; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>%</label>
                                        <input class="form-control" name="load_persen" value="<?php echo $editdata->load_persen; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Auto (Min)</label>
                                    <input class="form-control" name="auto_minutes" value="<?php echo $editdata->auto_minutes; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Batt. Volt. (Ub)</label>
                                    <input class="form-control" name="battery" value="<?php echo $editdata->battery; ?>">
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