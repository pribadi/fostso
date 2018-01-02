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
        a table.deskripsi {
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
                <td>: UPS B</td>
            </tr>
            <tr>
                <td>Location</td>
                <td>: Power B</td>
            </tr>
            <tr>
                <td>Floor</td>
                <td>: 7</td>
            </tr>       
        </tbody>

    </table>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>DATE</th>
                <th>TIME</th>
                <th colspan="3"></th>
                <th colspan="10"></th>
                <th>Batt.</th>
                <th>REMARK</th>
                <th>NAME</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th colspan="3">VOLTAGE (Volt)</th>
                <th>FREQ</th>
                <th colspan="3">CURRENT (Amp)</th>
                <th colspan="3">CURRENT (%)</th>
                <th colspan="2">LOAD</th>
                <th>AUTO</th>
                <th>Volt.</th>
                <th>Catatan</th>
                <th>Nama</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>R-S</th>
                <th>S-T</th>
                <th>T-R</th>
                <th>(Hz)</th>
                <th>R</th>
                <th>S</th>
                <th>T</th>
                <th>R</th>
                <th>S</th>
                <th>T</th>
                <th>KVA</th>
                <th>%</th>
                <th>(Min)</th>
                <th>(Ub)</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo date("d-M-y", strtotime($v['datetime_upsb'])); ?></td>
                    <td><?php echo date("H:i A", strtotime($v['datetime_upsb'])); ?></td>
                    <td><?php echo $v['rs']; ?></td>
                    <td><?php echo $v['st']; ?></td>
                    <td><?php echo $v['tr']; ?></td>
                    <td><?php echo $v['freq']; ?></td>
                    <td><?php echo $v['current_amp_r']; ?></td>
                    <td><?php echo $v['current_amp_s']; ?></td>
                    <td><?php echo $v['current_amp_t']; ?></td>
                    <td><?php echo $v['current_persen_r']; ?></td>
                    <td><?php echo $v['current_persen_s']; ?></td>
                    <td><?php echo $v['current_persen_t']; ?></td>
                    <td><?php echo $v['load_kva']; ?></td>
                    <td><?php echo $v['load_persen']; ?></td>
                    <td><?php echo $v['auto_minutes']; ?></td>
                    <td><?php echo $v['battery']; ?></td>
                    <td><?php echo $v['remark']; ?></td>
                    <td><?php echo $v['fs_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>