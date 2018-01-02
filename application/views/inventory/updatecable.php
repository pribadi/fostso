<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Inventory</a></li>
                <li class="active">Cable</li>
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
                        <h3 class="box-title">Cable</h3>
                        <a href="<?php echo site_url('inventory/searchcable');?>" class="btn btn-primary" style="float: right;">Back</a>   
                        <br>
                        <br>
                        <?php echo form_open(); ?>
                        <form role="form">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" name="merk" value="<?php echo $editdataCable->merk; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input class="form-control" name="type" value="<?php echo $editdataCable->type; ?>">
                                    <p>Contoh : UTP</p>
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input class="form-control" name="model" value="<?php echo $editdataCable->model; ?>">
                                    <p>Contoh : Cat 6</p>
                                </div>
                                <div class="form-group">
                                    <label>Ukuran</label>
                                    <input class="form-control" name="ukuran" value="<?php echo $editdataCable->ukuran; ?>">
                                    <p>Contoh : 33 Ft</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Warna</label>
                                    <input class="form-control" name="warna" value="<?php echo $editdataCable->warna; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control" name="jumlah" value="<?php echo $editdataCable->jumlah; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input class="form-control" name="satuan" value="<?php echo $editdataCable->satuan; ?>">
                                    <p>Contoh : Pcs</p>
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