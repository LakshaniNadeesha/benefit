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

                        // print_r($emp[1]);

                        echo "<pre>";
                        print_r($emp);
                        echo "</pre>";

                        if (boolval($emp)) {

                            for ($i = 0; $i <= sizeof($emp); $i++) {

                                // if(boolval($emp[$i]['details'])){
                                // echo "<pre>";
                                // print_r($emp);
                                // echo "<pre";
                                // echo (sizeof($emp[$i]['details']));
                                if (boolval($emp[$i]['details'])) {
                                    $n = count($emp[$i]['details']);
                                    // }
                                    $id_arr = array();
                                    // echo $n;
                                    for ($j = 0; $j < $n; $j++) {
                                        if ($emp >= 1) { ?>
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
                                                    <!-- <form method="post" id="reason"> -->
                                                    <form method="post" id="<?php echo "form" . $j ?>" name="">
                                                        <input type="text" id="<?php echo $j ?>" class="reason" name="reason" form="form1">
                                                        <!-- <?php echo $j ?> -->
                                                        <!-- <?php echo "form" . $j  ?> -->


                                                </div>

                                                <center>

                                                    <!-- onclick="myFunction1(<?php echo $j ?>)" -->
                                                    <button type="button" name="submit1" value="reject" id="<?php echo "reject".$i. $j ?>" class="reject">Reject</button>
                                                    <?php
                                                    array_push($id_arr,"reject". $i . $j);
                                                    ?>
                                                    <!-- <?php echo "reject" . $j ?> -->
                                                    <input type="hidden" name="date" value=<?php print_r($emp[$i]['details'][$j]->date); ?>>
                                                    <input type="hidden" name="l_status" id="l_status">
                                                    <input type="hidden" name="id" value=<?php print_r($emp[$i]['employee_ID']) ?>>
                                                    <button type="submit" name="submit" value="approve" id="approve" onclick="myFunction2()">Approve</button>
                                                    </form>



                                                </center>
                                            </div>

                    <?php }
                                    }
                                }
                            }
                        }
                    } ?>

                    <?php print_r($id_arr); ?>

                    <div class="confirm init">

                        <div class="confirm__window ">
                            <div class="confirm__titlebar">
                                <span class="confirm__title">Enter Reason For Reject</span>
                                <button class="confirm__close">&times;</button>
                            </div>

                            <div class="confirm__content" id="dhr" style="display:none;">


                                <div class="data">
                                    <div>
                                        <form method="post">
                                            <textarea rows="4" cols="70" placeholder="Describe yourself here..." name="reason" required></textarea>
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="date" id="date">

                                    </div>

                                    <div class="confirm__buttons">

                                        <!-- <input type="hidden" name="supervisor_f" id="supervisor_f"> -->
                                        <input type="submit" id="delete" name="delete" value="Delete" />
                                        </form>
                                    </div>



                                </div>
                            </div>

                        </div>

                    </div>

                    <script>
                        var idArray =
                            <?php echo json_encode($id_arr); ?>;
                        console.log(idArray);

                        var dataArray =
                            <?php echo json_encode($emp); ?>;
                        console.log(dataArray);
                        console.log(dataArray.length);
                        console.log(dataArray[0]['details'].length);

                        // decoment.write(dataArray.length);
                        // document.write(dataArray[0]['details'][0]['employee_ID']);
                        for (let i = 0; i < dataArray.length; i++) {
                            console.log(dataArray[i]['details'].length);
                            for (let j = 0; j < dataArray[i]['details'].length; j++) {

                                var id = "#reject" + i+j;
                                document.write(id);
                                const reject = document.querySelector(id);
                                const cancel = document.querySelector('#cancel');
                                const sub = document.querySelector('#sub');
                                const confirmEl = document.querySelector('.confirm');
                                const btnClose = document.querySelector('.confirm__close');

                                console.log(dataArray[i]['details'][j]['employee_ID']);
                                console.log(dataArray[i]['details'][j]['date']);

                                document.getElementById("id").value = dataArray[i]['details'][j]['employee_ID'];
                                document.getElementById("date").value = dataArray[i]['details'][j]['date'];

                                const btnCancel = document.querySelector('.confirm__button--cancel');

                                confirmEl.addEventListener('click', e => {
                                    if (e.target === confirmEl && e.target !== sub) {
                                        // options.oncancel();
                                        close(confirmEl);
                                    }
                                });

                                [btnCancel, btnClose].forEach(el => {
                                    if (el && el.target !== sub) {
                                        el.addEventListener('click', () => {
                                            // options.oncancel();
                                            close(confirmEl);
                                        });
                                    };

                                });


                                reject.addEventListener('click', () => {

                                    pop(confirmEl);
                                    console.log("This is hr " + reject);
                                    document.getElementById("dhr").style.display = "block";

                                });
                            }


                            // cancel.addEventListener('click',()=>{

                            // })

                            function close(confirmEl) {
                                console.log('You closed the window!');
                                confirmEl.classList.add('confirm--close');

                                document.body.removeChild(confirmEl);


                            };

                            function pop(confirmEl) {

                                document.body.appendChild(confirmEl);
                                confirmEl.classList.remove('confirm--close');
                                confirmEl.classList.remove('init');
                            };

                        }
                    </script>


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
                                        if ($emps[$i]['details'][$j]->date != '0000-00-00' && $emps[$i]['details'][$j]->leave_status == "approve") { ?>

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

                            </tr>

                            <?php


                            if (boolval($emps)) {
                                for ($i = 0; $i < sizeof($emps); $i++) {
                                    for ($j = 0; $j < sizeof($emps[$i]['details']); $j++) {
                                        if ($emps[$i]['details'][$j]->date != '0000-00-00' && $emps[$i]['details'][$j]->leave_status == "reject") { ?>

                                            <tr>
                                                <td><?php print_r($emps[$i]['first_name'] . " " . $emps[$i]['last_name']); ?></td>

                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_type)); ?> </td>
                                                <td><?php print_r($emps[$i]['details'][$j]->date); ?> </td>
                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->leave_status)); ?></td>
                                                <td><?php print_r(ucfirst($emps[$i]['details'][$j]->reason)); ?> </td>

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