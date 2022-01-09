<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefitrequest.css">
    <title>Change Benefit</title>
</head>
<script type="text/javascript">
    function number_validation() {
        var n = document.forms["myform"]["claiming_amount"].value;
        var decimal = /^[+]?[0-9]+\.[0-9]{2}$/;
        if (!n.match(decimal)) {
            document.getElementById("numberText").innerHTML = "<div style='font-family: Arial,serif; font-size: smaller; color: red'><i class='fas fa-exclamation' style='color: red;'></i> Please enter Numeric value</div>";
            var r1 = false;
            reason_validation();
            return false;
        } else {
            if (r1) {
                document.getElementById("numberText").innerHTML = "<span>&#10003;</span>";
            } else {
                var f1 = reason_validation();
                var f2 = true;
                if (f1 && f2) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    function reason_validation() {
        var m = document.forms["myform"]["subject"].value;
        if (isNaN(m)) {
            document.getElementById("reasonText").innerHTML = "<span>&#10003;</span>";
            return true;
        } else {
            document.getElementById("reasonText").innerHTML = "<div style='font-family: Arial; color: red'><i class='fas fa-exclamation' style='color: red;'></i> Please enter your reason correctly</div>";
            return false;
        }
    }
</script>
<body>

<div>
    <?php
    $this->view('includes/header1')
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
        $this->view('includes/header2')
        ?>

        <div class="benefit_container">
            <div class="benefit_head">
                <div class="back_btn">
                    <a href="<?= PATH ?>/Benefit"><i class="large material-icons">arrow_back</i></a>
                </div>
                <fieldset>
                    <legend>CLAIM BENEFIT</legend>
                    <!-- <div class="heading">
                            <h2>CLAIM BENEFIT</h2>
                        </div> -->

                    <div class="benefit_form">

                        <form name="myform" action="" method="post"
                              onsubmit=" return number_validation()" enctype="multipart/form-data">
                            <?php
                            if(boolval($arr)){
                                print_r($arr);
                                print_r($arr['error']);
                            }?>
                            <div class="row">
                                <div class="column_1">
                                    <label for="benefit_type">Benefit Type</label>
                                </div>
                                <div class="column_2">
                                    <select id="benefit_type" name="benefit_type" required>
                                        <option value="" disabled selected hidden><?php print_r($arr[0]->benefit_type); ?></option>
                                        <option>Medical Insurance</option>
                                        <option>Educational Expenditure</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column_1">
                                    <label for="claiming_date">Date</label>
                                </div>
                                <div class="column_2">
                                    <input type="date" id="claiming_date" value="<?php print_r($arr[0]->claim_date); ?>"
                                           name="claiming_date" placeholder="mm/dd/yyyy" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column_1">
                                    <label for="claiming_amount">Claiming Amount (LKR)</label>
                                </div>
                                <div class="column_2">
                                    <input type="text" id="claiming_amount" name="claiming_amount"
                                           value="<?php print_r($arr[0]->claim_amount); ?>" required pattern="[0-9._%+-]+\.[0-9]{2}$">
                                    <span id="numberText"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="column_1">
                                    <label for="subject">Reason</label>
                                </div>
                                <div class="column_2">
                                    <textarea id="subject" name="subject"
                                              style="height:100px;" required><?php print_r($arr[0]->benefit_description); ?></textarea>
                                    <span id="reasonText"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column_1">
                                    <label for="submission">Report Submission</label>
                                </div>
                                <div id="error_show">
                                    <div class="report_submission">
                                        <input class="file-upload__input" type="file" id="report_submission"
                                               name="report_submission"
                                               accept=".pdf, .png" multiple required hidden="hidden"><?php $report=$arr[0]->report_location; print_r($report); ?>
                                        <button class="file-upload__button" type="button">Choose File(s)</button>
                                        <span class="file-upload__label"></span>
                                    </div>

                                    <?php
                                    if (boolval($arr['error'])): ?>
                                        <br>
                                        <div style='font-family: Arial,serif; font-size: smaller; color: red; padding-left: 50px'>
                                            <i class='fas fa-exclamation' style='color: red;'></i>Sorry, file already
                                            exists
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="claim_button">

                                <a href="<?= PATH ?>/Benefit">
                                    <input class="cancle_button" type="button" value="Cancel"></a>
                                    <input type="submit" value="Apply" name="submit">
                            </div>

                            <script type="text/javascript">

                                Array.prototype.forEach.call(document.querySelectorAll('.file-upload__button'), function (button) {
                                    const hiddenInput = button.parentElement.querySelector('.file-upload__input');
                                    const label = button.parentElement.querySelector('.file-upload__label');
                                    const defaultLabelText = 'No file(s) changed';

                                    //set default text for label
                                    label.textContent = defaultLabelText;
                                    label.title = defaultLabelText;

                                    button.addEventListener('click', function () {
                                        hiddenInput.click();
                                    });

                                    hiddenInput.addEventListener('change', function () {
                                        const filenameList = Array.prototype.map.call(hiddenInput.files, function (file) {
                                            return file.name;
                                        });

                                        label.textContent = filenameList.join(', ') || defaultLabelText;
                                        label.title = label.textContent;
                                    });
                                });

                            </script>
                        </form>
                </fieldset>

            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>


<?php

