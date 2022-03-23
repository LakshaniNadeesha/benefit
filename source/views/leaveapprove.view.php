<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="public\css\approve.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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
            // print_r($emp) 
            // for ($i=0; $i <sizeof($emp) ; $i++) { 
            //     if ($emp >= 1) { 
        ?>
            <div class="main_container">
                <div class="approve-container">
                    <div>
                        <p class="handling_title">Handle Time Off</p>
                    </div>
                    <hr>

                    <div class="card-container">

                        <?php

                        // echo "<pre>";
                        // print_r($emp);
                        // echo "</pre>";

                        print_r(sizeof($emp[0]['details']));

                        for ($i = 0; $i < sizeof($emp); $i++) {
                            for ($j = 0; $j < sizeof($emp[$i]['details']); $j++) {
                                if ($emp >= 1 && ($emp[$i]['details'][$j]->date != '0000-00-00')) { ?>
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

                                            <p class="date"><?php print_r($emp[$i]['details'][$j]->leave_type); ?></p>



                                        </div>

                                        <center>
                                            <form method="post">

                                                <button type="submit" name="submit" value="reject" id="reject" onclick="myFunction1()">Reject</button>
                                                <input type="hidden" name="date" value=<?php print_r($emp[$i]['details'][$j]->date); ?>>
                                                <input type="hidden" name="l_status" id="l_status">
                                                <input type="hidden" name="id" value=<?php print_r($emp[$i]['employee_ID']) ?>>


                                                <button type="submit" name="submit" value="approve" id="approve" onclick="myFunction2()">Approve</button>

                                                <script>
                                                    function myFunction1() {
                                                        document.getElementById("l_status").value = "reject";
                                                        alert(document.getElementById("l_status").value);
                                                        alert(document.getElementById("date").value);
                                                        console.log(document.getElementById("reject"));
                                                        console.log("inside reject");
                                                    }

                                                    function myFunction2() {
                                                        document.getElementById("l_status").value = "approve";
                                                        console.log(document.getElementById("approve"));
                                                        console.log("inside Approve");
                                                    }
                                                </script>

                                            </form>

                                        </center>
                                    </div>
                    <?php }
                            }
                        }
                    } ?>

                    </div>
                    <div class="detail-container">

                    </div>
                    <div class="approve-container">
                        <div>
                            <p class="title">Added List</p>
                        </div>
                        <hr>
                        <table id="claim_history_table">
                            <tr>
                                
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Leave Type</th>
                                <th>Date</th>
                                <th>Status</th>

                            </tr>

                            <?php
                            echo "<pre>";
                            print_r($emps);
                            echo "</pre>";
                            if (boolval($emps)) {
                                for ($i = 0; $i < sizeof($emps); $i++) {
                                    for ($j = 0; $j < sizeof($emps[$i]['details']); $j++) {



                            ?>

                                        <tr>
                                            <!--  <td><input type="checkbox" name="name1" /></td> -->
                                            <td><?php print_r($emps[$i]['first_name']); ?></td>
                                            <td><?php print_r($emps[$i]['last_name']); ?> </td>
                                            <td><?php print_r($emps[$i]['details'][$j]->leave_type); ?> </td>
                                            <td><?php print_r($emps[$i]['details'][$j]->date); ?> </td>
                                            <td ><?php print_r(ucfirst ($emps[$i]['details'][$j]->leave_status)); ?></td> 

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

</body>

</html>