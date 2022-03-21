<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600'>


    <link rel="stylesheet" href="<?= CSS_PATH ?>addperformance.css">
    <!--    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">-->

</head>
<body>

<?php
error_reporting(E_ERROR | E_PARSE);
if (boolval($errors)) {
    error_reporting(E_ERROR | E_PARSE);
    foreach ($errors as $key) {
        // code...

        $alert = "<script> alert ('$key')</script>";
        print_r($alert);
    }
}
?>
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
        <div class="testbox">

            <form method="post">
                <div class="form_head">
                    <div>
                        <h1>Employees Feedback Form</h1>
                        <hr/>
                    </div>
                    <div class="employee_details">
<!--                        <center>-->
<!--                            <img src="--><?//= IMG_PATH ?><!--profile/download.png">-->
<!--                        </center>-->
<!--                        <p>Chathura Bimalka<br>-->
<!--                        (Operational Worker)</p>-->
                    </div>
                </div>
                <h3>Overall Experience of Worker</h3>
                <table>
                    <tr>
                        <th class="first-col"></th>
                        <th>Very Good</th>
                        <th>Good</th>
                        <th>Fair</th>
                        <th>Poor</th>
                        <th>Very Poor</th>
                    </tr>
                    <tr>
                        <td class="first-col">Task Completing</td>
                        <td><input type="radio" value="100" name="communication"/></td>
                        <td><input type="radio" value="75" name="communication"/></td>
                        <td><input type="radio" value="50" name="communication"/></td>
                        <td><input type="radio" value="25" name="communication"/></td>
                        <td><input type="radio" value="0" name="communication"/></td>
                    </tr>
                    <tr>
                        <td class="first-col">Quality Of Work</td>
                        <td><input type="radio" value="100" name="quality_of_work"/></td>
                        <td><input type="radio" value="75" name="quality_of_work"/></td>
                        <td><input type="radio" value="50" name="quality_of_work"/></td>
                        <td><input type="radio" value="25" name="quality_of_work"/></td>
                        <td><input type="radio" value="0" name="quality_of_work"/></td>
                    </tr>
                    <tr>
                        <td class="first-col">Duely Work</td>
                        <td><input type="radio" value="100" name="organization"/></td>
                        <td><input type="radio" value="75" name="organization"/></td>
                        <td><input type="radio" value="50" name="organization"/></td>
                        <td><input type="radio" value="25" name="organization"/></td>
                        <td><input type="radio" value="0" name="organization"/></td>
                    </tr>
                    <tr>
                        <td class="first-col">Team Skills</td>
                        <td><input type="radio" value="100" name="team_skills"/></td>
                        <td><input type="radio" value="75" name="team_skills"/></td>
                        <td><input type="radio" value="50" name="team_skills"/></td>
                        <td><input type="radio" value="25" name="team_skills"/></td>
                        <td><input type="radio" value="0" name="team_skills"/></td>
                    </tr>
                    <tr>
                        <td class="first-col">Multitasking Ability</td>
                        <td><input type="radio" value="100" name="multitasking_ability"/></td>
                        <td><input type="radio" value="75" name="multitasking_ability"/></td>
                        <td><input type="radio" value="50" name="multitasking_ability"/></td>
                        <td><input type="radio" value="25" name="multitasking_ability"/></td>
                        <td><input type="radio" value="0" name="multitasking_ability"/></td>
                    </tr>
                </table>
                <button type="submit" value="submit" name="submit">Add Performance</button>
            </form>
        </div>
    </div>
</div>

    <!--<div>-->
    <!--    --><?php //$this->view('includes/footer') ?>
    <!--</div>-->
</body>
</html>





