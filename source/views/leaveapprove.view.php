<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="public\css\approve.css">
    <link rel="stylesheet" href="public\css\popup.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>

    <title>Leave Approve</title>
</head>

<body>

    <div>
        <?php
        $this->view('includes/header1')
        ?>
    </div>

    <div class="page_content">

        <?php if (Auth::access('Supervisor')) : ?>

            <?php

            $this->view('includes/parentemployeenavbar');
            ?>

        <?php endif; ?>

        <?php if (Auth::access('HR Manager')) : ?>
            <div>
                <?php
                $this->view('includes/hrmanagernavbar');

                ?>
            </div>
        <?php endif; ?>

        <?php
        if (boolval($emp)) {

        ?>
            <div class="main_container">
                <div class="approve-container">
                    <div>
                        <p class="handling_title">Handle Time Off</p>
                    </div>
                    <hr>

                    <div class="card-container">

                        <?php



                        if (boolval($emp)) {
                            $id_arr = array();
                            for ($i = 0; $i <= sizeof($emp); $i++) {

                                if (boolval($emp[$i]['details'])) {
                                    $n = count($emp[$i]['details']);


                                    for ($j = 0; $j < $n; $j++) {


                                        array_push($id_arr, "reject" . $i . $j);

                                        if ($emp) { ?>
                                            <div class="header-approve" style="height: 280px;" id="btn">
                                                <center>
                                                    <img src="<?= IMG_PATH ?>\profile\download.png" class="profile__image">
                                                </center>
                                                <p class="name"><?php print_r($emp[$i]['first_name']); ?></p>
                                                <p class="name"><?php print_r($emp[$i]['last_name']); ?></p>
                                                <div>
                                                    <center>

                                                        <?php
                                                        $type = $emp[$i]['details'][$j]->leave_type;

                                                        switch ($type) {
                                                            case "casual":

                                                        ?>
                                                                <i class="fas fa-sun"></i>

                                                            <?php
                                                                break;
                                                            case "sick":
                                                            ?>
                                                                <i class="fas fa-band-aid"></i>

                                                            <?php
                                                                break;
                                                            case "annual":
                                                            ?>
                                                                <i class="far fa-calendar-plus"></i>

                                                            <?php
                                                                break;
                                                            default:
                                                            ?><i class="far fa-calendar-plus"></i><?php
                                                                                            }
                                                                                                    ?>

                                                    </center>
                                                    <p class="date"><?php print_r($emp[$i]['details'][$j]->date); ?> </p>

                                                    <p class="date"><?php print_r(ucfirst($emp[$i]['details'][$j]->leave_type)); ?></p>

                                                    <form method="post" id="<?php echo "form" . $j ?>" name="">
                                                        <input type="text" id="<?php echo $j ?>" class="reason" name="reason" form="form1">



                                                </div>

                                                <center>

                                                   

                                                    <button type="submit" name="submit1" value="reject" id="reject"  class="reject">Reject</button>

                                                    <input type="hidden" name="date" value=<?php print_r($emp[$i]['details'][$j]->date); ?>>
                                                    <input type="hidden" name="l_status" id="l_status">
                                                    <input type="hidden" name="id" value=<?php print_r($emp[$i]['employee_ID']) ?>>
                                                    <button type="submit" name="submit" value="approve" id="approve">Approve</button>
                                                    </form>

                                                   


                                                </center>
                                            </div>

                    <?php }
                                    }
                                }
                            }
                        }
                    } ?>


                    </div>
                    <div class="detail-container">

                    </div>
                    <div class="approve-container">
                        <div>
                            <p class="title">Approved List</p>
                        </div>
                        <hr>

                        <table id="claim_history_table">
                            <tr>

                                <th>First Name</th>

                                <th>Leave Type</th>
                                <th>Date</th>
                                <th>Status</th>

                            </tr>

                            <?php
                            // echo "<br> front end <pre>";
                            // print_r($emps);
                            // echo "</pre>";
                            if (boolval($emps)) {
                                for ($i = 0; $i < sizeof($emps); $i++) {
                                    for ($j = 0; $j < sizeof($emps[$i]['details']); $j++) {
                                        if ($emps[$i]['details'][$j]->leave_status == "approve") { ?>

                                            <tr>
                                                <td><?php print_r($emps[$i]['first_name'] . " " . $emps[$i]['last_name']); ?></td>
                                                <!-- <td><?php print_r($emps[$i]['last_name']); ?> </td> -->
                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_type)); ?> </td>
                                                <td><?php print_r($emps[$i]['details'][$j]->date); ?> </td>
                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_status)); ?></td>

                                            </tr>
                            <?php
                                        }
                                    }
                                }
                            } ?>
                        </table>
                        <br>
                        <div>
                            <p class="title">Rejected List</p>
                        </div>
                        <hr>
                        <table id="claim_history_table">
                            <tr>

                                <th>Name</th>
                                <th>Leave Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th></th>

                            </tr>

                            <?php


                            if (boolval($emps)) {
                                // echo "<pre>";
                                // print_r($emps);
                                // echo "</pre>";
                                for ($i = 0; $i < sizeof($emps); $i++) {
                                    for ($j = 0; $j < sizeof($emps[$i]['details']); $j++) {
                                        if ($emps[$i]['details'][$j]->leave_status == "reject") { ?>

                                            <tr>
                                                <td><?php print_r($emps[$i]['first_name'] . " " . $emps[$i]['last_name']); ?></td>

                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_type)); ?> </td>
                                                <td><?php print_r($emps[$i]['details'][$j]->date); ?> </td>
                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_status)); ?></td>

                                                <?php if($emps[$i]['details'][$j]->reason == "")
                                                {?>
                                                    <td><form method="POST" ><input type="text" name="table_reason" id="reason" required></td>
                                                    <input type="hidden" name="table_date" value="<?php print_r($emps[$i]['details'][$j]->date); ?>">
                                                    <input type="hidden" name="table_id" value="<?php print_r($emps[$i]['details'][$j]->employee_ID); ?>" >
                                                    <td><button type="submit" name="table_submit" id="table_submit">OK</button></form> </td>

                                                <?php } 
                                                
                                                else{ ?>
                                                    <td><?php print_r(ucfirst($emps[$i]['details'][$j]->reason)); ?> </td>
                                                    
                                                <?php }?>
                                                

                                                

                                            </tr>
                            <?php
                                        }
                                    }
                                }
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>

</body>

</html>