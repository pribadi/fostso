<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
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
                    </div>
                    <div class="panel-heading">
                        <?php echo form_open('coolingtower/search'); ?>
                            <div class="form-group">
                                <select class="form-control" name="month">
                                    <option>...</option>
                                    <option value="1" <?php echo ($month == 1) ? "selected" : '' ?>>Januari</option>
                                    <option value="2" <?php echo ($month == 2) ? "selected" : '' ?>>Februari</option>
                                    <option value="3" <?php echo ($month == 3) ? "selected" : '' ?>>Maret</option>
                                    <option value="4" <?php echo ($month == 4) ? "selected" : '' ?>>April</option>
                                    <option value="5" <?php echo ($month == 5) ? "selected" : '' ?>>Mei</option>
                                    <option value="6" <?php echo ($month == 6) ? "selected" : '' ?>>Juni</option>
                                    <option value="7" <?php echo ($month == 7) ? "selected" : '' ?>>Juli</option>
                                    <option value="8" <?php echo ($month == 8) ? "selected" : '' ?>>Agustus</option>
                                    <option value="9" <?php echo ($month == 9) ? "selected" : '' ?>>September</option>
                                    <option value="10" <?php echo ($month == 10) ? "selected" : '' ?>>Oktober</option>
                                    <option value="11" <?php echo ($month == 11) ? "selected" : '' ?>>November</option>
                                    <option value="12" <?php echo ($month == 12) ? "selected" : '' ?>>Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="year">
                                    <option>...</option>
                                    <?php for($i = 2016; $i <= date('Y'); $i++): ?>
                                        <option value="<?php echo $i ?>" <?php echo ($year == $i) ? "selected" : '' ?>><?php echo $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        <?php echo form_close(); ?>
                        <a href="<?php echo site_url('coolingtower/create'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                        <br/>
                        <br/>
                    </div>
                    <?php if($data): ?>
                        <div class="box-body">
                        <h4 align="center">Daily Cooling Tower Work Checklist</h4>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Shift</th>
                                        <th>Time</th>
                                        <th>Motor Cooling Tower</th>
                                        <th>Pump Cooling Tower</th>
                                        <th>Meter Cooling Tower</th>
                                        <th>Water Supply Pump</th>
                                        <th>Remark</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th></th>
                                        <th>Jam</th>
                                        <th></th>
                                        <th></th>
                                        <th>m3</th>
                                        <th></th>
                                        <th>Catatan</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $v): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo date("d-M-y", strtotime($v['datetime_coolingtower'])); ?></td>
                                            <td><?php echo $v['shift']; ?></td>
                                            <td><?php echo date("H:i", strtotime($v['datetime_coolingtower'])); ?></td>
                                            <td><?php echo $v['motor_cooling']; ?></td>
                                            <td><?php echo $v['pump_cooling']; ?></td>
                                            <td><?php echo $v['meter_cooling']; ?></td>
                                            <td><?php echo $v['water_supply']; ?></td>
                                            <td><?php echo $v['remark']; ?></td>
                                            <td><?php echo $v['fs_name']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('coolingtower/update/' . $v['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('coolingtower/delete/' . $v['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>