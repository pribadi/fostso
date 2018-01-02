<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Apar</li>
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
                        <h3 class="box-title">Apar</h3>
                    <a href="<?php echo site_url('inventory/createapar'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <?php if($dataapar): ?>
                                    <tr>
                                        <th>No.</th>
                                        <th>Side ID</th>
                                        <th>Floor</th>
                                        <th>Room</th>
                                        <th>Apar ID</th>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Class</th>
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
                                    <?php foreach ($dataapar as $apar): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $apar['side_id']; ?></td>
                                            <td><?php echo $apar['floor']; ?></td>
                                            <td><?php echo $apar['room']; ?></td>
                                            <td><?php echo $apar['apar_id']; ?></td>
                                            <td><?php echo $apar['merk']; ?></td>
                                            <td><?php echo $apar['model']; ?></td>
                                            <td><?php echo $apar['class']; ?></td>
                                            <td><?php echo $apar['tahun']; ?></td>
                                            <td><?php echo $apar['maintenance']; ?></td>
                                            <td><?php echo $apar['responsible']; ?></td>
                                            <td><?php echo $apar['po_kontak']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updateapar/' . $apar['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deleteapar/' . $apar['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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