<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>approvereimbursement.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>reimbursement.css">

    <title>Accept/Reject Reimbursement</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#reimbursement").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#reimbursement_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            $("#reimbursement1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#reimbursement_table1 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>
<body>
<script type="text/javascript">
	function validation() {
    var p = document.forms["myform"]["accepted_amount"].value;
    var decimal = /^[+]?[0-9]+\.[0-9]+$/;
    if (p.match(decimal)) {
        var f1 = reason_validation();
        var f2 = true
        if (f1 && f2) {
            return true;
        } else {
            return false;
        }
    } else {
        alert('Please enter valid numeric value')
        reason_validation();
        return false;
    }
}

function reason_validation() {
    var m = document.forms["myform"]["rejected_reason"].value;
    if (isNaN(m)) {
        return true;
    } else {
        alert("Please enter a valid reason");
        return false;
    }
}
</script>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>
<div class="page_content">

    <?php
        $this->view('includes/parentemployeenavbar');

    ?>

<div class="reimbursement_details">
                <?php
                    if(boolval($arr)){
                        // print_r(sizeof($requested));
                        //  for ($i = 0;$i < sizeof($arr);$i++) {            
                    ?>
                    <div class="back_btn1">
                    <a href="<?= PATH ?>Approvereimbursement"><i class="large material-icons">arrow_back</i></a>
                </div>
                <fieldset>
                    <legend>APPROVE REIMBURSEMENT</legend>

                    
                    <form name="myform" action="#" method="POST" onsubmit=" return validation()" enctype="multipart/form-data">

                        
                        <div class="row">
                            <div class="column_1">
                                <label for="c_date">Claimed Date</label>
                            </div>
                            <div class="column_2">
                                <p><?php print_r($arr[0]->claim_amount);?></p>
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
                <?php
                         }
                        //}
                        ?>

            </div>
</div>
</body>

</html>