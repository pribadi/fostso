<div class="row">
    <div class="col-lg-12">
        <?php if(validation_errors()): ?>

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php //echo $this->session->flashdata('info'); ?>
                <?php echo validation_errors(); ?>
            </div>

        <?php endif; ?>
        <h1 class="page-header">Wiring Room</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Basic Form Elements -->
                <a href="<?php echo site_url('wiring/search');?>" class="btn btn-primary">Back</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php echo form_open_multipart('wiring/update/'.$editdata->id); ?>
                        <form role="form">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Shift</label>
                                    <select name="shift" class="form-control">
                                        <option value="">...</option>
                                        <option value="Pagi" <?= ($editdata->shift == "Pagi") ? "selected" : "" ?>>Pagi</option>
                                        <option value="Malam" <?= ($editdata->shift == "Malam") ? "selected" : "" ?>>Malam</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group"> -->
                                    <!-- <label>Date</label> -->
                                    <!-- <input class="form-control datepicker" name="date_wiring" type="text" value="<?php //echo date('d/m/Y', strtotime($editdata->datetime_wiring)); ?>"> -->
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                <!-- </div> -->
                                <!-- <div class="form-group"> -->
                                    <!-- <label>Time</label> -->
                                    <!-- <input class="form-control timepicker" name="time_wiring" type="text" value="<?php //echo date('H:i', strtotime($editdata->datetime_wiring)); ?>"> -->
                                <!-- </div> -->
                                <div class="form-group">
                                    <label>Floor</label>
                                    <select name="floor" class="form-control">
                                        <option value="">...</option>
                                        <option value="2" <?= ($editdata->floor == "2") ? "selected" : "" ?>>2</option>
                                        <option value="3" <?= ($editdata->floor == "3") ? "selected" : "" ?>>3</option>
                                        <option value="5" <?= ($editdata->floor == "5") ? "selected" : "" ?>>5</option>
                                        <option value="6" <?= ($editdata->floor == "6") ? "selected" : "" ?>>6</option>
                                        <option value="7" <?= ($editdata->floor == "7") ? "selected" : "" ?>>7</option>
                                        <option value="8" <?= ($editdata->floor == "8") ? "selected" : "" ?>>8</option>
                                        <option value="9" <?= ($editdata->floor == "9") ? "selected" : "" ?>>9</option>
                                        <option value="10" <?= ($editdata->floor == "10") ? "selected" : "" ?>>10</option>
                                        <option value="11" <?= ($editdata->floor == "11") ? "selected" : "" ?>>11</option>
                                        <option value="12" <?= ($editdata->floor == "12") ? "selected" : "" ?>>12</option>
                                        <option value="15" <?= ($editdata->floor == "15") ? "selected" : "" ?>>15</option>
                                        <option value="16" <?= ($editdata->floor == "16") ? "selected" : "" ?>>16</option>
                                        <option value="17" <?= ($editdata->floor == "17") ? "selected" : "" ?>>17</option>
                                        <option value="18" <?= ($editdata->floor == "18") ? "selected" : "" ?>>18</option>
                                        <option value="19" <?= ($editdata->floor == "19") ? "selected" : "" ?>>19</option>
                                        <option value="20" <?= ($editdata->floor == "20") ? "selected" : "" ?>>20</option>
                                        <option value="21" <?= ($editdata->floor == "21") ? "selected" : "" ?>>21</option>
                                        <option value="22" <?= ($editdata->floor == "22") ? "selected" : "" ?>>22</option>
                                        <option value="23" <?= ($editdata->floor == "23") ? "selected" : "" ?>>23</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>Type Cooling</label>
                                    <select name="cooling" class="form-control">
                                        <option value="">...</option>
                                        <option value="AC Portable" <?= ($editdata->cooling == "AC Portable") ? "selected" : "" ?>>AC Portable</option>
                                        <option value="Ducting" <?= ($editdata->cooling == "Ducting") ? "selected" : "" ?>>Ducting</option>
                                        <option value="VRV" <?= ($editdata->cooling == "VRV") ? "selected" : "" ?>>VRV</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>Cooling Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">...</option>
                                        <option value="Off" <?= ($editdata->status == "Off") ? "selected" : "" ?>>Off</option>
                                        <option value="On" <?= ($editdata->status == "On") ? "selected" : "" ?>>On</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Temperature</label>
                                    <input class="form-control" name="temperature" value="<?php echo $editdata->temperature; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <legend># Speedtest</legend>
                                    <div class="form-group">
                                        <input class="form-control" name="ping" value="<?php echo $editdata->ping; ?>" placeholder="Ping (Ms)">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="downlink" value="<?php echo $editdata->downlink; ?>" placeholder="Downlink (Mbps)">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="uplink" value="<?php echo $editdata->uplink; ?>" placeholder="Uplink (Mbps)">
                                    </div>
                                </div>
                                <div class="form-group">
                                <label>Hardware Condition</label>
                                    <select name="hardware_condition" class="form-control">
                                        <option value="">...</option>
                                        <option value="Not Ok" <?= ($editdata->hardware_condition == "Not Ok") ? "selected" : "" ?>>Not Ok</option>
                                        <option value="Ok" <?= ($editdata->hardware_condition == "Ok") ? "selected" : "" ?>>Ok</option>
                                    </select>
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
