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
        <?php if (Auth::access('HR Manager')): ?>

            <li><a href="<?= PATH ?>Approvebenefit"><i class="fab fa-gratipay"></i><span>Handle Benefits</span></a>
            </li>
            <li><a href="<?= PATH ?>LeaveapproveController"><i
                            class="fas fa-calendar-week"></i><span>Handle Time Off</span></a>
            </li>
            <li><a href="<?= PATH ?>Reporting"><i class="fas fa-chart-line"></i><span>Reports</span></a></li>
            <li><a href="<?= PATH ?>AddemployeeController"><i
                            class="far fa-address-book"></i><span>Registration</span></a></li>
            <li><a href="<?= PATH ?>EmployeelistController"><i
                            class="fas fa-user-edit"></i><span>Employee Management</span></a>
            <li><a href="<?= PATH ?>Hrdocuments/updatedocuments"><i
                            class="fas fa-edit"></i><span>Document Settings</span></a></li>
            <li><a href="<?= PATH ?>Benefit/update"><i class="fas fa-address-card"></i><span>Benefit Settings</span></a>
            </li>
        <?php endif; ?>
    </ul>
</div>
<div class="stroke2">
    <ul>
        <?php if (Auth::access('HR Manager')): ?>
            <li title="Handle Benefits"><a href="<?= PATH ?>Approvebenefit" ><i class="fab fa-gratipay"></i></a></li>
            <li title="Handle Time Off"><a href="<?= PATH ?>LeaveapproveController" ><i class="fas fa-calendar-week"></i></a></li>
            <li title="Reports"><a href="<?= PATH ?>Reporting"><i class="fas fa-chart-line"></i></a></li>
            <li title="Registration"><a href="<?= PATH ?>AddemployeeController"><i class="far fa-address-book"></i></a></li>
            <li title="Employee Management"><a href="<?= PATH ?>EmployeelistController"><i class="fas fa-user-edit"></i></a>
            <li title="Document Settings"><a href="<?= PATH ?>Hrdocuments/updatedocuments"><i class="fas fa-edit"></i></a></li>
            <li title="Benefit Settings"><a href="<?= PATH ?>Benefit/update"><i class="fas fa-address-card"></i></a></li>
        <?php endif; ?>
    </ul>
</div>

</body>

</html>