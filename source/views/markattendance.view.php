<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>attendance.css">

    <title></title>
</head>

<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>

<div class="page_content">
    <?php
    $this->view('includes/parentemployeenavbar');
    ?>

    <div class="main_container">
        <div class="on_leave">
            <div class="section1">
                <p class="title"><u>On Leave</u></p>
                <p>Today</p>
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <p>Tomorrow</p>
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
            </div>
            <div class="section2">
                <p class="title"><u>Calender</u></p>
                <?php $this->view('includes/calendar') ?>
            </div>
        </div>
        <div class="emp_list">
            <p class="title">Employee List</p>
            <?php
            if (boolval($details)) {
                for ($i = 0; $i < sizeof($details); $i++) {
                    ?>
                    <div class="box">
                        <img src="<?php print_r($details[$i]->profile_image) ?>" alt="on-leave-people"
                             class="on-leave-people">
                        <p class="content"><?php print_r($details[$i]->first_name);
                            echo " ";
                            print_r($details[$i]->last_name) ?></p>
                        <p class="content"><?php print_r($details[$i]->department_ID) ?></p>
                        <p class="content"><?php print_r($details[$i]->designation_code) ?></p>
                        <?php
                        $select = 'select';
                        $select .= $i;
                        ?>
                        <input type="checkbox" id="<?php echo $select?>">
                    </div>
                    <script>
                        const hideBox = document.querySelector('<?php echo "#".$select;?>');
                        hideBox.addEventListener('change',function (e){
                            if(hideBox.checked){
                                list.style.display = "initial";
                            }
                            else {
                                list.style.display = "none";
                            }
                        });
                    </script>
                    <?php
                }
            } ?>
        </div>
        <div class="attendance_form">
            <div class="form-title">Fill This</div>
            <form name="" action="" method="post">
                <div class="form-content">
                    <div class="date">
                        <label for="date">Date : </label>
                        <input type="date" name="date" id="name" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="selected-names">
                        <?php
                        if (boolval($details)) {
                            for ($i = 0; $i < sizeof($details); $i++) {
                                $list = 'list';
                                $list .= $i;
                                ?>
                                <div class="box" id="<?php echo $list?>">
                                    <img src="<?php print_r($details[$i]->profile_image) ?>" alt="on-leave-people"
                                         class="on-leave-people">
                                    <p class="content"><?php print_r($details[$i]->first_name); ?></p>
                                </div>
                                <script>
                                    const list = document.querySelector('<?php echo "#".$list;?>');
                                </script>
                                <?php
                            }
                        } ?>
                    </div>
                    <div class="row">
                        <label for="arrival">Arrival</label>
                        <input type="time" name="arrival" id="arrival" required>
                    </div>
                    <div class="row">
                        <label for="departure">Departure</label>
                        <input type="time" name="departure" id="departure" required>
                    </div>
                    <div class="row">
                        <label for="ot-hours">OT Hours</label>
                        <input type="number" name="ot-hours" id="ot-hours">
                    </div>
                    <div class="buttons">
                        <button type="reset" class="cancel">Cancel</button>
                        <button type="submit" class="mark" value="Mark" name="mark">Mark</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>


</html>