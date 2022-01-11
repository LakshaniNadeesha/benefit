<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>navigation.css">

    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

<div class="header">

    <ul>
        <?php if (Auth::access('Supervisor')): ?>
            <li><a href="<?= PATH ?>Approvereimbursement"><i class="fas fa-coins"></i><span>Handle Reimbursements</span></a></li>
            <li><a href="<?= PATH ?>LeaveapproveController"><i class="fas fa-calendar-week"></i><span>Handle Time Off</span></a></li>
            <li><a href="<?= PATH ?>Supervisor/Performance"><i class="fas fa-edit"></i><span>Handle Performance</span></a></li>
            <li><a href="<?= PATH ?>Markattendance"><i class="fas fa-user-check"></i><span>Attendance</span></a></li>
        <?php endif; ?>
    </ul>

</div>
</body>

</html>