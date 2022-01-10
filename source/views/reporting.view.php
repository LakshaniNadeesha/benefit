<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>reporting.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Reports</title>
    <script>
        var x = false;
        function show_time_off() {
            if(x === false) {
                document.getElementById("time_off_chart").style.display = "flex";
                x = true;
            }
            else {
                document.getElementById("time_off_chart").style.display = "none";
                x = false;
            }
        };

        var y = false;
        function show_benefit() {
            if(y === false) {
                document.getElementById("benefit_chart").style.display = "flex";
                y = true;
            }
            else {
                document.getElementById("benefit_chart").style.display = "none";
                y = false;
            }
        };

        var z = false;
        function show_reimbursement() {
            if(z === false) {
                document.getElementById("reimbursement_chart").style.display = "flex";
                z = true;
            }
            else {
                document.getElementById("reimbursement_chart").style.display = "none";
                z = false;
            }
        };

    </script>
</head>
<body>
<div>
    <?php
    $this->view('includes/header1')
    ?>
</div>

<div class="page_content">
    <?php if (Auth::access('HR Manager')): ?>
        <?php
//        $this->view('includes/hrnav');
        $this->view('includes/hrmanagernavbar');
        ?>
    <?php endif; ?>

    <?php if (Auth::access('HR Officer')): ?>
        <?php
        $this->view('includes/hrofficernavbar');
        ?>
    <?php endif; ?>

    <div class="main_container">
        <div class="report_container">
            <div class="report_type">
                <div class="report_name">
                    <p>Time Offs</p>
                </div>
                <div class="options">
                    <button id="button" onclick="show_time_off()">View</button>
                    <div class="download">
                        <i class="fa fa-download" style="font-size:30px"></i>
                    </div>
                </div>
            </div>

            <div class="divide_line"></div>

            <div class="chart" id="time_off_chart">
                <div class="report_title">
                    <p>Time Offs</p>
                </div>
                <form method="post">
                    <input type="text" value="Time-Offs" hidden>
                    <div class="select">
                        <input type="radio" value="1 month" name="duration"> <label for="1 month">One month</label><br>
                        <input type="radio" value="2 month" name="duration"> <label for="2 month">Two month</label><br>
                        <input type="radio" value="3 month" name="duration"> <label for="2 month">Three
                            month</label><br>
                        <input type="radio" value="1 year" name="duration"> <label for="1 year">One year</label><br>
                    </div>
                </form>
            </div>
        </div>

        <div class="report_container">
            <div class="report_type">
                <div class="report_name">
                    <p>Benefits</p>
                </div>
                <div class="options">
                    <button id="button" onclick="show_benefit()">View</button>
                    <div class="download">
                        <i class="fa fa-download" style="font-size:30px"></i>
                    </div>
                </div>
            </div>

            <div class="divide_line"></div>

            <div class="chart" id="benefit_chart">
                <div class="report_title">
                    <p>Benefits</p>
                </div>
                <form method="post">
                    <input type="text" value="Time-Offs" hidden>
                    <div class="select">
                        <input type="radio" value="1 month" name="duration"> <label for="1 month">One month</label><br>
                        <input type="radio" value="2 month" name="duration"> <label for="2 month">Two month</label><br>
                        <input type="radio" value="3 month" name="duration"> <label for="2 month">Three
                            month</label><br>
                        <input type="radio" value="1 year" name="duration"> <label for="1 year">One year</label><br>
                    </div>
                </form>
            </div>
        </div>

        <div class="report_container">
            <div class="report_type">
                <div class="report_name">
                    <p>Reimbursements</p>
                </div>
                <div class="options">
                    <button id="button" onclick="show_reimbursement()">View</button>
                    <div class="download">
                        <i class="fa fa-download" style="font-size:30px"></i>
                    </div>
                </div>
            </div>

            <div class="divide_line"></div>

            <div class="chart" id="reimbursement_chart">
                <div class="report_title">
                    <p>Reimbursements</p>
                </div>
                <form method="post">
                    <input type="text" value="Time-Offs" hidden>
                    <div class="select">
                        <input type="radio" value="1 month" name="duration"> <label for="1 month">One month</label><br>
                        <input type="radio" value="2 month" name="duration"> <label for="2 month">Two month</label><br>
                        <input type="radio" value="3 month" name="duration"> <label for="2 month">Three
                            month</label><br>
                        <input type="radio" value="1 year" name="duration"> <label for="1 year">One year</label><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

