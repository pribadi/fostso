<!DOCTYPE html>
<html>
<head>
    <title>TSO - Facility Operation Support</title>
    <style type="text/css">
        
        body{
            width: 100%;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 12px;
        }
        
        table{
            border-collapse: collapse;
            display: table;
            text-align: center;
        }
        table thead tr th {
            background: #ecf3eb;
        }

        table.deskripsi {
            text-align: left;
            margin: 0 auto;
            width:30%;
            border-collapse:collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h3 align="center">DAILY ELECTRICAL WORK CHECKLIST</h3>
    <table class="deskripsi">
        <tbody>
            <tr>
                <td>Customer</td>
                <td>: PT. TELKOMSEL</td>
            </tr>
            <tr>
                <td>Equipment</td>
                <td>: LVMDP</td>
            </tr>
            <tr>
                <td>Location</td>
                <td>: Power House</td>
            </tr>
            <tr>
                <td>Floor</td>
                <td>: B1</td>
            </tr>       
        </tbody>

    </table>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th colspan="6">Voltage (Volt)</th>
                <th colspan="3">Current</th>
                <th>Freq</th>
                <th rowspan="2">KVA</th>
                <th rowspan="2">PF</th>
                <th>Remark</th>
                <th>Name</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th colspan="3">Phase To Phase</th>
                <th colspan="3">Phase To Neutral</th>
                <th colspan="3">(Amp)</th>
                <th>(Hz)</th>
                <th>Catatan</th>
                <th>Nama</th>
            </tr>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo date("d-M-y", strtotime($v['datetime_lvmdp'])); ?></td>
                    <td><?php echo date("H:i", strtotime($v['datetime_lvmdp'])); ?></td>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>