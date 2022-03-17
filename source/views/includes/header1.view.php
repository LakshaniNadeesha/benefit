<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>header1.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script>
        $(document).ready(function () {
            $(".profile .icon_wrap").click(function () {
                $(this).parent().toggleClass("active");
                $(".notifications").removeClass("active");
            });

            $(".notifications .icon_wrap").click(function () {
                $(this).parent().toggleClass("active");
                $(".profile").removeClass("active");
            });

            $(".show_all .link").click(function () {
                $(".notifications").removeClass("active");
                $(".popup").show();
            });

            $(".close").click(function () {
                $(".popup").hide();
            });
        });
    </script>
</head>
<body>
<div class="topnav" id="myTopnav">
    <img class="logo" src="public/img/logo.png" alt="OFS">
    <div class="list">

        <a href="<?= PATH ?>Home">Home</a>
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
<!--        <a href="javascript:void(0);" class="icon" onclick="myFunction()">-->
<!--            <i class="fa fa-bars"></i>-->
<!--        </a>-->
        <a href="<?= PATH ?>Logout" id="#show_hide" style="display: none">Log Out </a>
        <a href="" id="#show_hide" style="display: none">Notifications </a>
    </div>

    <div class="toggle_section">
        <div class="wrapper">
            <div class="navbar">
                <div class="navbar_right">
                    <div class="notifications">
                        <div class="icon_wrap"><i class="far fa-bell" aria-hidden="true"></i></div>

                        <div class="notification_dd">
                            <ul class="notification_ul">
                                <?php $notifications = Auth::notification();
                                if (boolval($notifications)) {
                                    if (sizeof($notifications) <= 5) {
                                        for ($j = 0; $j < sizeof($notifications); $j++) {
                                            ?>
                                            <li class="">
                                                    <div class="left_content">
                                                        <a href="<?= PATH ?>Approvebenefit" class="link"><?php print_r($notifications[$j]->description); ?></a>
                                                </div>
                                                <div class="right_content">
                                                    <?php
                                                    date_default_timezone_set("Asia/Colombo");
                                                    $day1=date("y-m-d");
                                                    $day2=$notifications[$j]->date;
                                                    $date1 = date_create($day1);
                                                    $date2=date_create($day2);
                                                    $diff=date_diff($date2,$date1);
                                                    $days = $diff->format("%R%a days");
                                                    if($days >= 1){
                                                        echo $days;
                                                    } else {
                                                       $t1 = $notifications[$j]->time;
                                                       $t2 = date("H:m:s");
                                                       $time1 = date_create($t1);
                                                       $time2 = date_create($t2);
                                                       $time_diff = date_diff($time2,$time1);
                                                       if($time_diff->h < 1){
                                                           $minutes = $time_diff->days * 24 * 60;
                                                           $minutes += $time_diff->h * 60;
                                                           $minutes += $time_diff->i;
                                                           echo $minutes.' minutes ago';
                                                       }
                                                       else {
                                                           echo $time_diff->h . "h ago";
                                                       }
                                                    }
                                                    ?>
                                                </div>
                                            </li>

                                        <?php }
                                    } else {
                                        for ($j = 0; $j < 5; $j++) {
                                            ?>
                                            <li class="">
                                                <div class="left_content">
                                                    <?php print_r($notifications[$j]->description); ?>
                                                </div>
                                                <div class="right_content">
                                                    <?php

                                                    date_default_timezone_set("Asia/Colombo");
                                                    $day1 = date("y-m-d");
                                                    $day2 = $notifications[$j]->date;
                                                    $date1 = date_create($day1);
                                                    $date2 = date_create($day2);
                                                    $diff = date_diff($date2, $date1);
                                                    $days = $diff->format("%R%a days");
                                                    if ($days >= 1) {
                                                        echo $days;
                                                    } else {
                                                        $t1 = $notifications[$j]->time;
                                                        $t2 = date("H:m:s");
                                                        $time1 = date_create($t1);
                                                        $time2 = date_create($t2);
                                                        $time_diff = date_diff($time2, $time1);
                                                        if ($time_diff->h < 1) {
                                                            $minutes = $time_diff->days * 24 * 60;
                                                            $minutes += $time_diff->h * 60;
                                                            $minutes += $time_diff->i;
                                                            echo $minutes . ' minutes ago';
                                                        } else {
                                                            echo $time_diff->h . "h ago";
                                                        }
                                                    }

                                                    ?>
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                } ?>

                                <li class="show_all">
                                    <p class="link">Show All Activities</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="popup">
                <div class="shadow"></div>
                <div class="inner_popup">
                    <div class="notification_dd">
                        <ul class="notification_ul">
                            <li class="title">
                                <p>All Notifications</p>
                                <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
                            </li>
                            <?php
                            if (boolval($notifications)) {
                                foreach ($notifications as $i) {
                                    ?>
                                    <li>
                                        <div class="left_content">
                                            <?php print_r($i->description); ?>
                                        </div>
                                        <div class="right_content">
                                            <?php

                                            date_default_timezone_set("Asia/Colombo");
                                            $day1 = date("y-m-d");
                                            $day2 = $i->date;
                                            $date1 = date_create($day1);
                                            $date2 = date_create($day2);
                                            $diff = date_diff($date2, $date1);
                                            $days = $diff->format("%R%a days");
                                            if ($days >= 1) {
                                                echo $days;
                                            } else {
                                                $t1 = $i->time;
                                                $t2 = date("H:m:s");
                                                $time1 = date_create($t1);
                                                $time2 = date_create($t2);
                                                $time_diff = date_diff($time2, $time1);
                                                if ($time_diff->h < 1) {
                                                    $minutes = $time_diff->days * 24 * 60;
                                                    $minutes += $time_diff->h * 60;
                                                    $minutes += $time_diff->i;
                                                    echo $minutes . ' minutes ago';
                                                } else {
                                                    echo $time_diff->h . "h ago";
                                                }
                                            }

                                            ?>
                                        </div>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
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
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>
<script>

    // let current_btn = document.querySelectorAll('a');
    //
    // current_btn.forEach(a => {
    //     a.addEventListener("click", function () {
    //         current_btn.forEach(btn => btn.classList.remove('current'));
    //         this.classList.add('current');
    //     })
    // })
    //
    // var dd_main = document.querySelector(".dd_main");
    //
    // dd_main.addEventListener("click", function () {
    //     this.classList.toggle("active");
    // })
</script>
</body>
</html>
