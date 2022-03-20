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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Reimbursement Request</title>
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
                <form name="myform" action="#" method="POST" onsubmit=" return validation()" enctype="multipart/form-data">

                    <div class="row">
                        <div class="column_1">
                            <label for="c_date">Claim Date</label>
                        </div>
                        <div class="column_2">
                            <input type="date" id="claim_date" name="claim_date" min="2022-03-21" max="2022-03-28"
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
                            <label for="subject">Pay For</label>
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
                           <input class="file-input" type="file" id="invoice_submission" name="invoice_submission" accept=".pdf, .png" multiple required hidden>
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
                        print_r($errors);?>
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
            <?php
            // if (boolval($errors)) {
            //     print_r($errors);
            // }
            ?>
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
                                <a href="<?= PATH ?>Reimbursement/updating/<?= $vai->invoice_hashing?>">
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
                <table id="claim_history_table">
                    <!-- <form method="post" action="Reimbursement/delete"> -->
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>


                    <?php
                    $i = 0;

                    if (boolval($row)) {

                        for ($i = 0; $i < sizeof($row); $i++) {

                            $vai = $row[$i];
                            if ($vai->reimbursement_status == "accepted" || $vai->reimbursement_status == "rejected") { ?>
                                <tr>
                                    <td><?php print_r($vai->claim_date); ?></td>
                                    <td><?php print_r($vai->claim_amount); ?></td>
                                    <td><?php print_r($vai->reimbursement_status); ?></td>
                                </tr>

                            <?php }
                        }
                    } ?>

                    <!--                    <td>--><?php //echo "No history";
                    //                        } ?><!--</td>-->
                    <!-- </form> -->
                </table>
            </div>

        </div>
    </div>
</div>
<script src="public/js/reimbursement.js"></script>
</body>
</html>



