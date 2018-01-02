<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Inventory</a></li>
                <li class="active">Apar</li>
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
                        <h3 class="box-title">Apar</h3>
                        <a href="<?php echo site_url('inventory/searchapar');?>" class="btn btn-primary" style="float: right;">Back</a>
                        <br/>
                        <br/>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Side ID</label>
                                    <input class="form-control" name="" value="JSX 923" disabled>
                                    <input class="form-control" type="hidden" name="side_id" value="JSX 923">
                                </div>
                                <div class="form-group">
                                    <label>Floor</label>
                                    <input class="form-control" name="floor" value="<?php echo set_value('floor'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Room</label>
                                    <input class="form-control" name="room" value="<?php echo set_value('room'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Apar ID</label>
                                    <input class="form-control" name="apar_id" value="<?php echo set_value('apar_id'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" name="merk" value="<?php echo set_value('merk'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input class="form-control" name="model" value="<?php echo set_value('model'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <input class="form-control" name="class" value="<?php echo set_value('class'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Operasi</label>
                                    <input class="form-control" name="tahun" value="<?php echo set_value('tahun'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Maintenance</label>
                                    <input class="form-control" name="maintenance" value="<?php echo set_value('maintenance'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Responsible</label>
                                    <input class="form-control" name="responsible" value="<?php echo set_value('responsible'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>PO Kontak</label>
                                    <input class="form-control" name="po_kontak" value="<?php echo set_value('po_kontak'); ?>">
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