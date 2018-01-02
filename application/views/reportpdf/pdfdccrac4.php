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
    <h3 align="center">DAILY COOLING CRAC WORK CHECKLIST</h3>
    <table class="deskripsi">
        <tbody>
            <tr>
                <td>Customer</td>
                <td>: PT. TELKOMSEL</td>
            </tr>
            <tr>
                <td>Equipment</td>
                <td>: CRAC 4</td>
            </tr>
            <tr>
                <td>Location</td>
                <td>: Data Center</td>
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
                <th>Date</th>
                <th>Time</th>
                <th colspan="2">Reading - Pembacaan</th>
                <th>Alarm Condition</th>
                <th>Remark</th>
                <th>Name</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Actual</th>
                <th>Relative</th>
                <th>Kondisi Alarm</th>
                <th>Catatan</th>
                <th>Nama</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Temperature (C)</th>
                <th>Humidity</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo date("d-M-y", strtotime($v['datetime_dccrac4'])); ?></td>
                    <td><?php echo date("H:i", strtotime($v['datetime_dccrac4'])); ?></td>
                    <td><?php echo $v['temperature']; ?></td>
                    <td><?php echo $v['humidity']; ?></td>
                    <td><?php echo $v['alarm_condition']; ?></td>
                    <td><?php echo $v['remark']; ?></td>
                    <td><?php echo $v['fs_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>