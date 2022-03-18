<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>currentdata.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Add Employee</title>
</head>

<body>
<div>
    <?php
    $this->view('includes/header1')
    ?>
</div>

<div class="page_content">
    <?php if (Auth::access('HR Officer')): ?>
        <div>
            <?php
            $this->view('includes/hrofficernavbar');
            ?>
        </div>
    <?php endif; ?>
    <?php if (Auth::access('HR Manager')): ?>
        <div>
            <?php
            $this->view('includes/hrmanagernavbar');
            ?>
        </div>
    <?php endif; ?>
    <div>Fill Current Details On Benefits & Time Offs</div>
    <form method="post">
        <div class="dates">
            <div class="top_row">
                <label>Employee NIC : </label><input type="text" name="employee_ID" value="<?php if(boolval($nic)){ echo $nic;}?>" >
            </div>
            <div class="top_row">
                <label>Name : </label><input type="text" name="name" value="<?php if (boolval($fname) && boolval($lname)){ echo $fname." ".$lname; } ?>" >
            </div>
            <div class="top_row">
                <?php $b_size = sizeof($benefit); ?>
                <label id="hired">Hired date :</label><input type="date" id="hired" value="<?php if (boolval($hired)){ echo $hired; } ?>" >
<!--                                                  onblur="getVal(--><?php //echo $b_size ?><!--)">-->
            </div>
            <div class="top_row">
                <label>Today :</label><input type="date" value="<?php echo date('Y-m-d');?>" readonly>
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
                                    <input class="code" type="text" name="benefit_code[<?php echo $i; ?>]" value="<?php print_r($benefit[$i]->benefit_code);?>" readonly >
                                    <input class="type" type="text" name="benefit_type[<?php echo $i;?>]" value="<?php print_r($benefit[$i]->benefit_type) ?>">
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
                                    <input type="text" name="max_amount[<?php echo $i; ?>]" id="<?php echo $max_amount ?>"
                                           value="<?php print_r($benefit[$i]->max_amount) ?>" hidden>
                                    <input type="text" name="benefit_ID[<?php echo $i; ?>]" value="<?php print_r($benefit[$i]->benefit_ID) ?>" hidden>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <div class="calculation">
                    <button class="calculate_button" onclick="getVal(<?php if (boolval($b_size)) { echo $b_size; } ?>)"  type="button">Calculate</button>

                    </div></div>
            </div>
            <hr>
            <div class="leave_section">
                <div class="left_section">
                    <div class="table_title">
                        Time Off Details
                    </div>
                    <table class="current_data">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php if (boolval($leave)) {
                            for ($i = 0; $i < sizeof($leave); $i++) { ?>
                                <tr>
                                    <td><?php ?></td>
                                    <td><?php ?></td>
                                    <td><?php ?></td>
                                    <td><?php ?></td>
                                    <td><?php ?></td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>
                <div class="right_section">
                    <div class="form_title">
                        Time Off Application
                    </div>
                    <div class="benefit_form">
                        <!--                    --><?php //if (boolval($leave)) {
                        //                        for ($i = 0; $i < sizeof($leave); $i++) { ?>
                        <div class="row">
                            <p><?php
                                echo " - ";
                                ?> </p>
                        </div>
                        <div class="row">
                            <label>Maximum Amount</label>
                            <input type="text">
                        </div>
                        <div class="row">
                            <label>Valid Years</label>
                            <input type="number">
                        </div>
                        <div class="row">
                            <label>Valid Months</label>
                            <input type="number">
                        </div>
                        <hr>
                        <!--                        --><?php //}
                        //                    } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <input type="reset">
            <input type="submit" name="submit">
        </div>
    </form>
</div>
<script>
    function getVal(b_size) {
        const val = document.querySelector('input').value;
        const d = new Date(val);
        let year = d.getFullYear();
        const today = new Date();
        let this_year = today.getFullYear();
        var remaining_amount;
        var max_amount;
        //console.log(this_year);
        console.log(d);
        for (let j = 0; j < b_size; j++) {
            remaining_amount = 'remaining_amount' + j;
            max_amount = 'max_amount' + j;
            if (year == this_year) {
                let month = d.getMonth();
                const max = document.getElementById(max_amount).value;
                var remain = max - ((month+1)/12)*max;
                document.getElementById(remaining_amount).value = remain.toFixed(2);
                //console.log(month);
            }
            else {
                document.getElementById(remaining_amount).value = document.getElementById(max_amount).value;
                const m = document.getElementById(remaining_amount).value;
            }
        }

    }
</script>
<script src="public\js\currentdata.js"></script>
</body>
</html>
