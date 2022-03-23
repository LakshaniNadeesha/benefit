<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>color.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>supervisorviewperformance.css">
    <title>Performance</title> 
</head>
<script>
    var dataTable = document.getElementById('claim_history_table');
    var checkItAll = dataTable.querySelector('input[name="select_all"]');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');

    checkItAll.addEventListener('change', function() {
        if (checkItAll.checked) {
            inputs.forEach(function(input) {
                input.checked = true;
            });
        }
    });
</script>
<body>

<div>
    <?php
    $this->view('includes/header1');
    ?>
</div> 

<div class="page_content">
    <?php
//    $this->view('includes/supervisornav');
    $this->view('includes/parentemployeenavbar');
    ?>

    <div class="main_container">
        <!--        <div class="details">-->
        <!--            <div class="employee">-->

        <div class="approve-container">
            <div>
                <p class="title">To Be Add</p>
            </div>
            <hr>
            <div class="data">
              <?php

                if(boolval($emp)){
                for ($i = 0;$i < sizeof($emp);$i++) {
                    if ($emp >= 1) { ?>
                <!-- <form method="post">-->
                <div class="cards">
                    <center>
                        <img src="<?php echo $emp[$i]['profile_image'];?>" alt='Profile Image' class="profile__image">
                    </center>
                    <div class="name">
                        <p><?php print_r($emp[$i]['first_name']);?></p>
                        <p><?php print_r($emp[$i]['last_name']);?></p>
                    </div>
                    <!-- <div class="email">
                        <p><?php echo $entry->user_role ?></p>
                    </div> -->

                   <div class="options">
                   <!-- <a href="<?= PATH ?>Supervisor/Insert_Performance/<?=$emp[$i]['employee_ID'] ?>">
                            <i class="fas fa-plus"></i>
                        </a> -->

                        <a href="<?= PATH ?>Supervisor/Update_Performance/<?=$emp[$i]['employee_ID'] ?> ">
                            <i class="fas fa-edit"></i>
                        </a>

                         <a href="<?= PATH ?>Supervisor/Delete_Performance/<?=$emp[$i]['employee_ID']?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div> 
                    <?php
                }
                }
                } ?>
            </div>
            <!--</form>-->
        </div>
        <div class="approve-container">
            <div>
                <p class="title">Added List</p>
            </div>
            <hr>
            <table id="claim_history_table">
                <tr>
                    <th><label>
                            <input name="select_all" value="1" type="checkbox">
                        </label></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Last Modify</th>
                    <th>Options</th>
                    
                </tr>
                 <?php
                        for($i=0;$i<sizeof($handled);$i++){
                        
                               
                            ?>

                <tr>
                    <td><input type="checkbox" name="name1" /></td>
                    <td><?php print_r($handled[$i]['first_name']); ?></td>
                    <td><?php print_r($handled[$i]['last_name']);?> </td>
                    <td><?php print_r($handled[$i]['details']->last_modifydate);?> </td>
                    <td> 
                        <a href="<?= PATH ?>Supervisor/Update_Performance/<?=$handled[$i]['employee_ID']?>"><i class="fas fa-edit"></i></a>
                        <a href="<?= PATH ?>Supervisor/Delete_Performance/<?=$handled[$i]['employee_ID']?>"><i class="fas fa-trash-alt"></i></a> 
                    </td>
                    
                </tr>
                <?php
                        
                    }?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

