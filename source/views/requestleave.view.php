<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\requestleave.css">
    <link rel="stylesheet" href="public\css\color.css">
    <!-- <script src="../../public/js/request_leave.js"></script> -->
    <title>Request leave</title>
</head>

<body id="bdy">
    <div class="head">
        <?php
        $this->view('includes/header1')
        ?>

    </div>
    <?php

// echo "<pre";
// print_r($row['date_validation']);
// echo "</pre>";
    if (boolval($row)) {
        
        // for ($i = 0; $i < sizeof($rows); $i++) {
            if ($row[0]) {
                $alert = "<script> alert ('$row[0]') </script>";
                echo $alert;
            }
        // }
    }
    ?>

    <div class="main_container">
        <div class="profile">
            <?php
            $this->view('includes/profile1');
            ?>
        </div>

        <div class="right">
            <div>
                <?php
                $this->view('includes/header2')
                ?>
            </div>


            <div class="input_feild">
                <div class="leave_feild">
                    <div class="back_btn">
                        <a href="LeavedetailsController"><i class="large material-icons">arrow_back</i></a>
                    </div>

                    <fieldset>
                        <legend>LEAVE REQUEST</legend>

                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- <div class="heading">
                            <h2>REQUEST LEAVES</h2>
                        </div> -->
                            <div class="data">
                                <div class="leave_type">
                                    <label for="leave_type">Leave Type</label>
                                    <select name="leave_type" id="leave_type">
                                        <option value="" id="hide"></option>
                                        <option value="sick">Sick Leave</option>
                                        <option value="casual">Casual Leave</option>
                                        <option value="annual">Annual Leave</option>
                                    </select>
                                </div>

                                <div class="full_day">
                                    <p>Full Days</p>
                                    <div class="full_duration">
                                        <div class="start_date">
                                            <label for="start_date">Start Date </label>
                                            <input type="date" name="start_date" id="start_date" min="" max="2021-12-01">
                                        </div>

                                        <div class="end_date">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" min="" max="">
                                        </div>
                                    </div>

                                </div>

                                <div class="half_day">
                                    <p>Half Days</p>
                                    <div class="half_duration">
                                        <div class="date_item">
                                            <label for="half_date">Date </label>
                                            <input type="date" name="half_date" id="half_date" min="" max="">
                                        </div>

                                        <div class="item">
                                            <div class="item-1">
                                                <label for="half_time">Morning </label>
                                                <input type="radio" id="half_time" name="half_time" value="morning">
                                            </div>
                                            <div class="item-1">
                                                <label for="half_time">Evening</label>
                                                <input type="radio" name="half_time" value="evening" id="half_time">
                                            </div>
                                        </div>

                                        <!-- <div class="item">
                                        <label for="half">Evening</label>
                                        <input type="radio" name="half" value="evening" id="half">
                                    </div> -->

                                    </div>
                                </div>

                                <div class="buttons">
                                    <button type="submit" id="request" name="submit" class="request-btn">Request</button>
                                    <button type="reset" id="cancel" class="cancle-btn">Cancel</button>

                                </div>
                            </div>

                        </form>
                    </fieldset>

                    <!-- <?php if (boolval($rows)) {
                                print_r($rows);
                            } ?> -->
                </div>

            </div>
        </div>
    </div>


    <!--<div class="fot">-->
    <!--    --><?php //$this->view('includes/footer')
                ?>
    <!--</div>-->

    <script src="public\js\requestleave.js"></script>
</body>

</html>