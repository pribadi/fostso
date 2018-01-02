<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Electrical</li>
                <li class="active">Mechanical A</li>
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
                        <h3 class="box-title">Mechanical A</h3>
                    </div>
                    <div class="panel-heading">
                        <?php echo form_open('mechanicala/search'); ?>
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
                        <a href="<?php echo site_url('mechanicala/create'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                        <br/>
                        <br/>
                    </div>

                    <?php if($data): ?>
                    <div class="box-body">
                        <h4 align="center">DAILY ELECTRICAL WORK CHECKLIST</h4>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Shift</th>
                                        <th>Time</th>
                                        <th colspan="6">Voltage (Volt)</th>
                                        <th colspan="3">Current</th>
                                        <th>Freq</th>
                                        <th rowspan="2">KVA</th>
                                        <th rowspan="2">PF</th>
                                        <th>Remark</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th></th>
                                        <th>Waktu</th>
                                        <th colspan="3">Phase To Phase</th>
                                        <th colspan="3">Phase To Neutral</th>
                                        <th colspan="3">(Amp)</th>
                                        <th>(Hz)</th>
                                        <th>Catatan</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>R-S</th>
                                        <th>S-T</th>
                                        <th>T-R</th>
                                        <th>R-N</th>
                                        <th>S-N</th>
                                        <th>T-N</th>
                                        <th>R</th>
                                        <th>S</th>
                                        <th>T</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $v): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo date("d-M-y", strtotime($v['datetime_mechanicala'])); ?></td>
                                            <td><?php echo $v['shift']; ?></td>
                                            <td><?php echo date("H:i", strtotime($v['datetime_mechanicala'])); ?></td>
                                            <td><?php echo $v['rs']; ?></td>
                                            <td><?php echo $v['st']; ?></td>
                                            <td><?php echo $v['tr']; ?></td>
                                            <td><?php echo $v['rn']; ?></td>
                                            <td><?php echo $v['sn']; ?></td>
                                            <td><?php echo $v['tn']; ?></td>
                                            <td><?php echo $v['r']; ?></td>
                                            <td><?php echo $v['s']; ?></td>
                                            <td><?php echo $v['t']; ?></td>
                                            <td><?php echo $v['freq']; ?></td>
                                            <td><?php echo $v['kva']; ?></td>
                                            <td><?php echo $v['pf']; ?></td>
                                            <td><?php echo $v['remark']; ?></td>
                                            <td><?php echo $v['fs_name']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('mechanicala/update/' . $v['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                <a href="<?php echo site_url('mechanicala/delete/' . $v['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove" aria-hidden="true" style="color: #d9534f;"></i></a>
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