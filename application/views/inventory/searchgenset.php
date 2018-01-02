<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Genset</li>
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
                        <h3 class="box-title">Genset</h3>
                    <a href="<?php echo site_url('inventory/creategenset'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <?php if($dataGenset): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Side ID</th>
                                            <th>Genset ID</th>
                                            <th>Merk</th>
                                            <th>Capacity Genset (KVA)</th>
                                            <th>Type</th>
                                            <th>Model</th>
                                            <th>Serial Number</th>
                                            <th>Coverage Ruang</th>
                                            <th>Tahun Operasi</th>
                                            <th>Status Maintenance</th>
                                            <th>Responsible</th>
                                            <th>PO Kontak</th>
                                            <th>Action</th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                     ?>
                                    <?php foreach ($dataGenset as $genset): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $genset['side_id']; ?></td>
                                            <td><?php echo $genset['genset_id']; ?></td>
                                            <td><?php echo $genset['merk']; ?></td>
                                            <td><?php echo $genset['capacity']; ?></td>
                                            <td><?php echo $genset['type']; ?></td>
                                            <td><?php echo $genset['model']; ?></td>
                                            <td><?php echo $genset['sn']; ?></td>
                                            <td><?php echo $genset['coverage']; ?></td>
                                            <td><?php echo $genset['tahun']; ?></td>
                                            <td><?php echo $genset['maintenance']; ?></td>
                                            <td><?php echo $genset['responsible']; ?></td>
                                            <td><?php echo $genset['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updategenset/' . $genset['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deletegenset/' . $genset['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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