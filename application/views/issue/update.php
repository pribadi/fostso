<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Issue</li>
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
                        <h3 class="box-title">Issue</h3>
                        <a href="<?php echo site_url('issue/search');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control datepicker" name="tanggal" type="text" value="<?php echo date('d/m/Y', strtotime($editdata->tanggal)); ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Issue</label>
                                    <textarea class="form-control" name="issue" rows="3"><?php echo $editdata->issue; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option>...</option>
                                        <option value="Open" <?php echo ($editdata->status == "Open") ? "selected" : "" ?>>Open</option>
                                        <option value="Close" <?php echo ($editdata->status == "Close") ? "selected" : "" ?>>Close</option>
                                    </select>
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