<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Inventory</a></li>
                <li class="active">CRAC</li>
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
                        <h3 class="box-title">CRAC</h3>
                        <a href="<?php echo site_url('inventory/searchcrac');?>" class="btn btn-primary" style="float: right;">Back</a>   
                        <br>
                        <br>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Side ID</label>
                                    <input class="form-control" name="" value="JSX 923" disabled>
                                    <input class="form-control" type="hidden" name="side_id" value="JSX 923">
                                </div>
                                <div class="form-group">
                                    <label>Crac ID</label>
                                    <input class="form-control" name="crac_id" value="<?php echo $editdataCrac->crac_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" name="merk" value="<?php echo $editdataCrac->merk; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input class="form-control" name="type" value="<?php echo $editdataCrac->type; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input class="form-control" name="model" value="<?php echo $editdataCrac->model; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Model Fan</label>
                                    <input class="form-control" name="model_fan" value="<?php echo $editdataCrac->model_fan; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phase</label>
                                    <input class="form-control" name="phase" value="<?php echo $editdataCrac->phase; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Delivery CRAC Vendor</label>
                                    <input class="form-control" name="vendor" value="<?php echo $editdataCrac->vendor; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Total Cooling</label>
                                    <input class="form-control" name="total_cooling" value="<?php echo $editdataCrac->total_cooling; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Capacity</label>
                                    <input class="form-control" name="capacity" value="<?php echo $editdataCrac->capacity; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sensible Cooling</label>
                                    <input class="form-control" name="sensible_cooling" value="<?php echo $editdataCrac->sensible_cooling; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sensible Capacity</label>
                                    <input class="form-control" name="sensible_capacity" value="<?php echo $editdataCrac->sensible_capacity; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Room Coverage</label>
                                    <input class="form-control" name="coverage" value="<?php echo $editdataCrac->coverage; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input class="form-control" name="sn" value="<?php echo $editdataCrac->sn; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Operasi</label>
                                    <input class="form-control" name="tahun" value="<?php echo $editdataCrac->tahun; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Maintenance</label>
                                    <input class="form-control" name="maintenance" value="<?php echo $editdataCrac->maintenance; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Responsible</label>
                                    <input class="form-control" name="responsible" value="<?php echo $editdataCrac->responsible; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PO Kontak</label>
                                    <input class="form-control" name="po_kontak" value="<?php echo $editdataCrac->po_kontak; ?>">
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