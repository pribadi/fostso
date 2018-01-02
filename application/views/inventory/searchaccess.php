<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Access Control</li>
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
                        <h3 class="box-title">Access Control</h3>
                    <a href="<?php echo site_url('inventory/createaccess'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <?php if($dataaccess): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Side ID</th>
                                            <th>Access ID</th>
                                            <th>Room Coverage</th>
                                            <th>Merk</th>
                                            <th>Model</th>
                                            <th>Serial Number</th>
                                            <th>IP Address</th>
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
                                    <?php foreach ($dataaccess as $access): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $access['side_id']; ?></td>
                                            <td><?php echo $access['access_id']; ?></td>
                                            <td><?php echo $access['room_coverage']; ?></td>
                                            <td><?php echo $access['merk']; ?></td>
                                            <td><?php echo $access['model']; ?></td>
                                            <td><?php echo $access['sn']; ?></td>
                                            <td><?php echo $access['ip_address']; ?></td>
                                            <td><?php echo $access['tahun']; ?></td>
                                            <td><?php echo $access['maintenance']; ?></td>
                                            <td><?php echo $access['responsible']; ?></td>
                                            <td><?php echo $access['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updateaccess/' . $access['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deleteaccess/' . $access['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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