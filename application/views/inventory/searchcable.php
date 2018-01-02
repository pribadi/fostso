<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Cable</li>
            </ol>
            <?php if($this->session->flashdata('info')): ?>
                <div class="box-body">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $this->session->flashdata('info'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Cable</h3>
                    <a href="<?php echo site_url('inventory/createcable'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <?php if($datacable): ?>
                                    <tr>
                                        <th>No.</th>
                                        <th>Merk</th>
                                        <th>Type</th>
                                        <th>Model</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                <?php endif; ?>
                                </thead>
                                <tbody>
                                   <?php
                                        $no = 1;
                                     ?>
                                    <?php foreach ($datacable as $cable): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $cable['merk']; ?></td>
                                            <td><?php echo $cable['type']; ?></td>
                                            <td><?php echo $cable['model']; ?></td>
                                            <td><?php echo $cable['ukuran']; ?></td>
                                            <td><?php echo $cable['warna']; ?></td>
                                            <td><?php echo $cable['jumlah']; ?></td>
                                            <td><?php echo $cable['satuan']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updatecable/' . $cable['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deletecable/' . $cable['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>