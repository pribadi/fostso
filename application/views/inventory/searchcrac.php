<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">CRAC</li>
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
                        <h3 class="box-title">CRAC</h3>
                    <a href="<?php echo site_url('inventory/createcrac'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <?php if($datacrac): ?>
                                    <tr>
                                        <th>No.</th>
                                        <th>Side ID</th>
                                        <th>Crac ID</th>
                                        <th>Merk</th>
                                        <th>Type</th>
                                        <th>Model</th>
                                        <th>Model Fan</th>
                                        <th>Phase</th>
                                        <th>Delivery AC Vendor</th>
                                        <th>Total Cooling</th>
                                        <th>Capacity</th>
                                        <th>Sensible Cooling</th>
                                        <th>Capacity</th>
                                        <th>Room Coverage</th>
                                        <th>Serial Number</th>
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
                                    <?php foreach ($datacrac as $crac): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $crac['side_id']; ?></td>
                                            <td><?php echo $crac['crac_id']; ?></td>
                                            <td><?php echo $crac['merk']; ?></td>
                                            <td><?php echo $crac['type']; ?></td>
                                            <td><?php echo $crac['model']; ?></td>
                                            <td><?php echo $crac['model_fan']; ?></td>
                                            <td><?php echo $crac['phase']; ?></td>
                                            <td><?php echo $crac['vendor']; ?></td>
                                            <td><?php echo $crac['total_cooling']; ?></td>
                                            <td><?php echo $crac['capacity']; ?></td>
                                            <td><?php echo $crac['sensible_cooling']; ?></td>
                                            <td><?php echo $crac['sensible_capacity']; ?></td>
                                            <td><?php echo $crac['coverage']; ?></td>
                                            <td><?php echo $crac['sn']; ?></td>
                                            <td><?php echo $crac['tahun']; ?></td>
                                            <td><?php echo $crac['maintenance']; ?></td>
                                            <td><?php echo $crac['responsible']; ?></td>
                                            <td><?php echo $crac['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updatecrac/' . $crac['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deletecrac/' . $crac['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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