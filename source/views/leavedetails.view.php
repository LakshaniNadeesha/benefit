<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="public\css\leavedetails.css">
    <!-- <script src="https://unpkg.com/feather-icons"></script> -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Leaves</title>
</head>

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
            <div>
                <?php
                $this->view('includes/header2')
                ?>
            </div>
            <div class="leave_container">
                <div class="timeoff_head">
                    <div class="head_title">
                        <p class="main_title">Time Off</p>
                        <hr>
                    </div>

                    <div class="leave_card">

                        <div class="card" title="Click for Request Lave">
                            <a id="anchor" href="RequestleaveController">
                                <p class="title">Casual Leaves</p>
                                <div class="icon">
                                    <i class="item" data-feather="calendar"></i>
                                    <p class="remain" id="casual_remain">7</p>
                                </div>
                                <p>DAYS AVAILABLE</p>
                            </a>

                        </div>

                        <div class="card" title="Click for Request Lave">
                            <a id="anchor" href="RequestleaveController">
                                <p class="title">Sick Leaves
                                    <p>
                                    <div class="icon">
                                        <i class="item" data-feather="plus-square"></i>
                                        <p class="remain" id="sick_remain">7</p>
                                    </div>
                                    <p>DAYS AVAILABLE</p>
                            </a>
                        </div>

                        <div class="card" title="Click for Request Lave">
                            <a id="anchor" href="RequestleaveController">
                                <p class="title">Annual Leaves</p>
                                <div class="icon">
                                    <i class="item" data-feather="sun"></i>
                                    <p class="remain" id="annual_remain">14</p>
                                </div>
                                <p>DAYS AVAILABLE</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="upcoming_timeoff">
                    <div class="upcoming_header">
                        <i class="item" data-feather="clipboard"></i>
                        <p class="main_title">Upcoming Time Off</p>
                    </div>
                    <hr>
                    <!-- <?php
                            echo "<pre>";
                            print_r($arr1);
                            echo "</pre>";
                            ?> -->

                    <div class="upcomming_data">
                        <?php
                        if (boolval($arr1)) {

                            for ($i = 0; $i < sizeof($arr1); $i++) {

                                if ($arr1[$i]->leave_status == "pending") {
                                    
                        ?>
                                    <form method="post">
                                        <div class="upcoming_detail">
                                            <div class="icon">
                                                <i class="item" data-feather="smile"></i>
                                            </div>

                                            <div class="description">
                                                <div class="leave_name">
                                                    <p id="day"><?php print_r($arr1[$i]->date . " " . ucfirst(($arr1[$i]->half_time))); ?></p>
                                                    <input type="hidden" name="d_date" value="<?php print_r($arr1[$i]->date) ?>">
                                                    <p id="reson">Request <?php print_r(ucfirst($arr1[$i]->leave_type)); ?> Leave</p>
                                                </div>

                                                <div class="leave_status">
                                                    <p id="status"><i><?php print_r(ucfirst($arr1[$i]->leave_status)); ?></i></p>

                                                </div>

                                                <div class="delete_leave">
                                                    <button class="button-btn" type="submit" id="delete" name="submit"><i class='fas fa-trash-alt'></i></button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>


                        <?php
                                }
                            }
                        } ?>
                    </div>




                </div>
                <div class="leave_history">
                    <div class="history_header">
                        <i class="item" data-feather="clock"></i>
                        <p class="main_title">Leave History</p>
                    </div>
                    <hr>
                    <?php
                    if (boolval($arr2)) { ?>

                        <h3>Approve Leaves</h3>


                        <table id="leave_history_result">



                            <?php
                            // print_r($arr3);
                            for ($i = 0; $i < sizeof($arr2); $i++) {
                                if ($arr2[$i]->leave_status == "approve") {
                            ?>

                                    <tr>
                                        <td> <?php print_r($arr2[$i]->date); ?></td>
                                        <td><?php print_r(ucfirst($arr2[$i]->leave_status)); ?></td>
                                        <td><?php print_r(ucfirst($arr2[$i]->leave_type)) ?> Leave</td>
                                        <?php $type = $arr2[$i]->leave_type ?>
                                        <td>+<?php print_r($arr3[$type]) ?></td>

                                    </tr>

                        <?php
                                }
                            }
                        } ?>

                        </table>

                        <?php
                        if (boolval($arr2)) { ?>
                            <h3>Reject Leaves</h3>
                            <table id="leave_history_result">


                                <?php
                                // print_r($arr3);
                                for ($i = 0; $i < sizeof($arr2); $i++) {
                                    if ($arr2[$i]->leave_status == "reject") {
                                ?>

                                        <tr>
                                            <td> <?php print_r($arr2[$i]->date); ?></td>
                                            <td><?php print_r(ucfirst($arr2[$i]->leave_status)); ?></td>
                                            <td><?php print_r(ucfirst($arr2[$i]->leave_type)); ?> Leave</td>
                                            <td><?php print_r(ucfirst($arr2[$i]->reason)); ?></td>
                                            <?php $type = $arr2[$i]->leave_type ?>
                                            <td>+<?php print_r($arr3[$type]) ?></td>

                                        </tr>

                            <?php
                                    }
                                }
                            } ?>

                            </table>


                </div>
            </div>
        </div>
    </div>
    <script>
        feather.replace()
    </script>

    <!--</div>-->
    <?php //$this->view('includes/footer')
    ?>
    <!--</div>-->
</body>

</html>