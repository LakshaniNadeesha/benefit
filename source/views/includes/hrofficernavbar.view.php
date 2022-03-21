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
        <?php if (Auth::access('HR Officer')): ?>
            <li><a href="<?= PATH ?>AddemployeeController"><i class="far fa-address-book"></i><span>Registration</span></a></li>
            <li><a href="<?= PATH ?>EmployeelistController"><i class="fas fa-calendar-week"></i></i>
                    <span>Remove Employees</span></a></li>
            <li><a href="<?= PATH ?>Hrdocuments/updatedocuments"><i class="fas fa-edit"></i><span>Update Documents</span></a></li>
            <li><a href="<?= PATH ?>Benefit/update"><i class="fas fa-edit"></i><span>Update Benefits</span></a></li>
            <li><a href="<?= PATH ?>PerformanceView/hro"><i class="fas fa-edit"></i><span>Promotion and Demotion</span></a></li>

        <?php endif; ?>
    </ul>
</div>
<div class="stroke2">
    <ul>
    <?php if(Auth::access('HR Officer')): ?>
        <li title="Registration"><a href="<?= PATH ?>AddemployeeController"><i class="far fa-address-book"></i></a></li>
        <li title="Remove Employees"><a href="<?= PATH ?>EmployeelistController"><i class="fas fa-calendar-week"></i></a></li>
        <li title="Update Documents"><a href="<?= PATH ?>Hrdocuments/updatedocuments"><i class="fas fa-edit"></i></a></li>
        <li title="Update Benefits"><a href="<?= PATH ?>Benefit/update"><i class="fas fa-edit"></i></a></li>
    <?php endif; ?>
    </ul>
</div>
</body>

</html>
