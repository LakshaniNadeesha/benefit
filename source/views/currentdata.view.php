<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>currentdata.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Employee</title>
</head>

<body>
    <div>
        <?php
        $this->view('includes/header1')
        ?>
    </div>

    <div class="page_content">
        <?php if (Auth::access('HR Officer')) : ?>
            <div>
                <?php
                $this->view('includes/hrofficernavbar');
                ?>
            </div>
        <?php endif; ?>
        <?php if (Auth::access('HR Manager')) : ?>
            <div>
                <?php
                $this->view('includes/hrmanagernavbar');
                ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="dates">
                <div class="top_row">
                    <label>Employee NIC : </label><input type="text" name="employee_ID" value="<?php if (boolval($nic)) {
                                                                                                    echo $nic;
                                                                                                } ?>">
                </div>
                <div class="top_row">
                    <label>Name : </label><input type="text" name="name" value="<?php if (boolval($fname) && boolval($lname)) {
                                                                                    echo $fname . " " . $lname;
                                                                                } ?>">
                </div>
                <div class="top_row">
                    <?php
                    if (boolval($benefit)) {

                        $b_size = sizeof($benefit);
                    } ?>
                    <label id="hired">Hired date :</label><input type="date" id="hired_date" value="<?php if (boolval($hired)) {
                                                                                                        echo $hired;
                                                                                                    } ?>">
                    <!--                                                  onblur="getVal(-->
                    <?php //echo $b_size 
                    ?>
                    <!--)">-->
                </div>
                <div class="top_row">
                    <label>Today :</label><input type="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
            </div>
            <div class="main_container">
                <div class="benefit_section">
                    <div class="left_section">
                        <div class="table_title">
                            Benefit Details
                        </div>
                        <table class="current_data">
                            <thead>
                                <tr>
                                    <th>Benefit Code</th>
                                    <th>Benefit Type</th>
                                    <th>Maximum (LKR)</th>
                                    <th>Valid Years</th>
                                    <th>Valid Months</th>
                                </tr>
                            </thead>
                            <?php if (boolval($benefit)) {
                                for ($i = 0; $i < sizeof($benefit); $i++) { ?>
                                    <tr>
                                        <td><?php print_r($benefit[$i]->benefit_code) ?></td>
                                        <td><?php print_r($benefit[$i]->benefit_type) ?></td>
                                        <td><?php print_r($benefit[$i]->max_amount) ?></td>
                                        <td><?php print_r($benefit[$i]->valid_years) ?></td>
                                        <td><?php print_r($benefit[$i]->valid_months) ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </table>
                    </div>
                    <div class="right_section">
                        <div class="form_title">
                            Benefit Application
                        </div>
                        <div class="benefit_form">
                            <?php if (boolval($benefit)) {
                                for ($i = 0; $i < sizeof($benefit); $i++) { ?>
                                    <div class="row_type">
                                        <input class="code" type="text" name="benefit_code[<?php echo $i; ?>]" value="<?php print_r($benefit[$i]->benefit_code); ?>" readonly>
                                        <input class="type" type="text" name="benefit_type[<?php echo $i; ?>]" value="<?php print_r($benefit[$i]->benefit_type) ?>" readonly>
                                    </div>
                                    <div class="row">
                                        <label>Remaining Amount (LKR)</label>
                                        <?php
                                        $remaining_amount = 'remaining_amount';
                                        $remaining_amount .= $i;
                                        $max_amount = 'max_amount';
                                        $max_amount .= $i;
                                        ?>
                                        <input type="text" name="remaining_amount[<?php echo $i; ?>]" id="<?php echo $remaining_amount ?>" required>
                                    </div>
                                    <div class="row">
                                        <input type="text" name="max_amount[<?php echo $i; ?>]" id="<?php echo $max_amount ?>" value="<?php print_r($benefit[$i]->max_amount) ?>" hidden>
                                        <input type="text" name="benefit_ID[<?php echo $i; ?>]" value="<?php print_r($benefit[$i]->benefit_ID) ?>" hidden>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <div class="calculation">
                            <button class="calculate_button" onclick="getVal(<?php if (boolval($b_size)) {
                                                                                    echo $b_size;
                                                                                } ?>)" type="button">Calculate
                            </button>

                        </div>
                    </div>
                </div>
                <div class="leave_section">
                    <div class="left_section">
                        <div class="table_title">
                            Time Off Details
                        </div>
                        <?php
                        $year = date('Y') . '-12-31';
                        $renew = date('Y-m-d', strtotime($year . ' + 1 days'));
                        ?>
                        <table class="current_data">
                            <thead>
                                <tr>
                                    <th>Time Off Type</th>
                                    <th>Maximum Leave Count</th>
                                    <th>Renew Date</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Sick Leave</td>
                                <td>07</td>
                                <td><?php echo $renew ?></td>
                            </tr>
                            <tr>
                                <td>Casual Leave</td>
                                <td>07</td>
                                <td><?php echo $renew ?></td>
                            </tr>
                            <tr>
                                <td>Annual Leave</td>
                                <td>14</td>
                                <td><?php echo $renew ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="right_section">
                        <div class="form_title">
                            Time Off Application
                        </div>
                        <div class="leave_form">
                            <div class="row_type">
                                <input class="code" type="text" name="sick_ID" value="01" readonly>
                                <input class="type" type="text" name="sick" value="sick" readonly>
                            </div>
                            <div class="row">
                                <label>Remaining Leave Count</label>
                                <input type="text" name="sick_remaining" id="sick_remaining" required>
                            </div>
                            <div class="row">
                                <input type="text" name="sick_max" id="sick_max" value="7" hidden>
                            </div>
                        </div>
                        <div class="leave_form">
                            <div class="row_type">
                                <input class="code" type="text" name="casual_ID" value="02" readonly>
                                <input class="type" type="text" name="casual" value="casual" readonly>
                            </div>
                            <div class="row">
                                <label>Remaining Leave Count</label>
                                <input type="text" name="casual_remaining" id="casual_remaining" required>
                            </div>
                            <div class="row">
                                <input type="text" name="casual_max" id="casual_max" value="7" hidden>
                            </div>
                        </div>
                        <div class="leave_form">
                            <div class="row_type">
                                <input class="code" type="text" name="annual_ID" value="3" readonly>
                                <input class="type" type="text" name="annual" value="annual" readonly>
                            </div>
                            <div class="row">
                                <label>Remaining Leave Count</label>
                                <input type="text" name="annual_remaining" id="annual_remaining" required>
                            </div>
                            <div class="row">
                                <input type="text" name="annual_max" id="annual_max" value="14" hidden>
                            </div>
                        </div>
                        <div class="calculation">
                            <button class="calculate_button" onclick="getCount()" type="button">Calculate
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="buttons">
                <input type="reset">
                <input type="submit" name="submit">
            </div>
        </form>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 200">
            <path fill="#0f9eb8" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,80C384,
            64,480,64,576,96C672,128,768,192,864,192C960,192,1056,128,1152,90.7C1248,53,1344,43,1392,37.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,
            320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <script>
        function getCount() {
            const val = document.getElementById('hired_date').value;
            const d = new Date(val);
            let year = d.getFullYear();
            const today = new Date();
            let this_year = today.getFullYear();
            console.log(val);
            if (year == this_year) {
                let month = d.getMonth();
                const sick_max = document.getElementById('sick_max').value;
                var sick_remain = sick_max - ((month + 1) / 12) * sick_max;
                document.getElementById('sick_remaining').value = Math.round(sick_remain);

                const casual_max = document.getElementById('casual_max').value;
                var casual_remain = casual_max - ((month + 1) / 12) * casual_max;
                document.getElementById('casual_remaining').value = Math.round(casual_remain);

                const annual_max = document.getElementById('annual_max').value;
                var annual_remain = annual_max - ((month + 1) / 12) * annual_max;
                document.getElementById('annual_remaining').value = Math.round(annual_remain);
                console.log(annual_remain);
            } else {
                document.getElementById('sick_remaining').value = document.getElementById('sick_max').value;
                document.getElementById('casual_remaining').value = document.getElementById('casual_max').value;
                document.getElementById('annual_remaining').value = document.getElementById('annual_max').value;
            }
        }

        function getVal(b_size) {
            const val = document.getElementById('hired_date').value;
            const d = new Date(val);
            let year = d.getFullYear();
            const today = new Date();
            let this_year = today.getFullYear();
            var remaining_amount;
            var max_amount;
            //console.log(this_year);
            console.log(today);
            for (let j = 0; j < b_size; j++) {
                remaining_amount = 'remaining_amount' + j;
                max_amount = 'max_amount' + j;
                if (year == this_year) {
                    let month = d.getMonth();
                    const max = document.getElementById(max_amount).value;
                    var remain = max - ((month + 1) / 12) * max;
                    document.getElementById(remaining_amount).value = remain.toFixed(2);
                    //console.log(month);
                } else {
                    document.getElementById(remaining_amount).value = document.getElementById(max_amount).value;
                    const m = document.getElementById(remaining_amount).value;
                }
            }

        }
    </script>
    <script src="public\js\currentdata.js"></script>
</body>

</html>