<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>profile1.css">
    <title></title>
</head>
<body>
<div id="myProfile">
    <center><img src="<?= Auth::getprofile_image() ?>" alt="Profile Image" class="profile__image"></center>
    <div class="details">
        <div class="main_details">
            <div class="name"><?= Auth::getfirst_name() ?> <?= Auth::getlast_name() ?></div>
            <div class="job"><?= Auth::getuser_role() ?></div>
        </div>
        <div class="co_details">
            <div class="contact">
                <span class="material-icons" style="padding-right: 6px">call</span><?= Auth::getcontact_number() ?>
            </div>
            <div class="email">
                <i class="material-icons" style="padding-right: 6px">email</i><?= Auth::getemail() ?>
            </div>
            <div class="hire">Hired Date</div>
            <div class="date"><?= date('Y-d-m', strtotime(Auth::gethired())); ?></div>
            <div class="address"><?= Auth::getstreet() ?>, <?= Auth::getcity() ?> <br> <?= Auth::getprovince() ?>
                province
            </div>
            <div class="supervisor">
                <i class="material-icons" style="padding-right: 6px">supervisor_account</i><span><?= Auth::sup(); ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
