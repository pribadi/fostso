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
                    <?php echo form_open_multipart('wiring/create'); ?>
                    <form role="form">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Shift</label>
                                <select name="shift" class="form-control">
                                    <option value="">...</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Malam">Malam</option>
                                </select>
                            </div>
                            <!-- <div class="form-group"> -->
                                <!-- <label>Date</label> -->
                                <!-- <input class="form-control datepicker" name="date_wiring" type="text" value="<?php //echo set_value('date_wiring'); ?>" placeholder="Date"> -->
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            <!-- </div> -->
                            <!-- <div class="form-group"> -->
                                <!-- <label>Time</label> -->
                                <!-- <input class="form-control timepicker" name="time_wiring" type="text" value="<?php //echo set_value('time_wiring'); ?>" placeholder="Time"> -->
                            <!-- </div> -->
                            <div class="form-group">
                                <label>Floor</label>
                                <select name="floor" class="form-control">
                                    <option value="">...</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type Cooling</label>
                                <select name="cooling" class="form-control">
                                    <option value="">...</option>
                                    <option value="AC Portable">AC Portable</option>
                                    <option value="Ducting">Ducting</option>
                                    <option value="VRV">VRV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cooling Status</label>
                                <select name="status" class="form-control">
                                    <option value="">...</option>
                                    <option value="Off">Off</option>
                                    <option value="On">On</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Temperature</label>
                                <input class="form-control" name="temperature" value="<?php echo set_value('temperature'); ?>" placeholder="Temperature">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <legend># Speedtest</legend>
                                <div class="form-group">
                                    <input class="form-control" name="ping" value="<?php echo set_value('ping'); ?>" placeholder="Ping (Ms)">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="downlink" value="<?php echo set_value('downlink'); ?>" placeholder="Downlink (Mbps)">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="uplink" value="<?php echo set_value('uplink'); ?>" placeholder="Uplink (Mbps)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hardware Condition</label>
                                <select name="hardware_condition" class="form-control">
                                    <option value="">...</option>
                                    <option value="Not Ok">Not Ok</option>
                                    <option value="Ok">Ok</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Remark</label>
                                <textarea class="form-control" name="remark" rows="3"><?php echo set_value('remark'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                            </div>
                        </form>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
