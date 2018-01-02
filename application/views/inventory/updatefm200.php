<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Inventory</a></li>
                <li class="active">FM 200</li>
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
                        <h3 class="box-title">FM 200</h3>
                        <a href="<?php echo site_url('inventory/searchfm200');?>" class="btn btn-primary" style="float: right;">Back</a>   
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
                                    <label>FM 200 ID</label>
                                    <input class="form-control" name="fm200_id" value="<?php echo $editdataFm200->fm200_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" name="merk" value="<?php echo $editdataFm200->merk; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input class="form-control" name="type" value="<?php echo $editdataFm200->type; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input class="form-control" name="model" value="<?php echo $editdataFm200->model; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input class="form-control" name="sn" value="<?php echo $editdataFm200->sn; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Coverage Ruang</label>
                                    <input class="form-control" name="coverage" value="<?php echo $editdataFm200->coverage; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Operasi</label>
                                    <input class="form-control" name="tahun" value="<?php echo $editdataFm200->tahun; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Maintenance</label>
                                    <input class="form-control" name="maintenance" value="<?php echo $editdataFm200->maintenance; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Responsible</label>
                                    <input class="form-control" name="responsible" value="<?php echo $editdataFm200->responsible; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PO Kontak</label>
                                    <input class="form-control" name="po_kontak" value="<?php echo $editdataFm200->po_kontak; ?>">
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