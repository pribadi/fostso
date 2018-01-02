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
    <?php //$dateName = Date('F'); ?>
    <h3 align="center">Log Activity Facility Operation Support Telkomsel Smart Office</h3>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>TIME</th>
                <th>Activity</th>
                <th>Floor</th>
                <th>PIC</th>
                <th>Status</th>
                <th>Documentation</th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach ($data as $key => $date): ?>
                <tr style=" background: #CCCCCC;">
                    <td colspan="7" style="text-align: left;"><?= date("d-M-Y", strtotime($key)); ?></td>
                </tr>
                <?php foreach($date as $key => $shift): ?>
                    <tr style=" background: rgb(255, 250, 167);">
                        <td colspan="7" style="text-align: center;">Shift <?= $key ?></td>
                    </tr>
                    <?php foreach($shift as $v): ?>
                        <?php 
                            
                         ?>
                        <tr>
                            <td><?= date("H:i", strtotime($v['datetime_log'])); ?></td>
                            <td><?php echo $v['activity']; ?></td>
                            <td><?php echo $v['floor']; ?></td>
                            <td><?php echo $v['pic']; ?></td>
                            <td><?php echo $v['status']; ?></td>
                            <td>
                                <?php if($v['doc']): ?>
                                <img  style="width:50px;height:30px;" src="<?=base_url()?>assets/uploads/log/<?=$v['doc'];?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>