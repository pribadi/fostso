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
    <h4 align="center">DAILY COOLING TOWER WORK CHECKLIST</h4>
    <table class="deskripsi">
        <tbody>
            <tr>
                <td>Customer</td>
                <td>: PT. TELKOMSEL</td>
            </tr>
            <tr>
                <td>Equipment</td>
                <td>: Cooling Tower</td>
            </tr>
            <tr>
                <td>Floor</td>
                <td>: B2 & Rooftop</td>
            </tr>       
        </tbody>

    </table>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Motor Cooling Tower</th>
                <th>Pump Cooling Tower</th>
                <th>Meter Cooling Tower</th>
                <th>Water Supply Pump</th>
                <th>Remark</th>
                <th>Name</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th></th>
                <th></th>
                <th>m3</th>
                <th></th>
                <th>Catatan</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo date("d-M-y", strtotime($v['datetime_coolingtower'])); ?></td>
                    <td><?php echo date("H:i", strtotime($v['datetime_coolingtower'])); ?></td>
                    <td><?php echo $v['motor_cooling']; ?></td>
                    <td><?php echo $v['pump_cooling']; ?></td>
                    <td><?php echo $v['meter_cooling']; ?></td>
                    <td><?php echo $v['water_supply']; ?></td>
                    <td><?php echo $v['remark']; ?></td>
                    <td><?php echo $v['fs_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>