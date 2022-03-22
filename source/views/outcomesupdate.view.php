<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" <?= CSS_PATH ?>outcome.css">
    <link rel="stylesheet" href="public\css\outcome.css">

    <title></title>
</head>

<body>

<div> 
    <?php $this->view('includes/header1') ?>
</div>


<!-- <div class="profile">
        <?php
$this->view('includes/profile1');
?>
</div> -->
<!-- a -->
<div class="profile_container">
    <div class="profile">
        <?php
        $this->view('includes/profile1');
        ?>
    </div>


    <div class="row">
        <div class="title">Meeting Outcomes</div>
        <div class="leftcolumn">
  
            <?php if ( boolval($row)&& count($row) > 0)
                for ($i = sizeof($row) - 1; $i >= 0; $i--) {
                    ?>
                    <form method="post">
                <div class="form_details">
                    <div class="row">
                        <label for="fname">Title</label>
                        <input type="text" id="title" name="title" value="<?= $row[$i]->title ?>" required="required">
                    </div>
                    <div class="row">
                        <label for="lname">Date</label>
                        <input type="date" id="date" name="date" value="<?= ($row[$i]->date)?>" required="required"><br>
                    </div>
                    <div class="row">
                        <label for="subject">Outcomes</label>
                        <textarea id="outcomes" name="outcomes" required="required"><?php print_r($row[$i]->description);?></textarea><br>
                    </div>
                    <div class="buttons">
                        <input type="reset" value="Cancel">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </div>
            </form>



<!--                     <div class="card">
                        <div class="meeting_name">
                            <h2><?php print_r($row[$i]->title); ?></h2>
                        </div>
                        <h5>Meeting Date: <?php print_r($row[$i]->date); ?></h5>
                        <p class="sub_title">Outcomes..</p>
                        <div class="outcome">

                            <p class="outcome_content"><?php print_r($row[$i]->description); ?></p>

                        </div>
                    </div> -->
                <?php } ?>
        </div>
    </div>
</div>
</div>
</body>
</html>
</body>

</html>
