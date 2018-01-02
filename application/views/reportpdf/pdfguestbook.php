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
    <?php $Bulan = date("F", strtotime($data[0]['date_guestbook']));?>
    <h3 align="center">Guest Book Facility Operation Support Telkomsel Smart Office - <?php echo $Bulan; ?></h3>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Activity</th>
                <th>SIK</th>
                <th>PIC TSEL</th>
                <th>Laptop</th>
                <th>In</th>
                <th>Out</th>
                <th>Floor</th>
                <th>Visitor</th>
                <th>Acces</th>
                <th>NDA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo date("d/m/y", strtotime($v['date_guestbook'])); ?></td>
                    <td><?php echo $v['guest_name']; ?></td>
                    <td><?php echo $v['phone']; ?></td>
                    <td><?php echo $v['company']; ?></td>
                    <td><?php echo $v['activity']; ?></td>
                    <td><?php echo $v['sik']; ?></td>
                    <td><?php echo $v['pic_tsel']; ?></td>
                    <td><?php echo $v['laptop']; ?></td>
                    <td><?php echo date("H:i", strtotime($v['guest_in'])); ?></td>
                    <td><?php echo date("H:i", strtotime($v['guest_out'])); ?></td>
                    <td><?php echo $v['floor']; ?></td>
                    <td><?php echo $v['visitor']; ?></td>
                    <td><?php echo $v['acces']; ?></td>
                    <td><?php echo $v['nda']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>