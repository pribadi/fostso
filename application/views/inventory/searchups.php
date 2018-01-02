<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">UPS</li>
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
                        <h3 class="box-title">UPS</h3>
                    <a href="<?php echo site_url('inventory/createups'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <?php if($dataUps): ?>
                                        <tr>
                                            <th>No.</th>
                                            <th>Side ID</th>
                                            <th>Floor</th>
                                            <th>Location</th>
                                            <th>UPS ID</th>
                                            <th>Merk</th>
                                            <th>Type</th>
                                            <th>Serial Number</th>
                                            <th>R</th>
                                            <th>S</th>
                                            <th>T</th>
                                            <th>Load Average</th>
                                            <th>Capacity</th>
                                            <th># Modul</th>
                                            <th>Kap Modul</th>
                                            <th colspan="2">Load</th>
                                            <th>Autonomi</th>
                                            <th colspan="4">Battery</th>
                                            <th>Tahun Instalasi</th>
                                            <th>Status Maintenance</th>
                                            <th>PO Kontak</th>
                                            <th>Responsible</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>(KVA)</th>
                                            <th></th>
                                            <th>(KVA)</th>
                                            <th>(KVA)</th>
                                            <th>(%)</th>
                                            <th></th>
                                            <th>Kap (Ah)</th>
                                            <th>Merk/Type</th>
                                            <th>Cell/Blok</th>
                                            <th>QTY (Bank)</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                     ?>
                                    <?php foreach ($dataUps as $ups): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $ups['side_id']; ?></td>
                                            <td><?php echo $ups['floor']; ?></td>
                                            <td><?php echo $ups['location']; ?></td>
                                            <td><?php echo $ups['ups_id']; ?></td>
                                            <td><?php echo $ups['merk']; ?></td>
                                            <td><?php echo $ups['type']; ?></td>
                                            <td><?php echo $ups['sn']; ?></td>
                                            <td><?php echo $ups['r']; ?></td>
                                            <td><?php echo $ups['s']; ?></td>
                                            <td><?php echo $ups['t']; ?></td>
                                            <td><?php echo ($ups['r']+$ups['s']+$ups['t'])/3; ?></td>
                                            <td><?php echo $ups['capacity']; ?></td>
                                            <td><?php echo $ups['modul']; ?></td>
                                            <td><?php echo $ups['kap_modul']; ?></td>
                                            <td><?php echo $ups['load_kva']; ?></td>
                                            <td><?php echo $ups['load_persen']; ?></td>
                                            <td><?php echo $ups['autonomi']; ?></td>
                                            <td><?php echo $ups['battery_kap']; ?></td>
                                            <td><?php echo $ups['battery_merk']; ?></td>
                                            <td><?php echo $ups['battery_cell']; ?></td>
                                            <td><?php echo $ups['battery_qty']; ?></td>
                                            <td><?php echo $ups['tahun']; ?></td>
                                            <td><?php echo $ups['maintenance']; ?></td>
                                            <td><?php echo $ups['po_kontak']; ?></td>
                                            <td><?php echo $ups['responsible']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/updateups/' . $ups['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('inventory/deleteups/' . $ups['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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