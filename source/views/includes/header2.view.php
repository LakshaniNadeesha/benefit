<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>header2.css">
    <title></title>
</head>
<body>

<div class="header2">
    <nav class="stroke">
        <ul>
            <li><a href="<?= PATH ?>LeavedetailsController">Time Off</a></li>
            <li><a href="<?= PATH ?>Benefit">Benefit</a></li>
            <li><a href="<?= PATH ?>Reimbursement">Reimbursement</a></li>
            <li><a href="<?= PATH ?>Performance">Performance</a></li>
        </ul>
    </nav>

    <nav class="stroke2">
        <ul>
            <li title="Time off"><a href="<?= PATH ?>LeavedetailsController"><i class="fas fa-user-clock"></i></a></li>
            <li title="Benefit"><a href="<?= PATH ?>Benefit"><i class="fas fa-clinic-medical"></i></a></li>
            <li title="Reimbursement"><a href="<?= PATH ?>Reimbursement"><i class="fas fa-file-invoice-dollar"></i></a></li>
            <li title="Performance"><a href="<?= PATH ?>Performance"><i class="fas fa-chart-line"></i></a></li>
        </ul>
    </nav>

</div>

</body>
</html>




