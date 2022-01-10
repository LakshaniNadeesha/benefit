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

    <?php if (Auth::access('Supervisor')): ?>

        <?php
//        $this->view('includes/supervisornav');
        $this->view('includes/parentemployeenavbar');
        ?>

    <?php endif; ?>

    <?php if (Auth::access('HR Manager')): ?>
        <div>
            <?php
            $this->view('includes/hrmanagernavbar');
//            $this->view('includes/hrnav');
            ?>
        </div>
    <?php endif; ?>
    <!-- <h1>This is Leave Approve Page</h1> -->
    <?php 
    if(boolval($emp)){
        for ($i=0; $i <sizeof($emp) ; $i++) { 
            if ($emp >= 1) { ?>
    <div class="main_container">
        <div class="approve-container">
            <div>
                <p class="handling_title">Handle Time Off</p>
            </div>
            <hr>
            <div class="card-container">
                <div class="header-approve" style="height: 280px;" id="btn">
                    <center>
                        <img src="<?= IMG_PATH ?>\profile\download.png" class="profile__image">
                    </center>
                    <p class="name"><?php print_r($emp[$i]['first_name']);?></p>
                    <p class="name"><?php print_r($emp[$i]['last_name']);?></p>
                    <div>
                        <center>
                            <i class="fas fa-band-aid"></i>
                        </center>
                        <p class="date"><?php print_r($emp[$i]['details']->starting_date );?> To</p>
                        <p class="date"><?php print_r($emp[$i]['details']->ending_date);?></p>
                        <p class="date" ><?php print_r($emp[$i]['details']->leave_type );?></p>

                    </div>

                    <center>
                        <button type="button" name="show" value="show">Show</button>
                    </center>
                </div>
            <?php }
        }
    }?>
               <!--  <div class="header-approve" id="btn">
                    <center>
                        <img src="<?= IMG_PATH ?>\profile\download.png" class="profile__image">
                    </center>
                    <p class="name">Dilukshan</p>
                    <p class="name">Bimasara</p>
                    <div>
                        <center>
                            <i class="fas fa-sun"></i>
                        </center>
                        <p class="date">06th Oct</p>
                    </div>
                    <center>
                        <button type="button" name="show" value="show">Show</button>
                    </center>
                </div>
                <div class="header-approve" id="btn">
                    <center>
                        <img src="<?= IMG_PATH ?>\profile\download.png" class="profile__image">
                    </center>
                    <p class="name">Dilukshan</p>
                    <p class="name">Bimasara</p>
                    <div>
                        <center>
                            <i class="far fa-calendar-plus"></i>
                        </center>
                        <p class="date">06th Oct</p>
                    </div>
                    <center>
                        <button type="button" name="show" value="show">Show</button>
                    </center>
                </div> -->
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
                    <!-- <th><label>
                            <input name="select_all" value="1" type="checkbox">
                        </label></th> -->
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    
                </tr>
                 <?php
                 if(boolval($emps)){
                        for($i=0;$i<sizeof($emps);$i++){
                        
                               
                            ?>

                <tr>
                   <!--  <td><input type="checkbox" name="name1" /></td> -->
                    <td><?php print_r($emps[$i]['first_name']); ?></td>
                    <td><?php print_r($emps[$i]['last_name']);?> </td>
                     <td><?php print_r($emps[$i]['details']->leave_type);?> </td>
                    <td><?php print_r($emps[$i]['details']->starting_date);?> </td>
                     <td><?php print_r($emps[$i]['details']->ending_date);?> </td>

                    <!-- <td> 
                        <a href="<?= PATH ?>Supervisor/Update_Performance/<?=$handled[$i]['employee_ID']?>"><i class="fas fa-edit"></i></a>
                        <a href="<?= PATH ?>Supervisor/Delete_Performance/<?=$handled[$i]['employee_ID']?>"><i class="fas fa-trash-alt"></i></a> 
                    </td> -->
                    
                </tr>
                <?php
            }
                        
                    }?>
            </table>
        </div>
        </div>
    </div>
</div>

<!--<div>-->
<!--    --><?php
//    $this->view('includes/footer')
//    ?>
<!--</div>-->
</body>
</html>
