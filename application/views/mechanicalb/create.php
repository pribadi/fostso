<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Electrical</li>
                <li class="active">Mechanical B</li>
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
                        <h3 class="box-title">Mechanical B</h3>
                        <a href="<?php echo site_url('mechanicalb/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control datepicker" name="date_mechanicalb" type="text" value="<?php echo set_value('date_mechanicalb'); ?>">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
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
                                        <input class="form-control timepicker" name="time_mechanicalb" type="text" value="<?php echo set_value('time_mechanicalb'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <legend># Phase To Phase (Volt)</legend>
                                        <div class="form-group">
                                            <label>R-S</label>
                                            <input class="form-control" name="rs" value="<?php echo set_value('rs'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>S-T</label>
                                            <input class="form-control" name="st" value="<?php echo set_value('st'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>T-R</label>
                                            <input class="form-control" name="tr" value="<?php echo set_value('tr'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <legend># Phase To Neutral (Volt)</legend>
                                        <div class="form-group">
                                            <label>R-N</label>
                                            <input class="form-control" name="rn" value="<?php echo set_value('rn'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>S-N</label>
                                            <input class="form-control" name="sn" value="<?php echo set_value('sn'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>T-N</label>
                                            <input class="form-control" name="tn" value="<?php echo set_value('tn'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <legend># Current (Amp)</legend>
                                        <div class="form-group">
                                            <label>R</label>
                                            <input class="form-control" name="r" value="<?php echo set_value('r'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>S</label>
                                            <input class="form-control" name="s" value="<?php echo set_value('s'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>T</label>
                                            <input class="form-control" name="t" value="<?php echo set_value('t'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Freq (Hz)</label>
                                        <input class="form-control" name="freq" value="<?php echo set_value('freq'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>KVA</label>
                                        <input class="form-control" name="kva" value="<?php echo set_value('kva'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>PF</label>
                                        <input class="form-control" name="pf" value="<?php echo set_value('pf'); ?>">
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
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>