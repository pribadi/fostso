<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Inventory</a></li>
                <li class="active">UPS</li>
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
                        <h3 class="box-title">UPS</h3>
                        <a href="<?php echo site_url('inventory/searchups');?>" class="btn btn-primary" style="float: right;">Back</a>   
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
                                    <label>Floor</label>
                                    <input class="form-control" name="floor" value="<?php echo $editdataUps->floor; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input class="form-control" name="location" value="<?php echo $editdataUps->location; ?>">
                                </div>
                                <div class="form-group">
                                    <label>UPS ID</label>
                                    <input class="form-control" name="ups_id" value="<?php echo $editdataUps->ups_id; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input class="form-control" name="merk" value="<?php echo $editdataUps->merk; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input class="form-control" name="type" value="<?php echo $editdataUps->type; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input class="form-control" name="sn" value="<?php echo $editdataUps->sn; ?>">
                                </div>
                                <div class="form-group">
                                    <label>R</label>
                                    <input class="form-control" name="r" value="<?php echo $editdataUps->r; ?>">
                                </div>
                                <div class="form-group">
                                    <label>S</label>
                                    <input class="form-control" name="s" value="<?php echo $editdataUps->s; ?>">
                                </div>
                                <div class="form-group">
                                    <label>T</label>
                                    <input class="form-control" name="t" value="<?php echo $editdataUps->t; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Capacity (KVA)</label>
                                    <input class="form-control" name="capacity" value="<?php echo $editdataUps->capacity; ?>">
                                </div>
                                <div class="form-group">
                                    <label># Modul</label>
                                    <input class="form-control" name="modul" value="<?php echo $editdataUps->modul; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kap Modul (KVA)</label>
                                    <input class="form-control" name="kap_modul" value="<?php echo $editdataUps->kap_modul; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Load (KVA)</label>
                                    <input class="form-control" name="load_kva" value="<?php echo $editdataUps->load_kva; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Load (%)</label>
                                    <input class="form-control" name="load_persen" value="<?php echo $editdataUps->load_persen; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Autonomi</label>
                                    <input class="form-control" name="autonomi" value="<?php echo $editdataUps->autonomi; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Battery Kap (Ah)</label>
                                    <input class="form-control" name="battery_kap" value="<?php echo $editdataUps->battery_kap; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Battery Merk/Type</label>
                                    <input class="form-control" name="battery_merk" value="<?php echo $editdataUps->battery_merk; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Battery Cell/Blok</label>
                                    <input class="form-control" name="battery_cell" value="<?php echo $editdataUps->battery_cell; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Battery QTY(Bank)</label>
                                    <input class="form-control" name="battery_qty" value="<?php echo $editdataUps->battery_qty; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Instalasi</label>
                                    <input class="form-control" name="tahun" value="<?php echo $editdataUps->tahun; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Maintenance</label>
                                    <input class="form-control" name="maintenance" value="<?php echo $editdataUps->maintenance; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PO Kontak</label>
                                    <input class="form-control" name="po_kontak" value="<?php echo $editdataUps->po_kontak; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Responsible</label>
                                    <input class="form-control" name="responsible" value="<?php echo $editdataUps->responsible; ?>">
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