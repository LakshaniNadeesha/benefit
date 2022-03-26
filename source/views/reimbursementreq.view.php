<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>header2.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>reimbursement.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Reimbursement Request</title>
    <script>
        $(document).ready(function () {
            $("#reimbursement").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#handled_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            $("#reimbursement1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#handled_table1 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        
//get claim date
var today = new Date();
var max_m = today.getUTCMonth() + 1;
var max_d = today.getUTCDate();
var max_y = today.getUTCFullYear();

max_m = setDecimal(max_m);
max_d = setDecimal(max_d);

today_date = max_y + "-" + max_m + "-" + max_d;

document.getElementById("claim_date").setAttribute("max", today_date);

var dateObj = new Date();

var min_date = subDays(dateObj, 6);

var min_m = min_date.getUTCMonth() + 1; //months from 1-12
var min_d = min_date.getUTCDate();
var min_y = min_date.getUTCFullYear();

min_m = setDecimal(min_m);
min_d = setDecimal(min_d);

newdate = min_y + "-" + min_m + "-" + min_d;

document.getElementById("claim_date").setAttribute("min", newdate);


function subDays(myDate, days) {
    return new Date(myDate.getTime() - days * 24 * 60 * 60 * 1000);
}


function setDecimal(val) {
    if (number.indexOf(val) != -1) {
        val = "0" + val;
        console.log(`inside decimal point if condition ${val}`);
    }
    return val;
}


    </script>
</head>
<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>
<div class="profile_container">
    <div class="profile">
        <?php
        $this->view('includes/profile1');
        ?>
    </div>
    <div class="content">
        <?php
        $this->view('includes/header2');
        ?>
        <div class="reimbursement_container">

            <div class="reimbursement_details">
                <fieldset>
                    <legend>CLAIM REIMBURSEMENT</legend>
                    <!-- <div class="heading">
                        <h2>CLAIM REIMBURSEMENT</h2>
                    </div> -->
                    <form name="myform" action="#" method="POST" onsubmit=" return validation()"
                          enctype="multipart/form-data">

                        <div class="row">
                            <div class="column_1">
                                <label for="c_date">Date</label>
                            </div>
                            <div class="column_2">
                                <input type="date" id="claim_date" name="claim_date" min="" max=""
                                       placeholder="mm/dd/yyyy" required>
                            </div>
                            <p id="hello"></p>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="c_amount">Claim Amount (LKR)</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="claim_amount" name="claim_amount" placeholder="2000.00" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="subject">Pay For Transaction</label>
                            </div>
                            <div class="column_2">
                            <textarea id="subject" name="subject" placeholder="Write something.." style="height:100px;"
                                      required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column_1">
                                <label for="submission">Invoice Submission</label>
                            </div>
                            <div id="error_show">

                                <div class="invoice_submission">
                                    <form2>
                                        <input class="file-input" type="file" id="invoice_submission"
                                               name="invoice_submission" accept=".pdf, .png" multiple required hidden>
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p>Browse File to Upload</p>
                                    </form2>
                                    <div>
                                        <section class="progress-area"></section>

                                    </div>
                                </div>

                                <div id="error-mzg">
                                    <?php
                                    if (boolval($errors)) {
                                        print_r($errors); ?>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="apply_button">
                            <a href="<?= PATH ?>/Reimbursement">
                                <input class="cancle_button" type="button" value="Cancel"></a>
                            <input type="submit" value="Apply" name="submit">
                        </div>
                    </form>
                </fieldset>

            </div>
            <div class="history">
                <div class="history_header">
                    <p class="main_title"><i class="material-icons">history</i>Reimbursement History</p>
                </div>
                <hr>

                <?php
                $i = 0;

                if (boolval($row)) {
                    for ($i = 0; $i < sizeof($row); $i++) {
                        $vai = $row[$i];
                        if ($vai->reimbursement_status == "pending") { ?>
                            <div class="pending_items">
                                <div><?php print_r($vai->claim_date); ?></div>
                                <div><?php print_r($vai->claim_amount); ?></div>
                                <div><i>Pending</i></div>
                                <a href="<?= PATH ?>Reimbursement/updating/<?= $vai->invoice_hashing ?>">
                                    <button type="Submit" value="Submit" name="update" class="update_button"><i
                                                class="fa fa-edit"></i> Update
                                    </button>
                                </a>
                                <a href="<?= PATH ?>Reimbursement/delete/<?= $vai->invoice_hashing ?>">
                                    <button type='submit' value='Decline' name="delete" class='delete_button'><i
                                                class="fa fa-trash"></i> Delete
                                    </button>
                                </a>
                            </div>
                        <?php }
                    }
                } ?>
                <!-- <div class="search_bar">
                    <input class="reimbursement_search" type="text" id="reimbursement">
                    <i class="fa fa-search"></i>
                </div> -->
                <div class="name_tab">
                <p><i class="fa fa-check"></i>  Accepted Reimbursements</p>
                <hr>
                </div>
                <div class="search_bar">
                    <input class="reimbursement_search" type="text" id="reimbursement">
                    <i class="fa fa-search"></i>
                </div>
                <div class="accepted_table">
                <table id="claim_history_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody id="handled_table">
                    <?php
                    $i = 0;
                    if (boolval($row)) {
                        for ($i = 0; $i < sizeof($row); $i++) {
                            $vai = $row[$i];
                            if ($vai->reimbursement_status == "accepted") { ?>
                                <tr>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_reason); ?></td>
                                    <td style="text-transform: capitalize"><?php print_r($vai->reimbursement_status); ?></td>
                                </tr>

                            <?php }
                        }
                    } ?>
                    </tbody>
                </table>
                </div>
                <div class="name_tab">
                <p><i class="fa fa-times"></i>  Rejected Reimbursements</p>
                <hr>
                </div>
                <div class="search_bar">
                    <input class="reimbursement_search" type="text" id="reimbursement1">
                    <i class="fa fa-search"></i>
                </div>
                <div class="rejected_table">
                <table id="claim_history_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody id="handled_table1">
                    <?php
                    $i = 0;
                    if (boolval($row)) {
                        for ($i = 0; $i < sizeof($row); $i++) {
                            $vai = $row[$i];
                            if ($vai->reimbursement_status == "rejected") { ?>
                                <tr>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_reason); ?></td>
                                    <td style="text-transform: capitalize"><?php print_r($vai->reimbursement_status); ?></td>
                                </tr>

                            <?php }
                        }
                    } ?>
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="public/js/reimbursement.js"></script>
</body>
</html>
