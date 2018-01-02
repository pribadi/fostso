<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Cooling Tower</li>
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
                        <h3 class="box-title">Cooling Tower</h3>
                    <a href="<?php echo site_url('inventory/createcoolingtower'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <?php if($datacoolingtower): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Side ID</th>
                                            <th>Engine ID</th>
                                            <th>Merk</th>
                                            <th>Type</th>
                                            <th>Model</th>
                                            <th>Engine Capacity (KW)</th>
                                            <th>Serial Number</th>
                                            <th>Room Coverage</th>
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
                                    <?php foreach ($datacoolingtower as $coolingtower): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $coolingtower['side_id']; ?></td>
                                            <td><?php echo $coolingtower['engine_id']; ?></td>
                                            <td><?php echo $coolingtower['merk']; ?></td>
                                            <td><?php echo $coolingtower['type']; ?></td>
                                            <td><?php echo $coolingtower['model']; ?></td>
                                            <td><?php echo $coolingtower['capacity']; ?></td>
                                            <td><?php echo $coolingtower['sn']; ?></td>
                                            <td><?php echo $coolingtower['coverage']; ?></td>
                                            <td><?php echo $coolingtower['tahun']; ?></td>
                                            <td><?php echo $coolingtower['maintenance']; ?></td>
                                            <td><?php echo $coolingtower['responsible']; ?></td>
                                            <td><?php echo $coolingtower['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updatecoolingtower/' . $coolingtower['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deletecoolingtower/' . $coolingtower['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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