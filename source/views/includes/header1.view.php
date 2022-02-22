<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>header1.css">

    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<div class="topnav" id="myTopnav">
    <img class="logo" src="public/img/logo.png" alt="OFS" >
    <div class="list">

        <a href="<?= PATH ?>Home" class="active">Home</a>
        <a href="<?= PATH ?>leavedetailscontroller">My Info</a>
        <a href="<?= PATH ?>hrdocuments">Documents</a>
        <a href="<?= PATH ?>Hierarchy">Hierarchy</a>
        <?php if (Auth::access('Supervisor')): ?>
            <a href="<?= PATH ?>Approvereimbursement">USER MANAGEMENT</a>
        <?php endif; ?>
        <?php if (Auth::access('HR Manager')): ?>
            <a href="<?= PATH ?>EmployeelistController">USER MANAGEMENT</a>
        <?php endif; ?>
        <?php if (Auth::access('HR Officer')): ?>
            <a href="<?= PATH ?>AddemployeeController">USER MANAGEMENT</a>
        <?php endif; ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
        <a href="<?= PATH ?>Logout" id="#show_hide" style="display: none">Log Out </a>
        <a href="" id="#show_hide" style="display: none">Notifications </a>
    </div>

    <div class="toggle_section">
        <div class="notification">
            <a><span class="material-icons">notifications</span></a>
        </div>
        <div class="logged_name">
            <span class=log_name><?= Auth::getfirst_name() ?></span>
        </div>
        <script type="text/javascript">
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>

        <div class="dd_main">
            <button type="button" class="icon-button">
                <a><i class="fas fa-user"></i></a>

                <div class="dd_menu">
                    <div class="dd_left">
                        <ul>
                            <li><a href="<?= PATH ?>leavedetailscontroller"> <i class="fa fa-user"
                                                                                aria-hidden="true"></i></a></li>
                            <li><a href="<?= PATH ?>Logout"> <i class="fas fa-sign-out-alt"> </i></a></li>
                        </ul>
                    </div>
                    <div class="dd_right">
                        <ul>
                            <li><a href="<?= PATH ?>leavedetailscontroller">My Info </a></li>
                            <li><a href="<?= PATH ?>Logout">Log Out </a></li>
                        </ul>
                    </div>
                </div>
            </button>
        </div>
    </div>
</div>
<script>

    // window.onscroll = function () {
    //     myFunction();
    // }
    //
    // var header = document.getElementById("myHeader");
    // var sticky = header.offsetTop;
    //
    // function myFunction() {
    //     if (window.pageYOffset > sticky) {
    //         header.classList.add("sticky");
    //     } else {
    //         header.classList.remove("sticky");
    //     }
    // }

    var dd_main = document.querySelector(".dd_main");

    dd_main.addEventListener("click", function () {
        this.classList.toggle("active");
    })
</script>
</body>
</html>
