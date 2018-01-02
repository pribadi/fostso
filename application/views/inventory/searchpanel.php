<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Panel</li>
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
                        <h3 class="box-title">Panel</h3>
                    <a href="<?php echo site_url('inventory/createpanel'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <?php if($dataPanel): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Side ID</th>
                                            <th>Floor</th>
                                            <th>Panel ID</th>
                                            <th>Merk</th>
                                            <th>Capacity Breaker (A)</th>
                                            <th>Type</th>
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
                                    <?php foreach ($dataPanel as $panel): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $panel['side_id']; ?></td>
                                            <td><?php echo $panel['floor']; ?></td>
                                            <td><?php echo $panel['panel_id']; ?></td>
                                            <td><?php echo $panel['merk']; ?></td>
                                            <td><?php echo $panel['capacity']; ?></td>
                                            <td><?php echo $panel['type']; ?></td>
                                            <td><?php echo $panel['sn']; ?></td>
                                            <td><?php echo $panel['coverage']; ?></td>
                                            <td><?php echo $panel['tahun']; ?></td>
                                            <td><?php echo $panel['maintenance']; ?></td>
                                            <td><?php echo $panel['responsible']; ?></td>
                                            <td><?php echo $panel['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updatepanel/' . $panel['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deletepanel/' . $panel['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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