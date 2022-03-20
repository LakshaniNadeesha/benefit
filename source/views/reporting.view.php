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

      
        function view_reimbursement(){
            if(document.getElementById("reim_1").checked == true){
                document.getElementById("claim_history_table_month1").style.display = "inline-table";
                document.getElementById("reim_button1").style.display = "flex";
                document.getElementById("claim_history_table_month2").style.display = "none";
                document.getElementById("reim_button2").style.display = "none";
                document.getElementById("claim_history_table_month3").style.display = "none";
                document.getElementById("reim_button3").style.display = "none";

            }
            else if(document.getElementById("reim_2").checked == true){
                document.getElementById("claim_history_table_month1").style.display = "none";
                document.getElementById("reim_button1").style.display = "none";
                document.getElementById("claim_history_table_month2").style.display = "inline-table";
                document.getElementById("reim_button2").style.display = "flex";
                document.getElementById("claim_history_table_month3").style.display = "none";
                document.getElementById("reim_button3").style.display = "none";

            }
            else if(document.getElementById("reim_3").checked == true){
                document.getElementById("claim_history_table_month1").style.display = "none";
                document.getElementById("reim_button1").style.display = "none";
                document.getElementById("claim_history_table_month2").style.display = "none";
                document.getElementById("reim_button2").style.display = "none";
                document.getElementById("claim_history_table_month3").style.display = "inline-table";
                document.getElementById("reim_button3").style.display = "flex";
            }
        };


        function view_benefit(){
            if(document.getElementById("bene_1").checked == true){
                document.getElementById("benefit_history_table_month1").style.display = "inline-table";
                document.getElementById("bene_button1").style.display = "flex";
                document.getElementById("benefit_history_table_month2").style.display = "none";
                document.getElementById("bene_button2").style.display = "none";
                document.getElementById("benefit_history_table_month3").style.display = "none";
                document.getElementById("bene_button3").style.display = "none";

            }
            else if(document.getElementById("bene_2").checked == true){
                document.getElementById("benefit_history_table_month2").style.display = "inline-table";
                document.getElementById("bene_button2").style.display = "flex";
                document.getElementById("benefit_history_table_month1").style.display = "none";
                document.getElementById("bene_button1").style.display = "none";
                document.getElementById("benefit_history_table_month3").style.display = "none";
                document.getElementById("bene_button3").style.display = "none";
            }
            else if(document.getElementById("bene_3").checked == true){
                document.getElementById("benefit_history_table_month2").style.display = "none";
                document.getElementById("bene_button2").style.display = "none";
                document.getElementById("benefit_history_table_month1").style.display = "none";
                document.getElementById("bene_button1").style.display = "none";
                document.getElementById("benefit_history_table_month3").style.display = "inline-table";
                document.getElementById("bene_button3").style.display = "flex";
            }
        };

        function view_leave(){
            if(document.getElementById("leave_1").checked == true){
                document.getElementById("leave_history_table_month1").style.display = "inline-table";
                document.getElementById("leave_button1").style.display = "flex";
                document.getElementById("leave_history_table_month2").style.display = "none";
                document.getElementById("leave_button2").style.display = "none";
                document.getElementById("leave_history_table_month3").style.display = "none";
                document.getElementById("leave_button3").style.display = "none";

            }
            else if(document.getElementById("leave_2").checked == true){
                document.getElementById("leave_history_table_month1").style.display = "none";
                document.getElementById("leave_button1").style.display = "none";
                document.getElementById("leave_history_table_month2").style.display = "inline-table";
                document.getElementById("leave_button2").style.display = "flex";
                document.getElementById("leave_history_table_month3").style.display = "none";
                document.getElementById("leave_button3").style.display = "none";
            }
            else if(document.getElementById("leave_3").checked == true){
                document.getElementById("leave_history_table_month1").style.display = "none";
                document.getElementById("leave_button1").style.display = "none";
                document.getElementById("leave_history_table_month2").style.display = "none";
                document.getElementById("leave_button2").style.display = "none";
                document.getElementById("leave_history_table_month3").style.display = "inline-table";
                document.getElementById("leave_button3").style.display = "flex";
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
                    <button id="button" onclick="show_time_off()"><i class="fa fa-eye"></i>         View</button>
                    <!-- <div class="download">
                        <i class="fa fa-download" style="font-size:30px"></i>
                    </div> -->
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
                        <input type="radio" id="leave_1" value="1 month" name="duration" onclick="view_leave()"> <label for="1 month">One month</label><br>
                        <input type="radio" id="leave_2" value="2 month" name="duration" onclick="view_leave()"> <label for="2 month">Two month</label><br>
                        <input type="radio" id="leave_3" value="3 month" name="duration" onclick="view_leave()"> <label for="2 month">Three month</label><br>
                    </div>
                </form>

                <!-- leave_1 -->
                <div class="leave_report" id="leave_report">
                <table id="leave_history_table_month1">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>OT Hours</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($leave_row1)) {

                        for ($i = 0; $i < sizeof($leave_row1); $i++) {

                            $vai3 = $leave_row1[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai3->employee_ID); ?></td>
                                    <td><?php print_r($vai3->name); ?></td>
                                    <td><?php print_r($vai3->date); ?></td>
                                    <td><?php print_r($vai3->ot_hours); ?></td>
                                    <td><?php print_r($vai3->status); ?></td>


                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="leave_button1">
                <a href="<?= PATH ?>Reporting/leavereport1" class="btn1" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>


                   <!-- leave_2 -->
                   <div class="leave_report" id="leave_report">
                <table id="leave_history_table_month2">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>OT Hours</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($leave_row2)) {

                        for ($i = 0; $i < sizeof($leave_row2); $i++) {

                            $vai3 = $leave_row2[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai3->employee_ID); ?></td>
                                    <td><?php print_r($vai3->name); ?></td>
                                    <td><?php print_r($vai3->date); ?></td>
                                    <td><?php print_r($vai3->ot_hours); ?></td>
                                    <td><?php print_r($vai3->status); ?></td>


                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="leave_button2">
                <a href="<?= PATH ?>Reporting/leavereport2" class="btn1" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>

                   <!-- leave_3 -->
                   <div class="leave_report3" id="leave_report3">
                <table id="leave_history_table_month3">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>OT Hours</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($leave_row3)) {

                        for ($i = 0; $i < sizeof($leave_row3); $i++) {

                            $vai3 = $leave_row3[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai3->employee_ID); ?></td>
                                    <td><?php print_r($vai3->name); ?></td>
                                    <td><?php print_r($vai3->date); ?></td>
                                    <td><?php print_r($vai3->ot_hours); ?></td>
                                    <td><?php print_r($vai3->status); ?></td>


                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="leave_button3">
                <a href="<?= PATH ?>Reporting/leavereport3" class="btn1" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>
            </div>
        </div>

        <div class="report_container">
            <div class="report_type">
                <div class="report_name">
                    <p>Benefits</p>
                </div>
                <div class="options">
                    <button id="button" onclick="show_benefit()"><i class="fa fa-eye"></i>          View</button>
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
                        <input type="radio" id="bene_1" value="1 month" name="duration" onclick="view_benefit()"> <label for="1 month">One month</label><br>
                        <input type="radio" id="bene_2" value="2 month" name="duration" onclick="view_benefit()"> <label for="2 month">Two month</label><br>
                        <input type="radio" id="bene_3" value="3 month" name="duration" onclick="view_benefit()"> <label for="2 month">Three month</label><br>
                    </div>

                </form>
                <!-- bene_1 -->
                <div class="benefit_report" id="benefit_report">
                <table id="benefit_history_table_month1">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Benefit Type</th>
                        <th>Claim Amount</th>
                        <th>Description</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($bene_row1)) {

                        for ($i = 0; $i < sizeof($bene_row1); $i++) {

                            $vai2 = $bene_row1[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai2->employee_ID); ?></td>
                                    <td><?php print_r($vai2->claim_date); ?></td>
                                    <td><?php print_r($vai2->benefit_type); ?></td>
                                    <td><?php print_r($vai2->claim_amount); ?></td>
                                    <td><?php print_r($vai2->benefit_description); ?></td>
                                    <td><?php print_r($vai2->benefit_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="bene_button1">
                <a href="<?= PATH ?>Reporting/benefitreport1" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>

                    <!-- bene_2 -->
                    <div class="benefit_report2" id="benefit_report2">
                <table id="benefit_history_table_month2">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Benefit Type</th>
                        <th>Claim Amount</th>
                        <th>Description</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($bene_row2)) {

                        for ($i = 0; $i < sizeof($bene_row2); $i++) {

                            $vai2 = $bene_row2[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai2->employee_ID); ?></td>
                                    <td><?php print_r($vai2->claim_date); ?></td>
                                    <td><?php print_r($vai2->benefit_type); ?></td>
                                    <td><?php print_r($vai2->claim_amount); ?></td>
                                    <td><?php print_r($vai2->benefit_description); ?></td>
                                    <td><?php print_r($vai2->benefit_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="bene_button2">
                <a href="<?= PATH ?>Reporting/benefitreport2" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>

                 <!-- bene_3 -->
                 <div class="benefit_report3" id="benefit_report3">
                <table id="benefit_history_table_month3">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Benefit Type</th>
                        <th>Claim Amount</th>
                        <th>Description</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($bene_row3)) {

                        for ($i = 0; $i < sizeof($bene_row3); $i++) {

                            $vai2 = $bene_row3[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai2->employee_ID); ?></td>
                                    <td><?php print_r($vai2->claim_date); ?></td>
                                    <td><?php print_r($vai2->benefit_type); ?></td>
                                    <td><?php print_r($vai2->claim_amount); ?></td>
                                    <td><?php print_r($vai2->benefit_description); ?></td>
                                    <td><?php print_r($vai2->benefit_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="bene_button3">
                <a href="<?= PATH ?>Reporting/benefitreport3" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>


            </div>
        </div>

        <div class="report_container">
            <div class="report_type">
                <div class="report_name">
                    <p>Reimbursements</p>
                </div>
                <div class="options">
                    <button id="button" onclick="show_reimbursement()"><i class="fa fa-eye"></i>        View</button>
                </div>
            </div>

            <div class="divide_line"></div>

            <div class="chart" id="reimbursement_chart">
                <div class="report_title">
                    <p>Reimbursements</p>
                </div>
                <form method="post" action="#">
                    <input type="text" value="Time-Offs" hidden>
                    <div class="select">
                        <input type="radio" id="reim_1" value="1 month" name="duration" onclick="view_reimbursement()"> <label for="1 month">One month</label><br>
                        <input type="radio" id="reim_2" value="2 month" name="duration" onclick="view_reimbursement()"> <label for="2 month">Two month</label><br>
                        <input type="radio" id="reim_3" value="3 month" name="duration" onclick="view_reimbursement()"> <label for="2 month">Threemonth</label><br>

                    </div>

                </form>

                <!-- reim_1 -->
                <div class="reimbursement_report" id="reimbursement_report">
                
                <table id="claim_history_table_month1">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Claim Amount</th>
                        <th>Reason</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($reim_row1)) {

                        for ($i = 0; $i < sizeof($reim_row1); $i++) {

                            $vai = $reim_row1[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai->employee_ID); ?></td>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_reason); ?></td>
                                    <td><?php print_r($vai->reimbursement_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="reim_button1">
                <a href="<?= PATH ?>Reporting/reimbursementreport1" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>



                <!-- reim_2 -->
                <div class="reimbursement_report2" id="reimbursement_report2">
                
                <table id="claim_history_table_month2">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Claim Amount</th>
                        <th>Reason</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($reim_row2)) {

                        for ($i = 0; $i < sizeof($reim_row2); $i++) {

                            $vai = $reim_row2[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai->employee_ID); ?></td>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_reason); ?></td>
                                    <td><?php print_r($vai->reimbursement_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="reim_button2">
                <a href="<?= PATH ?>Reporting/reimbursementreport2" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>

                <!-- reim_3 -->
                <div class="reimbursement_report3" id="reimbursement_report3">
                
                <table id="claim_history_table_month3">
                    <tr>
                        <th>Employee ID</th>
                        <th>Claim Date</th>
                        <th>Claim Amount</th>
                        <th>Reason</th>
                        <th>Status</th>

                    </tr>
                    <?php
                    $i = 0;

                    if (boolval($reim_row3)) {

                        for ($i = 0; $i < sizeof($reim_row3); $i++) {

                            $vai = $reim_row3[$i]; 
                    ?>
                               <tr>
                                    <td><?php print_r($vai->employee_ID); ?></td>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_reason); ?></td>
                                    <td><?php print_r($vai->reimbursement_status); ?></td>

                                </tr>

                            <?php 
                        }
                    } ?>


                </table>
                </div>
                <div id="reim_button3">
                <a href="<?= PATH ?>Reporting/reimbursementreport3" class="btn" target="_blank"><i class="fa fa-download"></i>    Download</a>
                </div>
            </div>
        </div>  
    </div>
</div>
</body>
</html>

