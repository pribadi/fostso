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
    <h3 align="center">DAILY WIRING ROOM WORK CHECKLIST</h3>
    <table class="deskripsi">
        <tbody>
            <tr>
                <td>Customer</td>
                <td>: PT. TELKOMSEL</td>
            </tr>
            <tr>
                <td>Equipment</td>
                <td>: Wiring Room</td>
            </tr>
            <tr>
                <td>Floor</td>
                <td>: 2 - 23</td>
            </tr>       
        </tbody>
    </table>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Floor</th>
                <th colspan="2">Cooling</th>
                <th>Temperature</th>
                <th colspan="3">Speedtest</th>
                <th>Hardware Condition</th>
                <th>Remark</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Lantai</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Suhu</th>
                <th>Ping</th>
                <th>Downlink</th>
                <th>Uplink</th>
                <th>Keadaan Hardware</th>
                <th>Catatan</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><i>(Celcius)</i></th>
                <th><i>(Ms)</i></th>
                <th colspan="2"><i>(Mbps)</i></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $date): ?>
                <?php foreach($date as $key => $shift): ?>
                    <tr style=" background: rgb(255, 250, 167);">
                        <td colspan="11" style="text-align: center;">Shift <?= $key ?></td>
                    </tr>
                    <?php foreach($shift as $v): ?>
                        <tr>
                            <td><?= date("d-M-y", strtotime($v['datetime_wiring'])); ?></td>
                            <td><?= date("H:i", strtotime($v['datetime_wiring'])); ?></td>
                            <td><?php echo $v['floor']; ?></td>
                            <td><?php echo $v['cooling']; ?></td>
                            <td><?php echo $v['status']; ?></td>
                            <td><?php echo $v['temperature']; ?></td>
                            <td><?php echo $v['ping']; ?></td>
                            <td><?php echo $v['downlink']; ?></td>
                            <td><?php echo $v['uplink']; ?></td>
                            <td><?php echo $v['hardware_condition']; ?></td>
                            <td><?php echo $v['remark']; ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>