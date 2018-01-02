<div class="row">
    <div class="col-lg-12">
        <?php if($this->session->flashdata('info')): ?>
        
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('info'); ?>
            </div>

        <?php endif; ?>
        <h1 class="page-header">Log Activity</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo form_open('log/search'); ?>
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
                <br/>
                <a href="<?php echo site_url('log/create'); ?>" class="btn btn-primary">Add Activity</a>
                <?php if($data): ?>
                    <a href="<?php echo site_url('reportpdf/pdflog/'.$month.'/'.$year); ?>" target="blank" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> PDF</a>
                    <a href="<?php echo site_url('reportexcel/excellog/'.$month.'/'.$year); ?>" target="blank" class="btn btn-info" disabled="disabled"><i class="fa fa-file-excel-o"></i> Excel</a>
                <?php endif; ?>
            </div>
            <!-- /.panel-heading -->
            <?php if($data): ?>
            <div class="panel-body">
                <div class="wrapper">
                    <h4 align="center">Log Activity Facility Operation Support Telkomsel Smart Office</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTabel" id="" cellspacing="0" width="100%">
                            <thead class="tabelHead">
                                <tr>
                                    <th>Time</th>
                                    <th>Activity</th>
                                    <th>Floor</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th>Documentation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($data as $key => $date): ?>
                                        <tr style=" background: #CCCCCC;">
                                            <td colspan="7"><?php echo date("d-M-Y", strtotime($key)); ?></td>
                                        </tr>
                                        <?php foreach($date as $key => $shift): ?>
                                            <tr style=" background: rgb(255, 250, 167);">
                                                <td colspan="7" style="text-align: center;">Shift <?php echo $key ?></td>
                                            </tr>
                                            <?php foreach($shift as $v): ?>
                                                <tr style="text-align: center;"">
                                                    <td><?php echo date("H:i", strtotime($v['datetime_log'])); ?></td>
                                                    <td><?php echo $v['activity']; ?></td>
                                                    <td><?php echo $v['floor']; ?></td>
                                                    <td><?php echo $v['pic']; ?></td>
                                                    <td><?php echo $v['status']; ?></td>
                                                    <td>
                                                        <?php if($v['doc']): ?>
                                                            <img style="width:50px;height:30px;" src="<?php echo base_url()?>assets/uploads/log/<?php echo $v['doc'];?>">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('log/update/' . $v['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                        <a href="<?php echo site_url('log/delete/' . $v['id']); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>