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

                    <?php if(boolval($arr1)){ 
                         for ($i = 0; $i < sizeof($arr1); $i++) { ?>
                            <div class="upcoming_detail">
                                <div class="icon">
                                    <i class="item" data-feather="smile"></i>
                                </div>
    
                                <div class="description">
    
                                    <div class="leave_name">
                                        <p id="day"><?php print_r($arr1[$i]->date); ?></p>
                                        <p id="reson">Request <?php print_r(ucfirst($arr1[$i]->leave_type)); ?> Leave</p>
                                    </div>
    
                                    <div class="leave_status">
                                        <p id="status"><i><?php print_r(ucfirst($arr1[$i]->leave_status)); ?></i></p>
                                    </div>
    
    
                                </div>
    
                            </div>
                        <?php
                        } 
                    } ?>
                    

                </div>
                <div class="leave_history">
                    <div class="history_header">
                        <i class="item" data-feather="clock"></i>
                        <p class="main_title">Leave History</p>
                    </div>
                    <hr>


                    <div class="leave_type">
                        <form action="">
                            <select id="leave" name="leave">
                                <option value="sick">Sick Leaves</option>
                                <option value="casual">Casual Leaves</option>
                                <option value="annual">Annual Leaves</option>
                            </select>
                            <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </form>
                    </div>

        
                    <table id="leave_history_result">


                        <?php 
                        if(boolval($arr2)){

                            // print_r($arr3);
                            for ($i = 0; $i < sizeof($arr2); $i++) {?>
                            
                            <tr>
                                <td> <?php print_r($arr2[$i]->date); ?></td>
                                <td><?php print_r(ucfirst($arr2[$i]->leave_status)); ?></td>
                                <td><?php print_r(ucfirst($arr2[$i]->leave_type))?> Leave</td>
                                <?php $type = $arr2[$i]->leave_type ?>
                                <td>+<?php print_r($arr3[$type]) ?></td>
                            </tr>
                            
                    <?php
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