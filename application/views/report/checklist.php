<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Report</a></li>
                <li class="active">Checklist</li>
            </ol>
            <?php if(validation_errors()): ?>

                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php //echo $this->session->flashdata('info'); ?>
                    <?php echo validation_errors(); ?>
                </div>

            <?php endif; ?>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Report Checklist</h3>
                    </div>
                    <div class="panel-heading">
                        <?php echo form_open('report/checklist'); ?>
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control datepicker" name="tanggal" type="text" value="<?php echo set_value('tanggal'); ?>">
                            </div>
                            <!-- <div class="form-group">
                                <label>Time</label>
                                <input class="form-control timepicker" name="jam" type="text" value="<?php //echo set_value('jam'); ?>">
                            </div> -->
                            <div class="form-group">
                                <label>Time</label>
                                <select class="form-control" name="jam">
                                    <option value="">...</option>
                                    <option value="09:00" <?php echo set_select('jam', '09:00'); ?>>09:00</option>
                                    <option value="21:00" <?php echo set_select('jam', '21:00'); ?>>21:00</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        <?php echo form_close(); ?>
                        <br/>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="form-group">
<!-- Hari dan bulan dalam bahasa indonesia -->
<?php
    $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $bulan = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
 ?>


<textarea class="form-control" name="remark" rows="20">
<?php if($dataGenset): ?>*UPDATE REPORT TSO*
Hari       = <?php echo $hari[date($tanggalChecklist->format('w'))]; ?>

Tanggal = <?php echo $tanggalChecklist->format('d').' '.$bulan[date($tanggalChecklist->format('n'))].' '.$tanggalChecklist->format('Y'); ?>

Pukul    = <?php echo $tanggalChecklist->format('H:i'); ?> WIB
===================

*STATUS GENSET*
---------------------------
Kapasitas Genset = 1.000 KVA
Runing Time : <?php echo $dataGenset['runtime_hour']; ?> h <?php echo $dataGenset['runtime_minute']; ?> m | <?php echo $dataGenset['start']; ?> Starts
Battery Voltage : <?php echo $dataGenset['battery_voltage']; ?>


*STATUS SOLAR*
---------------------------
- Konsumsi pemakaian solar perjam dengan beban = 168 liter/jam
- Status Solar =
# <?php echo $dataGenset['solar_harian']; ?> Liter daily tank (max cap 1.000 liter)
# <?php echo $dataGenset['solar_cadangan']; ?> Liter tank cadangan (max cap 10.000 liter)
<?php endif; ?>

<?php if($dataLvmdp): ?>
*STATUS LOAD DATA CENTER & IOC*
---------------------------
Load = <?php echo $dataLvmdp[0]['kva'] ?> KVA
<?php endif; ?>

<?php foreach ($dataUpsa as $u): ?>
*UPS*
---------------------------
UPS | Capacity = 100 KVA

R = <?php echo $u['current_amp_r']; ?> Amp
S = <?php echo $u['current_amp_s']; ?> Amp
T = <?php echo $u['current_amp_t']; ?> Amp

LOAD <?php echo $u['load_kva']; ?> KVA | <?php echo $u['load_persen']; ?> % | AUTO = <?php echo $u['auto_minutes']; ?> Menit
<?php endforeach;  ?>

<?php foreach ($dataRectifier1 as $r1): ?>
*RECTIFIER*
---------------------------
REC 7.1 : <?php echo $r1['load_rectifier1']; ?> Amp | <?php echo $r1['accupancy']; ?> % | AUTO = <?php echo $r1['autonomi'];  ?> Menit
<?php endforeach;  ?>
<?php foreach ($dataRectifier2 as $r2): ?>
REC 7.2 : <?php echo $r2['load_rectifier2']; ?> Amp | <?php echo $r2['accupancy']; ?> % | AUTO = <?php echo $r2['autonomi'];  ?> Menit
<?php endforeach;  ?>
<?php foreach ($dataRectifier3 as $r3): ?>
REC 7.3 : <?php echo $r3['load_rectifier3']; ?> Amp | <?php echo $r3['accupancy']; ?> % | AUTO = <?php echo $r3['autonomi'];  ?> Menit
<?php endforeach;  ?>

<?php foreach ($dataLvmdp as $v): ?>
*TRAFO*
---------------------------
Load = <?php echo $load = $v['kva']/10?> %

*LVMDP*
---------------------------
P = <?php echo $v['kva']; ?> KVA | Pf = <?php echo $v['pf']; ?>


R = <?php echo $v['r']; ?> Amp
S = <?php echo $v['s']; ?> Amp
T = <?php echo $v['t']; ?> Amp
<?php endforeach;  ?>

<?php foreach ($dataMdpa as $m): ?>
*PANEL MDP A*
---------------------------
P = <?php echo $m['kva']; ?> KVA | Pf = <?php echo $m['pf']; ?>


R = <?php echo $m['r']; ?> Amp
S = <?php echo $m['s']; ?> Amp
T = <?php echo $m['t']; ?> Amp
<?php endforeach;  ?>

<?php foreach ($dataDistributiona as $d): ?>
*PANEL DISTRIBUSI A*
---------------------------
P = <?php echo $d['kva']; ?> KVA |Pf = <?php echo $d['pf']; ?>


R = <?php echo $d['r']; ?> Amp
S = <?php echo $d['s']; ?> Amp
T = <?php echo $d['t']; ?> Amp

===================
<?php endforeach;  ?>
<?php if($dataIssue): ?>
Note :
<?php endif; ?>
<?php foreach ($dataIssue as $issue): ?>
- <?php echo $issue['issue'];?>.
<?php endforeach;  ?>
</textarea>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>