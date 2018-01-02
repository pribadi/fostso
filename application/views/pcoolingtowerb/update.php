<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Electrical</li>
                <li class="active">Cooling Tower B</li>
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
                        <h3 class="box-title">Panel Cooling Tower B</h3>
                        <a href="<?php echo site_url('pcoolingtowerb/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control datepicker" name="date_pcoolingtowerb" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->datetime_pcoolingtowerb)); ?>">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
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
                                        <input class="form-control timepicker" name="time_pcoolingtowerb" type="text" value="<?php echo date('H:i', strtotime($editdata->datetime_pcoolingtowerb)); ?>">
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
                                    <div class="form-group">
                                        <legend># Phase To Neutral (Volt)</legend>
                                        <div class="form-group">
                                            <label>R-N</label>
                                            <input class="form-control" name="rn" value="<?php echo $editdata->rn; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>S-N</label>
                                            <input class="form-control" name="sn" value="<?php echo $editdata->sn; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>T-N</label>
                                            <input class="form-control" name="tn" value="<?php echo $editdata->tn; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <legend># Current (Amp)</legend>
                                        <div class="form-group">
                                            <label>R</label>
                                            <input class="form-control" name="r" value="<?php echo $editdata->r; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>S</label>
                                            <input class="form-control" name="s" value="<?php echo $editdata->s; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>T</label>
                                            <input class="form-control" name="t" value="<?php echo $editdata->t; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Freq (Hz)</label>
                                        <input class="form-control" name="freq" value="<?php echo $editdata->freq; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>KVA</label>
                                        <input class="form-control" name="kva" value="<?php echo $editdata->kva; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>PF</label>
                                        <input class="form-control" name="pf" value="<?php echo $editdata->pf; ?>">
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
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datetimepicker({
      timepicker:false,
      format:'d/m/Y'
    });

    $('.timepicker').datetimepicker({
      datepicker:false,
      format:'H:i'
    });

    $('.monthpicker').datetimepicker({
      timepicker:false,
      format:'m/Y'
    });

  //     $('.dataTabel').DataTable();
  });
</script>